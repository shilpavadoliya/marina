<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;

class ProductDetailsController extends Controller
{
    public function index(Request $request){

        $product = Product::whereId($request->id)->first();

        $products = Product::where('product_type', 2)->whereNot('id',$request->id)->with('stock')->get();

        $supplier = Supplier::where('area_pin_code', 'LIKE', '%'.session()->get('pincode').'%')->first();

        return view('frontend.product',compact('product', 'supplier', 'products'));
    }

    public function search(Request $request){
        $query = $request->input('query');

        $products = Product::where('name', 'like', "%$query%")->where('product_type', 2)
                          ->get();
        
        return view('frontend.product-search', compact('products', 'query'));
    }
}
