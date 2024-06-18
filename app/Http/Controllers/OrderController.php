<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Userbillingdetails;
use App\Models\Supplier;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\AdminOrderNotification;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            session()->put('prevLink', redirect()->back()->getTargetUrl('create-order'));
            return redirect()->route('login');
        }

        else {
            if (session()->has('cart') && count(session()->get('cart')) > 0) {
                
                $cart = session()->get('cart', []);
                $order = new Purchase();
                $order->date = date('y-m-d');
                $order->user_id = auth()->user()->id;
                $order->reference_code = uniqid();
                $order->payment_type = 0; // Calculate total amount
                $order->status = 2; // Calculate total amount
                $order->is_customer = 2;
                $order->save();
                
                $orderItems = []; // Initialize orderItems array

                foreach ($cart as $cartItemKey => $item) {
                    $orderItem = new PurchaseItem();
                    $orderItem->purchase_id = $order->id;
                    $orderItem->product_id = $cartItemKey;
                    $orderItem->product_cost = $item['productPrice'];
                    $orderItem->purchase_unit = $item['quantity'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->sub_total = $item['productPrice'];
                    $orderItem->save();

                    $order->grand_total += $item['productPrice'] * $item['quantity'];
                    $order->paid_amount += $item['productPrice'] * $item['quantity'];
                    $orderItems[] = $orderItem; // Collect order items
                }
                $order->save();
                
                session()->forget('cart');
    
            }
            
            $pendingOrder = Purchase::where('user_id', Auth::user()->id)
                ->where('status', '2')
                ->first();
            
            if($pendingOrder) {
                $order = $pendingOrder;
                $orderItems = PurchaseItem::where('purchase_id', $order->id)->with('product')->get();
            }

            $userbillingdetails = Userbillingdetails::where('user_id', Auth::user()->id)->first();
    
            return view('frontend.checkout', compact('order', 'orderItems', 'userbillingdetails'));

        }

        
    }

    public function getShoppingCart(Request $request)
    {
        return view('frontend.shopping-cart');
    }

    public function orderStatus(Request $request)
    {
        // Update Customer Billing
        $user = Auth::user();

        $userBillingDetails = Userbillingdetails::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name ?? '',
                'last_name' => $request->last_name ?? '',
                'company_name' => $request->company_name ?? '',
                'address' => $request->address ?? '',
                'city' => $request->city ?? '',
                'state' => $request->state ?? '',
                'pin_code' => $request->pin_code ?? '',
                'phone' => $request->phone ?? '',
                'email' => $request->email_address ?? '',
            ]
        );
        
        // Update Order
        $supplier = Supplier::where('area_pin_code', 'LIKE', '%'.$request->pin_code??'360006'.'%')->first();
        
        $order = Purchase::where('reference_code', $request->order_number)->first();
        $order->supplier_id = $supplier->id ?? '1';
        $order->warehouse_id = $user_id->id ?? '1';
        $order->status = 3;
        $order->is_customer = 2;
        $order->save();

        $order = Purchase::where('reference_code', $request->order_number)->with('purchaseItems')->first();

        Notification::route('mail', Auth()->user()->email)->notify(new OrderPlacedNotification($order));
        // Notification::route('mail', env('MAIL_ADMIN_ADDRESS'))->notify(new AdminOrderNotification($order));

        return redirect()->route('thankyou', ['orderId' => $request->order_number]);
    }

    public function thankyou($orderId)
    {
        return view('frontend.thankyou')->with('orderId', $orderId);
    }
}
