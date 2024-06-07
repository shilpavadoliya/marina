@extends('frontend.layouts.app')
@section('content')
    
    @include('frontend.myAccount.sidebar-account')
                
                <div class="col-md-9">
                    <h3 class="heading3">Billing Address</h3>
                    <form action="{{ route('myaccount-billing-address-update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="row row-gap-4 mt-4">
                            <div class="col-md-6">
                                <div>
                                    <label for="username">First name <span class="required">*</span></label>
                                    <input type="text" name="first_name" value="{{ $user->first_name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="username">Last name <span class="required">*</span></label>
                                    <input type="text" name="last_name" value="{{ $user->last_name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">Company name (optional)</label>
                                    <input type="text" name="company_name" value="{{ $user->company_name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">Street address <span class="required">*</span></label>
                                    <input type="text" name="address" value="{{ $user->address ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">Town / City <span class="required">*</span></label>
                                    <input type="text" name="city" value="{{ $user->city ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">State <span class="required">*</span></label>
                                    <input type="text" name="state" value="{{ $user->state ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">PIN Code <span class="required">*</span></label>
                                    <input type="text" name="pin_code" value="{{ $user->pin_code ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">Phone <span class="required">*</span></label>
                                    <input type="text" name="phone" value="{{ $user->phone ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="username">Email address <span class="required">*</span></label>
                                    <input type="text" name="email" value="{{ $user->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn1"><span>SAVE</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection