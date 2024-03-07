<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Request $request, $id) {

        $getCategory = ProductCategory::find($id);
        
        $getSubCategory = ProductSubCategory::where('category_id', $id)->get();
        
        $products = Product::get();

        return view('frontend.category',compact('getSubCategory', 'getCategory', 'products'));
    }
}
