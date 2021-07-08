<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Images\ProductImagesModel;
use App\Models\Products\ProductCategoryModel;
use App\Models\Products\ProductSizes;
use App\Models\Products\ProductsModel;
use App\Models\Products\ProductSpecificationsModel;
use App\Models\Products\ProductStockModel;
use App\Traits\HandleImageOptimization;
use App\Traits\HandleImageUpload;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function foo\func;

class ProductsController extends Controller
{
    use HandleImageUpload, HandleImageOptimization;

    public static function addProduct(Request $request)
    {
        $rules = [
            "name" => "required|string",
            "category_id" => "required|int",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $input = $request->except("sizes");

        $slug = $request->slug;

        $productSlug = ProductsModel::where("slug", "=", $slug)->first();

        if ($productSlug) {
            $slug = $request->slug . "-" . time();
        }

        $input["slug"] = $slug;

        $product = ProductsModel::create($input);


        /* $sizes = json_decode($request->get("sizes"));

        foreach ($sizes as $size) {
            $data = ["product_id" => $product->id, "size" => $size->size, "amount" => $size->amount];
            ProductStockModel::create($data);
        } */

        if ($request->file('specImages')) {
            $i = 0;
            foreach ($request->file('specImages') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images/specifications', $name);
                $fullName = 'images/specifications/' . $name;
                ProductSpecificationsModel::create(["product_id" =>  $product->id, "label" => $request->label[$i], "value" => $request->value[$i], "label_en" => $request->label_en[$i], "value_en" => $request->value_en[$i], "label_ru" => $request->label_ru[$i], "value_ru" => $request->value_ru[$i], "image" => $fullName]);
                $i++;
            }
        }


        if (!$product) {
            return response()->json(["success" => false, "message" => "Something went wrong"]);
        }

        if ($file = $request->file('broschure')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents/broschures', $name);
            $product->broschure = 'documents/broschures/' . $name;
            $product->save();
        }

        if ($file = $request->file('broschure_en')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents/broschures', $name);
            $product->broschure_en = 'documents/broschures/' . $name;
            $product->save();
        }

        if ($file = $request->file('broschure_ru')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents/broschures', $name);
            $product->broschure_ru = 'documents/broschures/' . $name;
            $product->save();
        }

        if ($file = $request->file('specification_background')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/background', $name);
            $product->specification_background = 'images/background/' . $name;
            $product->save();
        }


        $names = [];
        if ($request->file('images')) {
            $images = $request->file('images');

            $uploaded = self::imageUploadHandler($images, "products");

            $optimization = self::handleImageOptimization(600, true, $uploaded['images'], public_path($uploaded['path']));
            $counter = 0;
            foreach ($uploaded["images"] as $image) {
                $img = new ProductImagesModel();
                $img->image = $uploaded['path'] . $image;
                $img->product_id = $product->id;
                $img->order_number = $counter;
                $img->save();
                $counter++;
            }
        }

        $products = ProductsModel::where("category_id", "=", $request->get("category_id"))
            ->select(['id', 'flex_product.name', 'flex_product.description', 'flex_product.product_code', 'flex_product.color', 'images.image as cover'])
            ->leftJoinSub('select image, product_id from flex_product_images where order_number=0', "images", "images.product_id", "=", "flex_product.id")
            ->orderBy("id", "desc")->get();


        return response()->json(["success" => true, "products" => $products, "product" => $product]);
    }

    public static function updateProduct(Request $request)
    {
        $rules = [
            "product_id" => "required|int",
            "name" => "required|string",
            "category_id" => "required|int",
        ];

        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $product = ProductsModel::find($request->get("product_id"));

        if (!$product) {
            return response()->json(["success" => false, "message" => "Something went wrong"]);
        }

        $input = $request->except(["id", "'broschure"]);

        $slug = $request->slug;

        $productSlug = ProductsModel::where("slug", "=", $slug)->first();



        if ($productSlug && $product->id != $productSlug->id) {
            $slug = $request->slug . "-" . time();
        }

        $input["slug"] = $slug;

        $new = 0;

        if($request->new){
            $new = 1;
        }

        $input["new"] = $new;

        $special_offer = 0;

        if($request->special_offer){
            $special_offer = 1;
        }

        $input["special_offer"] = $special_offer;

        $product->update($input);

        if ($file = $request->file('broschure')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents/broschures', $name);
            $product->broschure = 'documents/broschures/' . $name;
            $product->save();
        }

        if ($file = $request->file('broschure_en')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents/broschures', $name);
            $product->broschure_en = 'documents/broschures/' . $name;
            $product->save();
        }

        if ($file = $request->file('broschure_ru')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents/broschures', $name);
            $product->broschure_ru = 'documents/broschures/' . $name;
            $product->save();
        }


        if ($file = $request->file('specification_background')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/background', $name);
            $product->specification_background = 'images/background/' . $name;
            $product->save();
        }


        if ($request->file('specImages')) {
            $i = 0;
            foreach ($request->file('specImages') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images/specifications', $name);
                $fullName = 'images/specifications/' . $name;
                ProductSpecificationsModel::create(["product_id" =>  $product->id, "label" => $request->label[$i], "value" => $request->value[$i], "label_en" => $request->label_en[$i], "value_en" => $request->value_en[$i], "label_ru" => $request->label_ru[$i], "value_ru" => $request->value_ru[$i], "image" => $fullName]);
                $i++;
            }
        }

        /*  $sizes = json_decode($request->get("sizes"));

        foreach ($sizes as $size) {
            ProductStockModel::updateOrCreate(["product_id" => $request->get("product_id"), "size" => $size->size], ["amount" => $size->amount]);
        }

        $specifications = json_decode($request->get("specifications"));


        ProductSpecificationsModel::where("product_id", "=", $request->get("product_id"))->delete();*/

        /* foreach ($specifications as $spec) {
            ProductSpecificationsModel::create(["product_id" => $request->get("product_id"), "label" => $spec->label, "value" => $spec->value]);
        }*/


        return response()->json(["success" => true, "message" => "Product successfully updated"]);
    }

    public function updateSpecification(Request $request)
    {
        $rules = [
            "id" => "required|int"
        ];

        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $specification = ProductSpecificationsModel::find($request->id);

        if (!$specification) {
            return response()->json(["success" => false, "message" => "Specification not found"]);
        }

        $input = $request->except(["id"]);

        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/specifications', $name);
            if ($specification->image) {
                unlink(public_path() . '/' . $specification->image);
            }
            $input['image'] = "images/specifications/" . $name;
        }

        $specification->update($input);

        return response()->json(["success" => true, "message" => "ProductSpecification successfully updated"]);
    }

