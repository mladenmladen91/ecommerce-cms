<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    public function index() {
		return view('frontend.orders');
    }
	
	public function details($id) {
		return view('frontend.order-details', compact('id'));
    }
	
}