<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Userbillingdetails;
use App\Models\Usershippingdetails;
use App\Models\User;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userbillingdetails = Userbillingdetails::where('user_id', Auth::user()->id)->first();
        $usershippingdetails = Usershippingdetails::where('user_id', Auth::user()->id)->first();
        
        return view('frontend.myAccount.my-account-address', compact('userbillingdetails', 'usershippingdetails'));
    }

    public function editBillingAddress(){
        $user = Userbillingdetails::where('user_id', Auth::user()->id)->first();

        return view('frontend.myAccount.billingAddress', compact('user'));
    }

    public function updateBillingAddress(Request $request){

        $user = Userbillingdetails::where('user_id', $request->user_id)->first();

        if ($user) {
            $user->update($request->all());
        } else {
            Userbillingdetails::create($request->all());
        }

        return redirect()->route('myaccount-address');
    }

    public function editShippingAddress(){
        $user = Usershippingdetails::where('user_id', Auth::user()->id)->first();

        return view('frontend.myAccount.shippingAddress', compact('user'));
    }

    public function updateShippingAddress(Request $request){

        $user = Usershippingdetails::where('user_id', $request->user_id)->first();

        if ($user) {
            $user->update($request->all());
        } else {
            Usershippingdetails::create($request->all());
        }

        return redirect()->route('myaccount-address');
    }
}
