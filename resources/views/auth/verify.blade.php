@extends('frontend.layouts.app')
@section('content')
        
    <section class="registerPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-12">
                    <div class="wrapper border-0 ps-md-4">
                    <h1 class="heading2">{{ __('Verify Your Email Address') }}</h1>
                        
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                            <div class="mt-4">
                                <button class="btn1" class="submit"><span>{{ __('click here to request another') }}</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </section>
        
@endsection