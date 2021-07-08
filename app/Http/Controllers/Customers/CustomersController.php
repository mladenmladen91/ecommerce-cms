<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customers\CustomersModel;
use App\Models\Customers\CustomersRabat;
use App\Models\Products\ProductsModel;
use App\Traits\Mail\MailingTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    use MailingTraits;

    public static function register(Request $request)
    {
        $rules = [
            "name" => "required|string",
            "email" => "required|email|unique:flex_customers",
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
            "phone" => "required",
            "address" => "required",
            "city" => "required",
            "type" => "required|int"
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $request['token'] = \Str::random(64);
        $request["password"] = md5($request->get("password"));

        $customer = CustomersModel::create($request->all());

        if (!$customer) {
            return response()->json(["success" => false, "message" => "Something went wrong"]);
        }

        $name = $request->get("name");
        $link = env("ADMIN_URL") . "/confirm/" . $request->get("token");
        $email = $request->get("email");
        self::confirmRegistration(["name" => $name, "link" => $link, "email" => $email]);

        return response()->json(["success" => true, "message" => "Confirmation mail sent"]);
    }

    public static function confirmUser($token)
    {
        $customer = CustomersModel::where("token", "=", $token)->first();

        if (!$customer) {
            return redirect(env("APP_URL") . "/wrong-credentials");
        }

        $customer->token = null;
        $customer->active = true;
        $customer->save();
        return redirect(env("APP_URL") . "/account-confirmed");

    }

    public static function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        $validation = ValidateHttpRequest($rules, $request->all(), true);

        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $user = CustomersModel::where("email", "=", $request->get("email"))
            ->where("password", "=", md5($request->get("password")))
            ->where("active", "=", 1)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong login credentials.',
                "req" => $request->all(),
                "pw" => md5($request->get("password"))
            ], 200);
        }


        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    public static function getAllCustomers(Request $request)
    {
        $limit = $request->get("limit");
        $offset = $request->get("offset");
        if ($request->has("customer_type")) {

            $customers = CustomersModel::where("type", "=", "1")->limit($limit)->offset($offset)->get();
            return response()->json(["success" => true, "customers" => $customers]);
        }
        $customers = CustomersModel::limit($limit)->offset($offset)->get();
        return response()->json(["success" => true, "customers" => $customers]);
    }

    public static function getCustomer(Request $request)
    {
        $customer = CustomersModel::find($request->get("customer_id"));
        $rabat = CustomersRabat::select(["flex_customers_rabat.customer_id", "flex_customers_rabat.product_id", "flex_customers_rabat.discount_id"])
            ->where("customer_id", "=", $customer->id);
        if (!$customer) {
            return response()->json(["success" => false, "message" => "Customer not found"]);
        }

        return response()->json(["success" => true, "customer" => $customer]);
    }

    public static function updateCustomersRabat(Request $request)
    {
        $specifications = json_decode($request->get("specifications"));

        foreach ($specifications as $spec) {
            if ($spec->discount_type === 0) {
                CustomersRabat::create(["customer_id" => $request->get("id"), "product_id" => $spec->product_id, "discount_id" => $spec->discount_id]);
                return response()->json(["success" => true, "message" => "Update successful"]);
            }
            $products = ProductsModel::where("category_id", "=", $spec->product_id)->get();
            foreach ($products as $p) {
                CustomersRabat::create(["customer_id" => $request->get("id"), "product_id" => $p->id, "discount_id" => $spec->discount_id]);
            }
            return response()->json(["success" => true, "message" => "Update successful"]);
        }

    }
}
