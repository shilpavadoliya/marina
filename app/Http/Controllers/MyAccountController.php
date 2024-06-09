<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Order;   

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.myAccount.my-account');
    }

    public function myAccountOrder()
    {
        $order = Order::where('user_id', Auth()->user()->id)->with('items')->get();

        return view('frontend.myAccount.my-account-orders', compact('order'));
    }

    public function myAccountOrderDetails($orderId)
    {
        $order = OrderItem::where('order_id', $orderId)->get();
        
        return view('frontend.myAccount.my-account-order-details', compact('order'));
    }

    public function myAccountDetails()
    {   
        $user = Auth::user();
        return view('frontend.myAccount.my-account-details', compact('user'));
    }

    public function myAccountWishlist()
    {
        return view('frontend.myAccount.my-account-wishlist');
    }

    public function updateDetails(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
