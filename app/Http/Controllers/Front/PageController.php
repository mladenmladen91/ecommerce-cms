<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\PagesCategoryModel;
use App\Models\Pages\PagesContentModel;

class PageController extends Controller
{
    public function index() {
		$categories = PagesCategoryModel::all();
        return view('frontend.page', compact('categories'));
    }
	
	public function add(){
		$categories = PagesCategoryModel::all();
        return view('frontend.page-add', compact('categories'));
	}
	
	public function edit($id){
		$page = PagesContentModel::where("page_id","=",$id)->get()->first();
		$slug = $page->slug;
		
		$categories = PagesCategoryModel::all();
        return view('frontend.page-edit', compact(['categories', 'id', 'slug']));
	}
	
	public function images($id) {
        return view('frontend.page-images', compact('id'));
    }
	
	public function categories() {

        return view('frontend.page-category');
    }
}