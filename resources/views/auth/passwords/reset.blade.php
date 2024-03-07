@extends('frontend.layouts.app')
@section('content')
        
    <section class="registerPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-12">
                    <div class="wrapper border-0 ps-md-4">
                    <h1 class="heading2">Sign In</h1>
                        <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                            <div>
                                <label for="username">Username or email address <span class="required">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
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