<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Orders\OrdersItemsModel;
use App\Models\Orders\OrdersModel;
use App\Models\Products\ProductsModel;
use App\Models\Discounts\DiscountsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App;
use File;

class OrdersController extends Controller
{
    use App\Traits\Mail\MailingTraits;

    public static function addOrder(Request $request)
    {
        $rules = [
            "name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "address" => "required|string",
            "city" => "required|string",
            "type" => "required|int",
            "customer_id" => "required|int",
            "order_items" => "required",
            "payment_type" => "required|int"
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }
        $order = OrdersModel::create($request->except("order_items"));
        if (!$order) {
            return response()->json(["success" => false, "message" => "Something went wrong while creating order"]);
        }
        $orderItems = json_decode($request->get("order_items"));
		
		
		
        $data = [];
        $product_items = [];
        foreach ($orderItems as $o) {
            
            $product = ProductsModel::find($o->product_id);
            $product->amount = (float)$product->amount - (float)$o->amount;
			$discountId = $product->discount_id;
			$product->save(); 
            $price = (double)$product->price;
            $price_total = $price * (int)$o->amount;
			$discount = DiscountsModel::find($discountId);
			$popust = 0;
			if($discount){
				$popust = $discount->discount;
			}
			
			array_push($data, ["product_id" => $o->product_id, "order_id" => $order->id, "amount" => $o->amount, "discount"=> $popust]);
            array_push($product_items,
                [
                    "name" => $product->name,
                    "amount" => $o->amount,
                    "price" => $price,
                    "price_total" => $price_total
                ]
            );
        }
        $total = 0;
        foreach ($product_items as $p) {
            $total += $p["price_total"];
        }

       /* array_push($data, ["product_id" => 4, "order_id" => $order->id, "amount" => 1, "discount"=> 0]);
        array_push($product_items,
            [
                "name" => "Dostava",
                "amount" => 1,
                "price" => 2,
                "price_total" => 2
            ]
        ); */

        $orderItemsInsert = OrdersItemsModel::insert($data);
        if (!$orderItemsInsert) {
            return response()->json(["success" => false, "message" => "Something went wrong while creating order items"]);
        }
        $order["items"] = $product_items;
		if ($request->get("payment_type") != 3) {
        $or = self::renderPDF($order->id);
        if (!$or) {
            return response()->json(["success" => false, "message" => "Something went wrong"]);
        }
		}
        return response()->json(["success" => true, "order" => $order]); 
    }

    public static function getAllOrders(Request $request)
    {
        $offset = $request->get("offset") ? $request->get("offset") : 0;
        $orders = OrdersModel::orderBy("id", "desc")->limit(20)->offset($offset)->get();
        if (!$orders) {
            return response()->json(["success" => false, "message" => "Orders not found"]);
        }
        $order_total = 0;
        foreach ($orders as $order) {
            $items = OrdersItemsModel::where("order_id", "=", $order->id)
                ->leftJoinSub("select name,price,id,unit from flex_product", "product", "product.id", "=", "flex_orders_items.product_id")
                ->limit(20)
                ->get();


            if ($order["payment_type"] == 1) {
                $order["payment_type"] = "Pla??anje gotovinski prilikom preuzimanja";
            } elseif ($order["payment_type"] == 2) {
                $order["payment_type"] = "Uplata na teku??i ra??un";
            } elseif ($order["payment_type"] == 3) {
                $order["payment_type"] = "Pla??anje kreditnom karticom online";
            }

            if ($order["type"] == 0) {
                $order["type"] = "Fizi??ko lice";
            } else {
                $order["type"] = "Pravno lice";
            }

            foreach ($items as $item) {
                if ($item["unit"] == 0) {
                    $item["unit"] = "kg";
                } else {
                    $item["unit"] = "komad";
                }
                $item["total"] = round((double)$item["amount"] * (double)$item["price"], 2);
                $order_total += $item["total"];
            }
            $order["order_total"] = round($order_total, 2);
            $order["items"] = $items;
            $order_total = 0;
        }

        return response()->json(["success" => true, "orders" => $orders, "offset" => $offset]);
    }

