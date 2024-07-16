<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function add(Product $product)
    {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to wishlist.');
    }

    public function remove(Product $product)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Product removed from wishlist.');
    }
}
