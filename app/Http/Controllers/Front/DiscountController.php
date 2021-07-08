<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;


class DiscountController extends Controller
{
    public function index() {
		return view('frontend.discounts');
    }
	
}