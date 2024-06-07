@extends('frontend.layouts.app')
@section('content')

@push('styles')
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush

    <section class="registerPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-md-6">
                    <div class="wrapper pb-5 pb-md-0 pe-md-5">
                        <h1 class="heading2">Register</h1>
                        <form method="POST" action="{{ route('register') }}" class="mt-4">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="username">First Name <span class="required">*</span></label>
                                    <input type="text" class="@error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="username">Last Name <span class="required">*</span></label>
                                    <input type="text" class="@error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="username">Phone no. <span class="required">*</span></label>
                                <input type="text" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="mt-3">
                                <label for="email">Email Id <span class="required">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="password">Password <span class="required">*</span></label>
                                <input id="password-field2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <span toggle="#password-field2" class="fa fa-fw fa-eye hidePassfield-icon toggle-password2"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="password">Re-Enter Password <span class="required">*</span></label>
                                <input id="password-field3" type="password" class="form-control" name="password_confirmation" required>
                                <span toggle="#password-field3" class="fa fa-fw fa-eye hidePassfield-icon toggle-password3"></span>
                            </div>

                            <div class="mt-4">
                                <button class="btn1" type="submit"><span>REGISTER</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper border-0 ps-md-4">
                    <h1 class="heading2">Sign In</h1>
                        <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                            <div>
                                <label for="username">Username or email address <span class="required">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="username">Password <span class="required">*</span></label>
                                <input id="password-field4" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <span toggle="#password-field4" class="fa fa-fw fa-eye hidePassfield-icon toggle-password2"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button class="btn1" class="submit"><span>LOG IN</span></button>
                            </div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <label class="d-flex align-items-center">
                                    <input class="form-check-input" name="rememberme" type="checkbox" value="forever" title="Remember me" aria-label="Remember me"> <span class="ms-2">Remember me</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Lost your password?</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </section>
        
@endsection