<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userbillingdetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Mail\WelcomeEmail;
use App\Mail\NewUserRegistered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

     protected function redirectTo()
     {
         if(session()->has('prevLink')){
             return session()->get('prevLink');
         }
         return redirect()->route('home');
     }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Mail::to($data['email'])->send(new WelcomeEmail($data));

        Mail::to(env('MAIL_ADMIN_ADDRESS'))->send(new NewUserRegistered($data));

        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        
        Userbillingdetails::create(
            [
                'user_id'=> $user->id,
                'first_name' => $data['first_name'] ?? '',
                'last_name' => $data['last_name'] ?? '',
                'company_name' => $data['company_name'] ?? '',
                'address' => $data['address'] ?? '',
                'city' => $data['city'] ?? '',
                'state' => $data['state'] ?? '',
                'pin_code' => $data['pin_code'] ?? '',
                'phone' => $data['phone'] ?? '',
                'email' => $data['email'] ?? '',
            ]
        );

        return $user;

        
    }
}