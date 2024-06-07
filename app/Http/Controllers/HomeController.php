<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index() {
        $getCategory = ProductCategory::getCategory();
        
        return view('frontend.index',compact('getCategory'));
    }
}