    public static function getOrder(Request $request)
    {
        $rules = [
            "id" => "required",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $order = OrdersModel::find($request->get("id"));

        if (!$order) {
            return response()->json(["success" => false, "message" => "Order not found"]);
        }

        $items = OrdersItemsModel::where("order_id", "=", $order->id)
            ->leftJoinSub("select name,price,product_code,id,unit from flex_product", "product", "product.id", "=", "flex_orders_items.product_id")
            ->get();

        foreach ($items as $item) {
            if ($item["unit"] == 0) {
                $item["unit"] = "kg";
            } else {
                $item["unit"] = "komad";
            }
            $item["total"] = round((double)$item["amount"] * (double)$item["price"], 2);
        }

        if ($order["payment_type"] == 1) {
            $order["payment_type"] = "Pla??anje gotovinski prilikom preuzimanja";
        } elseif ($order["payment_type"] == 2) {
            $order["payment_type"] = "Uplata na teku??i ra??un";
        } elseif ($order["payment_type"] == 3) {
            $order["payment_type"] = "Pla??anje kreditnom karticom online";
        }
        if ($order["type"] == 0) {
            $order["type"] = "Fizi??ko lice";
        } else {
            $order["type"] = "Pravno lice";
        }
        $order["items"] = $items;
        return response()->json(["success" => true, "order" => $order]);
    }
	
	
	public static function getOrderById(Request $request)
    {
        $rules = [
            "id" => "required|string",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }
        $order = OrdersModel::where("id", "=", $request->get("id"))->first();
        if (!$order) {
            return response()->json(["success" => false, "message" => "Order not found"]);
        }

        

        try {
            self::renderPDF($order->id);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e]);
        }

        return response()->json(["success" => true, "order" => $order]);
    }
	

    public static function deleteOrder(Request $request)
    {
        $rules = [
            "id" => "required",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $order = OrdersModel::find($request->get("id"));
		

        if (!$order) {
            return response()->json(["success" => false, "Order not found"]);
        }
		
		$items = OrdersItemsModel::where("order_id", "=", $order->id)->get();

        try {
			
			foreach ($items as $item) {
                  $product = ProductsModel::find($item->product_id);
                  $product->amount = (float)$product->amount + (float)$item->amount;
			      $product->save();
            }
			
            $order->delete();
            return response()->json(["success" => true, "message" => "Order deleted"]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e]);
        }
    }

    public static function renderPDF($id)
    {
        $order = OrdersModel::find($id);

        if (!$order) {
            return response()->json(["success" => false, "Order not found"]);
        }

        $items = OrdersItemsModel::where("order_id", "=", $order->id)
            ->leftJoinSub("select name,price,product_code,id from flex_product", "product", "product.id", "=", "flex_orders_items.product_id")
            ->get();

        foreach ($items as $item) {
            if ($item["unit"] == 0) {
                $item["unit"] = "kg";
            } else {
                $item["unit"] = "komad";
            }
            $item["total"] = round((double)$item["amount"] * (double)$item["price"], 2);
        }

        if ($order["payment_type"] == 1) {
            $order["payment_type"] = "Pla??anje gotovinski prilikom preuzimanja";
        } elseif ($order["payment_type"] == 2) {
            $order["payment_type"] = "Uplata na teku??i ra??un";
        } elseif ($order["payment_type"] == 3) {
            $order["payment_type"] = "Pla??eno karticom online";
        }
        if ($order["type"] == 0) {
            $order["type"] = "Fizi??ko lice";
        } else {
            $order["type"] = "Pravno lice";
        }
        $order["items"] = $items;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('orderPDF', ["order" => $order]);
        $output = $pdf->output();
        $path = "orders/" . Carbon::now()->year . "/" . Carbon::now()->format('m') . "/";
        $fileID = "order-" . Carbon::now()->format('d-m-Y') . "-(#" . $order->id . ").pdf";
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        File::put(public_path($path . $fileID), $output);
        $order["pdf"] = $path . $fileID;
        return self::orderPDF($order);
    }
}
