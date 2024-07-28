@extends('frontend.layouts.app')
@section('content')
        
    <section class="registerPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="wrapper border-0 ps-md-4">
                    <h1 class="heading2 mb-3">Reset Password</h1>
                        <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                            <div>
                                <label for="username">Email address <span class="required">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="password-confirm">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="mt-4">
                                <button class="btn1" class="submit"><span>{{ __('Reset Password') }}</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </section>
        
@endsection