<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
   
    public function addToCart(Request $request)
    {
        $productId = $request->productId;
        $quantity = '1';

        // Retrieve cart from session
        $cart = session()->get('cart', []);

        // Update cart with new product or increment quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
                'productName' => $request->productName,
                'productUnit' => $request->productUnit,
                'productPrice' => $request->productPrice,
            ];
        }

        // Store cart back into session
        session()->put('cart', $cart);

        return response()->json(['message' => $cart]);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        // Pass cart data to the view
        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->productId;
        $quantity = 1;

        // Retrieve cart from session
        $cart = session()->get('cart', []);

        
        // Remove product from cart
        
            if ((isset($cart[$productId]) && $cart[$productId]['quantity'] == 1) || $request->removeAll === 'true') {
                unset($cart[$productId]);
            }
            else{
                $cart[$productId]['quantity']--;
            }

        

        // Store updated cart back into session
        session()->put('cart', $cart);

        return response()->json(['message' => $cart]);
    }
    
}