    public static function deleteProduct(Request $request)
    {
        $rules = [
            'product_id' => 'required|int|min:0',
        ];

        $validation = ValidateHttpRequest($rules, $request);

        if ($validation) {
            return response()->json($validation);
        }

        try {
            $product = ProductsModel::find($request->get("product_id"));
            if ($product) {
                $images = ProductImagesModel::where('product_id', '=', $request->get('product_id'))->get();
                $product->delete();
                $pages = ProductsModel::all();
                $fileExtensions =
                    [".jpg", ".png", ".webp", "-min.jpg", "-min.jpg", "-min.webp", "-mobile.jpg", "-mobile.png", "-mobile.webp", "-thumbnail.jpg", "-thumbnail.png", "-thumbnail.webp"];
                $filesDeleted = [];
                foreach ($images as $image) {
                    $path_parts = pathinfo($image->image);
                    $filename = $path_parts['filename'];
                    $dirname = $path_parts['dirname'] . "/";
                    foreach ($fileExtensions as $ext) {
                        \Storage::disk('uploadImage')->delete($dirname . $filename . $ext);
                        array_push($filesDeleted, $dirname . $filename . $ext);
                    }
                }
                return ["success" => true, "message" => "Product deleted.", "status" => 200];
            } else {
                return ["success" => false, "message" => "Product not found.", "status" => 404];
            }
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e, "status" => 400];
        }
    }


    public static function deleteSpecification(Request $request)
    {
        $rules = [
            'id' => 'required|int|min:0',
        ];

        $validation = ValidateHttpRequest($rules, $request);

        if ($validation) {
            return response()->json($validation);
        }

        $specification = ProductSpecificationsModel::find($request->id);

        if (!$specification) {
            return response()->json(["success" => false, "message" => "Specification not found"]);
        }

        unlink(public_path() . '/' . $specification->image);
        $specification->delete();

        return response()->json(["success" => true, "message" => "ProductSpecification deleted"]);
    }

    public static function deleteImage(Request $request)
    {
        $rules = [
            "image" => "required|string",
            "image_id" => "required|int"
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $fileExtensions = [".jpg", ".webp", "-min.jpg", "-min.webp", "-mobile.jpg", "-mobile.webp", "-thumbnail.jpg", "-thumbnail.webp"];
        $path_parts = pathinfo($request->get("image"));
        $filename = $path_parts['filename'];
        $dirname = $path_parts['dirname'] . "/";
        $filesDeleted = [];
        try {
            ProductImagesModel::where('id', '=', $request->get('image_id'))->delete();
            foreach ($fileExtensions as $ext) {
                \Storage::disk('uploadImage')->delete($dirname . $filename . $ext);
                array_push($filesDeleted, $dirname . $filename . $ext);
            }
            return response()->json(['success' => true, 'message' => "Images deleted", 'deletedImages' => $filesDeleted]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public static function getAllProducts(Request $request)
    {
        $rules = [
            'category_id' => 'required|int|min:0',
        ];

        $validation = ValidateHttpRequest($rules, $request);

        if ($validation) {
            return response()->json($validation);
        }
        $product_code = $request->get("product_code");
        $additionalClause = "";
        if ($product_code) {
            $additionalClause = ' and product_code like "%' . $product_code . '%"';
        }
        $offset = $request->has("offset") ? $request->get("offset") : 0;
        if ($request->get("category_id") == 0) {
            $products = ProductsModel::query();
            $products = $products->select(['id', 'flex_product.name', 'flex_product.description', 'flex_product.unit', 'flex_product.views', 'flex_product.special_offer', 'flex_product.product_code', 'flex_product.order', 'images.image as cover'])->where("id", ">", 0)->where(function ($query) use ($product_code) {
                if ($product_code) {
                    $query->where("product_code", "like", "%" . $product_code . "%");
                }
            })->leftJoinSub('select image, product_id from flex_product_images where order_number=1', "images", "images.product_id", "=", "flex_product.id");
            $count = $products->count();
            $products = $products
                ->limit($request->get("limit"))
                ->offset($offset)
                ->groupBy("flex_product.id")
                ->orderBy("order")
                ->get();
            return response()->json(["success" => true, "products" => $products, "req" => $product_code, "total" => $count]);
        }
        $categories = ProductCategoryModel::where("id", "=", $request->get("category_id"))->with("childrenCategories")->get();

        $categoryList = self::deconstructTree($categories);
        $products = ProductsModel::query();
        $products = $products
            ->where("id", ">", 0)
            ->where(function ($query) use ($request, $categoryList) {
                $query
                    ->where("category_id", "=", $request->get("category_id"))
                    ->orWhere(function ($query) use ($categoryList) {
                        foreach ($categoryList as $cat) {
                            $query->orWhere("category_id", "=", $cat->id);
                        }
                    });
            })
            ->where(function ($query) use ($product_code) {
                if ($product_code) {
                    $query->where("product_code", "like", "%" . $product_code . "%");
                }
            })
            ->select(['id', 'flex_product.name', 'flex_product.description', 'flex_product.product_code', 'flex_product.views', 'flex_product.special_offer', 'flex_product.order', 'images.image as cover'])
            ->leftJoinSub('select image, product_id from flex_product_images where order_number=1', "images", "images.product_id", "=", "flex_product.id");
        $count = $products->count();
        $products = $products
            ->orderBy("order")
            ->groupBy("flex_product.id")
            ->limit($request->get("limit"))
            ->offset($offset)
            ->get();


        return response()->json(["success" => true, "products" => $products, "cat" => $categoryList, "total" => $count]);
    }

    public static function getAllProductsRabat()
    {
        return response()->json(["success" => true, "products" => ProductsModel::all()]);
    }


    private static function deconstructTree($data)
    {
        $result = [];
        function recursiveDeconstruction($arr, &$res)
        {
            foreach ($arr as $a) {
                if (count($a->childrenCategories) > 0) {
                    recursiveDeconstruction($a->childrenCategories, $res);
                } else {
                    array_push($res, $a);
                }
            }
        }

        recursiveDeconstruction($data, $result);

        return $result;
    }

    public static function getAllProductsForSorting(Request $request)
    {
        $rules = [
            'category_id' => 'required|int|min:0',
        ];

        $validation = ValidateHttpRequest($rules, $request);

        if ($validation) {
            return response()->json($validation);
        }
        $products = ProductsModel::select(["id", "name", "order", "category_id"])
            ->where("category_id", "=", $request->get("category_id"))
            ->orderBy("order")
            ->get();

        if (!$products) {
            return response()->json(["success" => false, "message" => "Something went wrong"]);
        }

        return response()->json(["success" => true, "products" => $products]);
    }

    public static function getProduct(Request $request)
    {
        $rules = [
            'id' => 'required|int',
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json($validation);
        }

        $product = ProductsModel::find($request->get("id"));
        $images = ProductImagesModel::where("product_id", "=", $request->get("id"))->orderBy("order_number")->get();
        $specifications = self::getProductSpecifications($request->get("id"));
        $stock = ProductStockModel::where("product_id", "=", $request->get("id"))->get();
        if (!$product) {
            return response()->json(["success" => false, "message" => "Product not found"]);
        }

        return response()->json(["success" => true, "product" => $product, "images" => $images, "specifications" => $specifications, "sizes" => $stock]);
    }

    public static function addProductCategory(Request $request)
    {
        $rules = [
            "name" => "required|string",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }

        $parent_id = $request->parent_id;
        if ($parent_id != "") {
            $max = ProductCategoryModel::where('parent_id', '=', $parent_id)->max('order');
        } else {
            $max = 0;
        }

        $category = ProductCategoryModel::create($request->all());

        if (!$category) {
            return response()->json(["success" => false, "message" => "Something went wrong"]);
        }

        $category->order = $max + 1;
        $category->save();

        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/categories', $name);
            $category->image = 'images/categories/' . $name;
            $category->save();
            // $input['image'] = 'images/' . $name;
        }

        return response()->json(["success" => true, "categories" => self::fetchMenuItems()]);
    }

    public static function getAllProductCategory(Request $request)
    {
        $categories = self::fetchMenuItems();
        if (!$categories) {
            return response()->json(["success" => false, "message" => "No items found"]);
        }
        return response()->json(["success" => true, "categories" => $categories]);
    }

    private static function build_tree(&$items, $parent = 0)
    {
        $tmp_array = [];
        foreach ($items as $item) {
            if ($item->parent_id == $parent) {
                $item->children = self::build_tree($items, $item->id);
                $tmp_array[] = $item;
            }
        }
        return $tmp_array;
    }

    private static function fetchMenuItems()
    {
        $menuItems = ProductCategoryModel::orderBy("order")->get();
        return self::build_tree($menuItems);
    }

    public static function sortCategories(Request $request)
    {
        $menus = $request->get("categories");
        $counter = 1;
        foreach ($menus as $menu) {
            $m = ProductCategoryModel::where('id', '=', $menu['id'])->update(['order' => $counter]);
            $counter++;
        }
        return response()->json(["success" => true, "menus" => $menus]);
    }

    public static function editProductCategory(Request $request)
    {
        $rules = [
            "id" => "required|int",
            "name" => "required|string",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }
        $item = ProductCategoryModel::find($request->get("id"));

        $categories = ProductCategoryModel::where("id", "=", $request->get("id"))->with("childrenCategories")->get();

        $categoryList = self::deconstructTree($categories);
        $products = ProductsModel::query();
        $products = $products
            ->where("id", ">", 0)
            ->where(function ($query) use ($request, $categoryList) {
                $query
                    ->where("category_id", "=", $request->get("category_id"))
                    ->orWhere(function ($query) use ($categoryList) {
                        foreach ($categoryList as $cat) {
                            $query->orWhere("category_id", "=", $cat->id);
                        }
                    });
            })
            ->select(['id']);
        $products = $products
            ->orderBy("order")
            ->groupBy("flex_product.id")
            ->get();
        $newProducts = [];
        foreach ($products as $p) {
            array_push($newProducts, $p->id);
        }

        ProductsModel::whereIn("id", $newProducts)->update(["discount_id" => $request->get("discount_id")]);

        if (!$item) {
            return response()->json(["success" => false, "message" => "Menu item not found"]);
        }

        $item->update($request->except(["id", "image"]));

        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/categories', $name);
            $item->image = 'images/categories/' . $name;
            $item->save();
        }
        return response()->json(["success" => true, "categories" => self::fetchMenuItems()]);
    }

    public static function deleteProductCategory(Request $request)
    {
        $rules = [
            "id" => "required|int"
        ];

        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }
        $category = ProductCategoryModel::find($request->get("id"));
        try {
            $category->delete();
            return response()->json(["success" => true, "categories" => self::fetchMenuItems()]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e]);
        }
    }

    public static function addImages(Request $request)
    {
        $images = $request->file('images');
        $product_id = $request->get('product_id');
        $uploaded = self::imageUploadHandler($images, "products");
        $max = ProductImagesModel::where('product_id', '=', $product_id)->max('order_number');
        $optimization = self::handleImageOptimization(600, true, $uploaded['images'], public_path($uploaded['path']));
        $counter = $max + 1;
        foreach ($uploaded["images"] as $image) {
            $img = new ProductImagesModel();
            $img->image = $uploaded['path'] . $image;
            $img->product_id = $product_id;
            $img->order_number = $counter;
            $img->save();
            $counter++;
        }
        return response()->json(["success" => true, "message" => "Images successfully uploaded.", "status" => 200]);
    }

    public static function sortProducts(Request $request)
    {
        $menus = $request->get("products");
        $counter = 0;
        foreach ($menus as $menu) {
            $m = ProductsModel::where('id', '=', $menu['id'])->update(['order' => $counter]);
            $counter++;
        }
        return response()->json(["success" => true]);
    }

    public static function sortNewProducts(Request $request)
    {
        $menus = $request->get("products");
        $counter = 0;
        foreach ($menus as $menu) {
            $m = ProductsModel::where('id', '=', $menu['id'])->update(['new_order' => $counter]);
            $counter++;
        }
        return response()->json(["success" => true]);
    }

    public static function sortImages(Request $request)
    {
        $images = $request->get('images');


        $orderArray = [];

        foreach ($images as $image) {
            array_push($orderArray, ProductImagesModel::where('id', '=', $image['id'])->value("order_number"));
        }

        sort($orderArray);


        $counter = 0;
        foreach ($images as $image) {
            $img = ProductImagesModel::where('id', '=', $image['id'])->update(['order_number' => $orderArray[$counter]]);
            $counter++;
        }
    }


    public static function listImages(Request $request)
    {

        $id = $request->get('product_id');

        $images = ProductImagesModel::where('product_id', '=', $id)->orderBy('order_number')->get();
        if ($images) {
            return ["success" => true, "products" => $images];
        } else {
            return ["success" => false, "message" => "No pages found", "status" => 404];
        }
    }



    public static function getAllSizes()
    {
        return response()->json(["success" => true, "sizes" => ProductSizes::orderBy("name", "desc")->get()]);
    }

    private static function unique_key($array, $keyname)
    {
        $new_array = array();
        foreach ($array as $key => $value) {

            if (!isset($new_array[$value[$keyname]])) {
                $new_array[$value[$keyname]] = $value;
            }
        }
        $new_array = array_values($new_array);
        return $new_array;
    }

    public static function syncProducts()
    {

        $json = file_get_contents('http://android.pos4.me:8125/Benetton.aspx/?u=b2b&p=!b2b!&t=b2bLagerListaOsobine&idm=3&idp=');
        $json2 = file_get_contents('http://android.pos4.me:8125/Benetton.aspx/?u=b2b&p=!b2b!&t=b2bLagerListaOsobine&idm=4&idp=');
        $obj = json_decode($json);
        $obj2 = json_decode($json2);

        $obj_merged = (object)array_merge(
            (array)$obj,
            (array)$obj2
        );
        $arr = [];
        //        $unique = self::unique_key($obj, "sifra");
        foreach ($obj_merged as $o) {
            $code = strlen($o->sifra) === 9 ? $o->sifra : substr($o->sifra, 0, -1);
            $product = ProductsModel::where("product_code", "like", "%" . $o->sifra . "%")
                ->where("color", "like", $o->color)
                ->first();
            if (!$product) {
                $product = ProductsModel::create(["product_code" => $o->sifra, "color" => $o->color, "category_id" => 290, "name" => $o->naziv, "price" => $o->cijena]);
                $s = ProductSizes::firstOrCreate(["name" => $o->size]);
                ProductStockModel::updateOrCreate(["product_id" => $product->id, "product_size_id" => $s->id], ["amount" => $o->kolicina]);
                continue;
            } else {
                $product->price = $o->cijena;
                $product->save();
                array_push($arr, $product->product_code);
                $s = ProductSizes::firstOrCreate(["name" => $o->size]);
                ProductStockModel::updateOrCreate(["product_id" => $product->id, "product_size_id" => $s->id], ["amount" => $o->kolicina]);
            }
        }
        return response()->json(["success" => true, "message" => "DB synchronized successfully"]);
    }

    public static function getNewProducts()
    {
        try {
            $data = \Storage::disk("uploadImage")->get("data.json");
            $data = json_decode($data);
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            foreach ($data->products as $d) {
                $cat = explode("|", $d->category);
                $categories = $cat;
                array_pop($categories);
                $cc = 0;
                $category = 0;
                $parent_cat = null;
                foreach ($categories as $c) {
                    $category = ProductCategoryModel::firstOrCreate(["name" => $c, "parent_id" => $parent_cat], ["level" => $cc]);
                    $parent_cat = $category->id;
                    $cc++;
                }
                $product = ProductsModel::create(
                    [
                        "name" => end($cat),
                        "description" => ucfirst($d->description),
                        "category_id" => $category->id
                    ]
                );
                $counter = 0;
                foreach ($d->images as $image) {
                    //                    $contents = file_get_contents($image, false, stream_context_create($arrContextOptions));
                    $name = "images/products/" . Carbon::now()->year . "/" . Carbon::now()->format('m') . "/" . substr($image, strrpos($image, '/') + 1);
                    //                    \Storage::disk("uploadImage")->put($name, $contents);
                    ProductImagesModel::create(
                        [
                            "product_id" => $product->id,
                            "image" => $name,
                            "order_number" => $counter
                        ]
                    );
                    $counter++;
                }
                foreach ($d->specifications as $spec) {
                    ProductSpecificationsModel::create([
                        "product_id" => $product->id,
                        "label" => $spec->label,
                        "value" => $spec->value
                    ]);
                }
            }
        } catch (FileNotFoundException $e) {
            var_dump($e);
        }
    }

    public static function getNewZene()
    {
        $data = \Storage::disk("uploadImage")->get("data.json");
        $data = json_decode($data);
        $arr = [];
        foreach ($data->products as $d) {
            $cat = explode("|", $d->category);
            if ($cat[0] === "Žene") {
                array_push($arr, $d);
            }
        }
    }

    private static function removeFromArray($value, $array)
    {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }

    public static function updateCategories()
    {
        $products = ProductCategoryModel::all();

        foreach ($products as $p) {
            $p->slug = self::slugify($p->name);
            $p->save();
        }
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function toggleSpecialOffer(Request $request)
    {
        $rules = [
            'id' => 'required|int',
            'offer' => "required"
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json($validation);
        }

        $product = ProductsModel::find($request->get("id"))->update(["special_offer" => $request->get("offer")]);

        if (!$product) {
            return response()->json(["success" => false, "message" => "Product not found"]);
        }

        return response()->json(["success" => true, "product" => $product]);
    }

    private static function getProductSpecifications($id)
    {
        return ProductSpecificationsModel::where("product_id", "=", $id)->get();
    }

    public static function getSearchProducts(Request $request)
    {
        $rules = [
            'product_code' => 'required',
        ];

        $validation = ValidateHttpRequest($rules, $request);

        if ($validation) {
            return response()->json($validation);
        }
        $product_code = $request->get("product_code");
        /*$additionalClause = "";
        if ($product_code) {
            $additionalClause = ' and product_code like "%' . $product_code . '%"';
        } */

        $products = ProductsModel::query();
        $products = $products->select(['id', 'flex_product.name', 'flex_product.description', 'flex_product.unit', 'flex_product.views', 'flex_product.special_offer', 'flex_product.product_code', 'flex_product.order', 'images.image as cover'])->where("product_code", "like", "%" . $product_code . "%")->orWhere("name", "like", "%" . $product_code . "%")->leftJoinSub('select image, product_id from flex_product_images where order_number=1', "images", "images.product_id", "=", "flex_product.id");
        $count = $products->count();
        $products = $products
            ->groupBy("flex_product.id")
            ->orderBy("order")
            ->get();
        return response()->json(["success" => true, "products" => $products]);
    }

    public static function getAllChildrenCategories(Request $request)
    {
        $rules = [
            "id" => "required|int",
        ];
        $validation = ValidateHttpRequest($rules, $request);
        if ($validation) {
            return response()->json(array_merge($validation));
        }
        $productItems = ProductCategoryModel::where("parent_id", "=", $request->get("id"))->orderBy("order")->get();
        if (!$productItems) {
            return response()->json(["success" => false, "message" => "Items not found"]);
        }
        return response()->json(["success" => true, "items" => $productItems]);
    }

    //    public static function renameImages()
    //    {
    //        try {
    //            $data = \Storage::disk("uploadImage")->get("data.json");
    //            $data = json_decode($data);
    //            foreach ($data->products as $d) {
    //                $category = explode("|", $d->category);
    //                if ($category[0] == "Putni program") {
    //                    $product = ProductsModel::where("product_code", "=", $d->product_code)->where("color", "=", $d->product_color)->first();
    //                    $counter = 0;
    //                    foreach ($d->images as $image) {
    //                        $pathinfo = pathinfo($image);
    //                        $ext = $pathinfo["extension"];
    //                        if ($ext == "png") {
    //                            $newPath = "images/products/2020/04/" . $pathinfo["basename"];
    //                            ProductImagesModel::where("product_id", "=", $product->id)
    //                                ->where("order_number", "=", $counter)
    //                                ->update(["image" => $newPath]);
    //                        }
    //
    //                        $counter++;
    //
    //                    }
    //                }
    //
    //            }
    //        } catch (FileNotFoundException $e) {
    //            var_dump($e);
    //        }
    //    }
}
