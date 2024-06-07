<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailsController extends Controller
{
    public function index(Request $request){

        $product = Product::whereId($request->id)->first();

        return view('frontend.product',compact('product'));
    }

    public function search(Request $request){
        $query = $request->input('query');

        $products = Product::where('name', 'like', "%$query%")
                          ->get();
        
        return view('frontend.product-search', compact('products', 'query'));
    }
}
