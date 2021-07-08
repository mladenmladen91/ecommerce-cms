<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Products\ProductStockModel;
use App\Models\Products\ProductsModel;
use App\Models\Discounts\DiscountsModel;
use App\Models\Images\ProductImagesModel;
use App\Models\Products\ProductCategoryModel;
use App\Models\Products\ProductSpecificationsModel;


class ProductController extends Controller
{
    public function index() {
		$categories = ProductCategoryModel::all();
		$newProducts = ProductsModel::where("new", 1)->orderBy("new_order", "ASC")->get();
		return view('frontend.product', compact(['categories', 'newProducts']));
    }
	
	public function add() {
		$discounts = DiscountsModel::all();
		return view('frontend.product-add',compact('discounts'));
    }
	
	public function edit($id) {
		$discounts = DiscountsModel::all();
		$stocks = ProductStockModel::where("product_id","=",$id)->get();
		$product = ProductsModel::where("id","=",$id)->pluck('category_id');
		$specifications = ProductSpecificationsModel::where("product_id","=",$id)->get();
		$category_id = $product[0];
		return view('frontend.product-edit',compact(['discounts','stocks','id', 'category_id', 'specifications']));
    }
	
	public function images($id) {
		$images = ProductImagesModel::where('product_id', '=', $id)->orderBy('order_number')->get();
        return view('frontend.product-images', compact(['id', 'images']));
    }
	
	public function categories() {
        $discounts = DiscountsModel::all();
		$categories = ProductCategoryModel::all();
        return view('frontend.product-category',compact(['discounts', 'categories']));
    }
	
}