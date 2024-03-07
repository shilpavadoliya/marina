@extends('frontend.layouts.app')
@section('content')
        
    <section class="registerPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row row-gap-5  justify-content-center">
                <div class="col-6">
                    <div class="wrapper border-0 ps-md-4">
                    <h1 class="heading2">{{ __('Reset Password') }}</h1>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif 

                        <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                        @csrf
                            <div class="mt-3">
                                <label for="username">{{ __('Email Address') }} <span class="required">*</span></label>
                                <input class="mt-3" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button class="btn1" class="submit"><span>{{ __('Send Password Reset Link') }}</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </section>
        
@endsection