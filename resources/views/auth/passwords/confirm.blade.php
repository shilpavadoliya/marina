@extends('frontend.layouts.app')
@section('content')
        
    <section class="registerPage | padding-top-main margin-bottom-max">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-12">
                    <div class="wrapper border-0 ps-md-4">
                    <h1 class="heading2">{{ __('Confirm Password') }}</h1>
                        {{ __('Please confirm your password before continuing.') }}
                        
                        <form method="POST" action="{{ route('password.confirm') }}" class="mt-4">
                        @csrf
                            <div class="mt-3">
                                <label for="username">Password <span class="required">*</span></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button class="btn1" class="submit"><span>{{ __('Confirm Password') }}</span></button>
                            </div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
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