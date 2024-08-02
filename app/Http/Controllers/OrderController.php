<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Userbillingdetails;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\AdminOrderNotification;
use App\Notifications\OrderCancelNotification;

use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use App\Services\BrevoSmsService;

use Auth;

class OrderController extends Controller
{
    protected $brevo;
    protected $brevoSmsService;

    public function __construct(TransactionalEmailsApi $brevo, BrevoSmsService $brevoSmsService)
    {
        $this->brevo = $brevo;
        $this->brevoSmsService = $brevoSmsService;
    }

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
    
            }
            
            
            // if($pendingOrder) {
            //     $order = $pendingOrder;
            //     $orderItems = PurchaseItem::where('purchase_id', $order->id)->with('product')->get();
            // }

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
        session()->forget('cart');
        
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
        $pincode = session()->get('pincode') ?? '360006';
        $supplier = Supplier::whereRaw("FIND_IN_SET('$pincode', area_pin_code)")->first();
        
        $order = Purchase::where('reference_code', $request->order_number)->first();
        $order->supplier_id = $supplier->id ?? '1';
        $order->warehouse_id = $user_id->id ?? '1';
        $order->status = 1;
        $order->is_customer = 2;
        $order->save();

        $order = Purchase::where('reference_code', $request->order_number)->with('purchaseItems')->first();
        $orderItem = PurchaseItem::where('purchase_id', $order->id)->with('product')->get();
        $user = User::where('id', $order->user_id)->with('Userbillingdetail')->first();
        
        $phone = "917486079917";
        $message = "Test";

        // $response = $this->brevoSmsService->sendSms($phone, $message);

        // $this->sendOrderCustomerEmail(Auth()->user()->email, $order, $orderItem, $user);
        // $this->sendOrderCustomerEmail(env('MAIL_ADMIN_ADDRESS'), $order, $orderItem, $user);
        // $this->sendOrderCustomerEmail($supplier->email, $order, $orderItem, $user);

        Notification::route('mail', Auth()->user()->email)->notify(new AdminOrderNotification($order, $orderItem, $user));
        Notification::route('mail', env('MAIL_ADMIN_ADDRESS'))->notify(new AdminOrderNotification($order, $orderItem, $user));
        Notification::route('mail', $supplier->email)->notify(new AdminOrderNotification($order, $orderItem, $user));
        
        return redirect()->route('thankyou', ['orderId' => $request->order_number]);
    }

    public function thankyou($orderId)
    {
        return view('frontend.thankyou')->with('orderId', $orderId);
    }

    public function pincodeCheck(Request $request) 
    {
        $supplier = Supplier::whereRaw("FIND_IN_SET(?, area_pin_code)", [$request->pincode])->first();
        
        if ($supplier) {
            
            $pincode = session()->put('pincode',$request->pincode);
            return response()->json(['available' => true]);
        } else {
            return response()->json(['available' => false]);
        }

    }

    protected function sendOrderCustomerEmail($email, $order, $orderItem, $user)
    {
        $orderItems = [];
        foreach ($orderItem as $item) {
            $orderItems = [
                'name' => $item->product->name,
                'quantity' => $item->quantity??1,
                'price' => $item->product_cost,
            ];
        }

        $email = new SendSmtpEmail();
        $email['to'] = [['email' => $email]];
        $email['templateId'] = 1;
        $email['params'] = [
            'CUSTOMER_NAME' => $user->first_name,
            'ORDER_ID' => $order->reference_code,
            'ORDER_DATE' => date('Y-m-d'),
            'CUSTOMER_ADDRESS' => $user->Userbillingdetail->address,
            'ORDER_ITEMS' => $orderItems,
            'GRAND_TOTAL' => $order->grand_total,
        ];

        try {
            $this->brevo->sendTransacEmail($email);
        } catch (Exception $e) {
            // Handle the exception
            \Log::error('Error sending email: ' . $e->getMessage());
        }

        // Free up memory
        unset($orderItems, $email);
    }

    public function orderCancel(Request $request) {
        $order = Purchase::where('reference_code', $request->order_id)->with('purchaseItems')->first();
        $order->status = 4;
        $order->save();

        $pincode = session()->get('pincode') ?? '360006';
        $supplier = Supplier::whereRaw("FIND_IN_SET('$pincode', area_pin_code)")->first();

        $orderItem = PurchaseItem::where('purchase_id', $order->id)->with('product')->get();
        $user = User::where('id', $order->user_id)->with('Userbillingdetail')->first();

        Notification::route('mail', Auth()->user()->email)->notify(new OrderCancelNotification($order, $orderItem, $user));
        Notification::route('mail', env('MAIL_ADMIN_ADDRESS'))->notify(new OrderCancelNotification($order, $orderItem, $user));
        Notification::route('mail', $supplier->email)->notify(new OrderCancelNotification($order, $orderItem, $user));

        return redirect()->route('myaccount-order');
    }

    public function submitPaymentForm(Request $request) {
        $merchantId = 'PGTESTPAYUAT77';
        $apiKey = '14fa5465-f8a7-443f-8477-f986b8fcfde9';
        $redirectUrl = route('confirm');
        $order_id = uniqid(); 
        $amount = 100;

        $transaction_data = array(
            'merchantId' => "$merchantId",
            'merchantTransactionId' => "$order_id",
            "merchantUserId"=>$order_id,
            'amount' => $amount*100,
            'redirectUrl'=>"$redirectUrl",
            'redirectMode'=>"POST",
            'callbackUrl'=>"$redirectUrl",
            "paymentInstrument"=> array(    
                "type"=> "PAY_PAGE",
            )
        );

        $encode = json_encode($transaction_data);
        $payloadMain = base64_encode($encode);
        $salt_index = 1; //key index 1
        $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $salt_index;
        $request = json_encode(array('request'=>$payloadMain));
        

        
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: " . $final_x_header,
        "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res = json_decode($response);
        }
          
    }

    
    public function confirmPayment(Request $request) {
            
        if($request->code == 'PAYMENT_SUCCESS'){
            $transactionId = $request->transactionId;
            $merchantId=$request->merchantId;
            $providerReferenceId=$request->providerReferenceId;
            $merchantOrderId=$request->merchantOrderId;
            $checksum=$request->checksum;
            $status=$request->code;
    
            //Transaction completed, You can add transaction details into database
            $data = [
                'providerReferenceId' => $providerReferenceId,
                'checksum' => $checksum,
            ];

            if($merchantOrderId !=''){
                $data['merchantOrderId']=$merchantOrderId;
            }

            Payment::where('transaction_id', $transactionId)->update($data); 

            return view('confirm_payment',compact('providerReferenceId', 'transactionId'));

        }else{
            dd('ERROR : ' .$request->code. ', Please Try Again Later.');
        }
    }

}
                                        