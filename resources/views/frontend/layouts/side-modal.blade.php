<!-- account -->
<div class="modal modal-right fade" id="account_modal" tabindex="-1" role="dialog" aria-labelledby="account_modal">
    <div class="modal-dialog modal-sm" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets/images/icons/cross-white.svg') }}" alt="">
        </button>
        <div class="modal-content accountModal">
            <div class="modal-header">
                <h5 class="modal-title">SIGN IN</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn1" type="submit"><span>LOG IN</span></button>
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
                <div class="noaccountyet">
                    <img src="{{ asset('assets/images/icons/user.svg') }}" alt="">
                    <span class="fs-500 fw-semibold">No account yet?</span>
                    <a href="{{ route('register') }}">CREATE AN ACCOUNT</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- account -->

    <!-- cart -->
    <div class="modal modal-right fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="cart_modal">
        <div class="modal-dialog modal-sm" role="document">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/images/icons/cross-white.svg') }}" alt="">
                    </button>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Summary</h5>
            </div>
            <div class="modal-body p-0" style="padding-bottom: 170px !important;">
                <ul class="modalCart" id="cartModal">
                    @if (!is_null(session()->get('cart'))) 
                        @foreach (session()->get('cart') as $cart=>$item)

                        <li>
                            <div class="box">
                                <h2>{{ $item['productName'] }}</h2>
                                <div class="details">
                                    <div class="weight">
                                        {{ $item['productUnit'] }}gm
                                    </div>
                                    <div class="cost">
                                        ₹ {{ $item['productPrice'] }}
                                    </div>
                                    <div class="addToCart" >
                                        <div class="number">
                                            <span class="minus border-end-0" data-id="{{ $cart }}" data-price="{{ $item['productPrice'] }}" data-name="{{ $item['productName'] }}" data-unit="{{ $item['productUnit'] }}">-</span>
                                            <input type="text" value="{{ $item['quantity'] }}"/>
                                            <span class="plus border-start-0" data-id="{{ $cart }}" data-price="{{ $item['productPrice'] }}" data-name="{{ $item['productName'] }}" data-unit="{{ $item['productUnit'] }}">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="close removeCartProdcut" data-id="{{ $cart }}">&times;</div>
                        </li>
                        @endforeach

                    @endif
                </ul>
                <div class="billDetails">
                    <div class="wrapper">
                        <h2>Bill Details</h2>
                        <ul>
                            <li>
                                <div class="title">Subtotal</div>
                                <div class="total">₹ <span class="jqueryTotal">{{ calculateTotalPriceCart(session()->get('cart', [])) }}</span></div>
                            </li>
                            <!-- <li>
                                <div class="title">Delivery Charge</div>
                                <div class="total">₹ 39</div>
                            </li> -->
                        </ul>
                        <!-- <p>Your cart value is less than ₹499 & delivery charge applies</p> -->
                        <div class="finaltotal">
                            <div class="title">Total</div>
                            <div class="total">₹ <span class="jqueryTotal">{{ calculateTotalPriceCart(session()->get('cart', [])) }}</span></div>
                        </div>
                    </div>
                    <p class="mt-2">All Rates are Inclusive of Tax</p>
                </div>
            </div>
            <div class="modal-footer modal-footer-fixed checkoutFooter">
                <div class="total">Total ₹ <span class="jqueryTotal">{{ calculateTotalPriceCart(session()->get('cart', [])) }}</span></div>
                <a href="{{ route('shopping-cart') }}" class="checkoutButton">Proceed to Checkout</a>
            </div>
            </div>
        </div>
    </div>

<!-- cart -->


<!-- Location Change -->
<div class="modal fade" id="locationchange" tabindex="-1" aria-labelledby="locationchangeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content py-2">
      <div class="modal-body ">
            <h1>Looking at changing your location?</h1>
            <p>This might affect the availability of items in your cart. Stay here/Change Location</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn2" data-bs-dismiss="modal"><span>Stay Here</span></button>
        <button type="button" class="btn1" data-bs-dismiss="modal" data-toggle="modal" data-target="#searchLocation"><span>Change Area</span></button>
      </div>
    </div>
  </div>
</div>
<!-- Location Change -->

<!-- Search Location-->
<div class="modal fade" id="searchLocation" tabindex="-1" aria-labelledby="searchLocationLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content py-2">
      <div class="modal-body ">
            <form action="javascript:void(0)">
                <div class="group">
                    <button class="search"><img src="{{ asset('assets/images/icons/search.svg') }}" alt=""></button>
                    <input id="pincode" placeholder="Enter Your Pincode" type="text">
                    <div id="output"></div>
                    <button type="button" class="currentLocation"></button>
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Search Location -->


<!-- Search -->
<div class="modal modal-search fade" id="search_modal" tabindex="-1" role="dialog" aria-labelledby="search_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <input type="text" placeholder="Search for products" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center text-neutral-500">Start typing to see products you are looking for.</p>
      </div>
      <div class="modal-footer modal-footer-fixed d-none">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Search -->


<!-- Side Menu -->
<div class="modal modal-left fade" id="left_modal_sm" tabindex="-1" role="dialog" aria-labelledby="left_modal_sm">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content sideMenu">
      <div class="modal-header" style="height: 50px;">
            
      </div>
      <div class="modal-body">
            <div class="accordion" id="accordionExample">
                <a href="{{ route('home') }}" class="singleLink noBorder">Home</a>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Categories
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                @php
                                    $getCategory = App\Models\ProductCategory::getCategory();
                                @endphp

                                @foreach($getCategory as $key=>$category)
                                <li class="@if($key == 0)active @endif">
                                    <a href="{{ route('category',$category->id ) }}">{{ $category->name }}</a>
                                </li>
                                @endforeach 
                            </ul>   
                        </div>
                    </div>
                </div>
               
                @if(auth()->user())
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingUser">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                    {{ auth()->user()->first_name ?? ''}}
                    </button>
                    </h2>
                    
                    <div id="collapseUser" class="accordion-collapse collapse" aria-labelledby="headingUser" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="{{ route('myaccount') }}">Dashboard</a></li>
                                <li><a href="{{ route('myaccount-order') }}">My Orders</a></li>
                                <li><a href="{{ route('myaccount-address') }}">Addresses</a></li>
                                <li><a href="{{ route('myaccount-details') }}">Account details</a></li>
                                <li><a href="{{ route('myaccount-wishlist') }}">Wishlist</a></li>
                                <li><a class="logoutButton" href="javascript:void(0)">Logout</a></li>
                            </ul>   
                        </div>
                    </div>
                </div>
                @else
                <a href="" class="singleLink" data-toggle="modal" data-target="#account_modal" data-dismiss="modal"><img src="assets/images/icons/account.svg" alt=""> Login / Register</a>
                @endif
                
                
            </div>
      </div>
    </div>
  </div>
</div>
<!-- Side Menu -->