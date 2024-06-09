@extends('frontend.layouts.app')
@section('content')
    
    @include('frontend.myAccount.sidebar-account')
                
                <div class="col-md-9">
                    <h3 class="heading3">Account Details</h3>
                    <!-- <p>Already have an account? <a href="#">Log in instead!</a></p> -->
                    <form action="{{ route('update-myaccount-details') }}" method="POST">
                        @csrf
                        <div class="row row-gap-4 mt-4">
                            <div class="col-md-6">
                                <div>
                                    <label for="username">First name <span class="required">*</span></label>
                                    <input type="text" name="first_name" value="{{ $user->first_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="username">Last name <span class="required">*</span></label>
                                    <input type="text" name="last_name" value="{{ $user->last_name }}" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div>
                                    <label for="username">Display Name *</label>
                                    <input type="text">
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div>
                                    <label for="username">Email address <span class="required">*</span></label>
                                    <input type="text" name="email" value="{{ $user->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="password">Current Password <span class="required">*</span></label>
                                <input id="password-field2" type="password" class="form-control" value="password">
                                <span toggle="#password-field2" class="fa fa-fw fa-eye hidePassfield-icon toggle-password2"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="password">New Password <span class="required">*</span></label>
                                <input id="password-field3" type="password" class="form-control" name="password" value="password">
                                <span toggle="#password-field3" class="fa fa-fw fa-eye hidePassfield-icon toggle-password3"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="password">Confirm Password <span class="required">*</span></label>
                                <input id="password-field4" type="password" class="form-control" name="password" value="password">
                                <span toggle="#password-field4" class="fa fa-fw fa-eye hidePassfield-icon toggle-password4"></span>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn1"><span>SAVE CHANGES</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
@endsection