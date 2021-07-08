<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pages\PagesContentModel;
use App\Models\Menus\MenusModelContent;

class MenusController extends Controller
{
    public function index() {
        return view('frontend.menu');
    }
	
	public function items($id) {
		$pages = PagesContentModel::all();
		$menuItems = MenusModelContent::all();
        return view('frontend.menu-items', compact(['pages','id', 'menuItems']));
    }
}
