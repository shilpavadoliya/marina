<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Userbillingdetails;

use Illuminate\Support\Facades\Notification;

use App\Notifications\OrderPlacedNotification;
use App\Notifications\AdminOrderNotification;

use Auth;

class OrderController extends Controller
{
    public function index(Request $request){

        if (!auth()->check()) {
            session()->put('prevLink', redirect()->back()->getTargetUrl('create-order'));
            
            return redirect()->route('login');
        }else {
            if(session()->has('cart') && count(session()->get('cart')) > 0){

                $oldPendignOrder = Order::where('user_id', Auth::user()->id)->where('status','pending')->first();

                if($oldPendignOrder) {
                    $order = $oldPendignOrder;
                    $orderItem = OrderItem::where('order_id', $order->id)->get();

                }else {
                    $cart = session()->get('cart', []);

                    $order = new Order();
                    $order->user_id = auth()->user()->id;
                    $order->order_number = uniqid();
                    $order->total_amount = 0; // Calculate total amount
                    $order->save();

                    foreach ($cart as $cart=>$item) {
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->product_id = $cart;
                        $orderItem->product_name = $item['productName'];
                        $orderItem->product_unit = $item['productUnit'];
                        $orderItem->product_price = $item['productPrice'];
                        $orderItem->quantity = $item['quantity'];
                        $orderItem->save();
                        $order->total_amount += $item['productPrice'] * $item['quantity'];
                    }
                    $order->save();

                }
                
                $userbillingdetails = Userbillingdetails::where('user_id', Auth::user()->id)->first();
                

                return view('frontend.checkout',compact('order', 'orderItem', 'userbillingdetails'));
            }
        }
    }

    public function getShoppingCart(Request $request){

        return view('frontend.shopping-cart');
    }

    public function orderStatus(Request $request){
        $order = Order::where('order_number', $request->order_number)->first();
        $order->status = 'completed';
        $order->save();

        $order = Order::where('order_number', $request->order_number)->with('user', 'items')->first();

        Notification::route('mail', Auth()->user()->email)->notify(new OrderPlacedNotification($order));

        Notification::route('mail', env('MAIL_ADMIN_ADDRESS'))->notify(new AdminOrderNotification($order));

        session()->forget('cart');
        
        return redirect()->route('thankyou', ['orderId' => $request->order_number]);
    }

    public function thankyou($orderId){
        return view('frontend.thankyou')->with('orderId', $orderId);
    }
}
