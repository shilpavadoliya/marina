    <header class="bg-neutral-200">
                    
        <div class="container">
            <div class="wrapper">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="">
                </a>
                <div class="location" data-bs-toggle="modal" data-bs-target="#locationchange">
                    <div class="icon">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" alt="">
                    </div>
                    <div class="details" id="detect-location">
                        <div class="title" id="output">{{  session()->get('pincode') }}</div>
                        <!-- <p>ABC Road, Mumbai Lorem ipsum</p> -->
                    </div>
                </div>
                <div class="search desktopOnly">
                    <form action="{{ route('product.search') }}" method="GET">
                        <div class="mic"><img src="{{ asset('assets/images/icons/mic.svg') }}" alt=""></div>
                        <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Search for Any Product">
                        <button class="search" type="submit"><img src="{{ asset('assets/images/icons/search.svg') }}" alt=""></button>
                    </form>
                </div>
                <div class="navWrapper desktopOnly">
                    
                    <div class="categories">
                        <button type="button" class="link" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.9 15"><defs></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M7.8,9.5a3.6,3.6,0,0,1-2-.6L1.4,6.1a2.3,2.3,0,0,1-1-1.9A2.1,2.1,0,0,1,1.7,2.5L6.4.4a4.3,4.3,0,0,1,4.1.3l4.4,2.7a2.3,2.3,0,0,1,1,1.9A2.4,2.4,0,0,1,14.7,7L9.9,9.2a3.9,3.9,0,0,1-2.1.3m.6-8.3a4,4,0,0,0-1.5.3L2.1,3.6a1.3,1.3,0,0,0-.5.7,1.2,1.2,0,0,0,.4.8L6.5,7.8a3,3,0,0,0,2.9.3l4.8-2.2a1.3,1.3,0,0,0,.5-.7,1.2,1.2,0,0,0-.4-.8L9.8,1.7a2.4,2.4,0,0,0-1.4-.5M9.5,14.6l5.6-2.5a.6.6,0,0,0,.3-.8.7.7,0,0,0-.8-.3L9,13.5a3,3,0,0,1-2.9-.2L.9,10.1a.5.5,0,0,0-.8.2.5.5,0,0,0,.2.8l5.1,3.2a5.3,5.3,0,0,0,2,.7,5.2,5.2,0,0,0,2.1-.4m.2-2.7,5.6-2.5a.6.6,0,0,0,.3-.8.7.7,0,0,0-.8-.3L9.2,10.8a3.3,3.3,0,0,1-2.9-.2L1.1,7.4a.5.5,0,0,0-.8.2.6.6,0,0,0,.2.8l5.1,3.2a4.8,4.8,0,0,0,2,.7,5.2,5.2,0,0,0,2.1-.4"/></g></g></svg>
                            <div class="title">Categories</div>
                        </button> 
                        <div class="dropdown-menu dropdown-menu-end">
                            <ul class="mega_menu">
                                <div class="brand-category-content shop-category-contain">
                                    <div class="shop-menu">
                                        <ul class="shop-category">
                                            @php
                                                $getCategory = App\Models\ProductCategory::getCategory();
                                            @endphp

                                            @foreach($getCategory as $key=>$category)
                                            <li class="@if($key == 0)active @endif">
                                                <a href="javascript:void(0);">
                                                    <div class="thumb">
                                                        <img src="{{ $category['image_url'] }}" alt="">
                                                    </div>
                                                    <span>{{ $category->name }}</span>
                                                </a>
                                                <div class="shop-mega-menu hover">
                                                    @php
                                                        $getSubCategory = App\Models\ProductSubCategory::where('category_id', $category->id)->get();
                                                    @endphp
                                                    <ul>
                                                        @foreach($getSubCategory as $subCategory)
                                                            <li><a href="{{ route('category',$category->id ) }}">{{ $subCategory->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                   
                                                </div>
                                            </li>
                                            @endforeach 
                                            
                                        </ul>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <a href="" class="link new">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.4 15"><defs></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M14.3,8.8l-.6-1.1a.3.3,0,0,1,0-.4l.6-1.1a1.4,1.4,0,0,0-.6-1.8l-1.1-.6c-.2,0-.2-.1-.3-.3l-.2-1.2a1.2,1.2,0,0,0-1.4-1.1l-1.3.2H9L8.1.4A1.3,1.3,0,0,0,6.3.4l-.9.9H5L3.7,1.2A1.2,1.2,0,0,0,2.3,2.3L2.1,3.5q-.2.3-.3.3L.7,4.4A1.4,1.4,0,0,0,.1,6.2L.7,7.3a.3.3,0,0,1,0,.4L.1,8.8a1.4,1.4,0,0,0,.6,1.8l1.1.6.3.3.2,1.2a1.2,1.2,0,0,0,1.3,1.1h.1L5,13.6h.4l.9.9a1.1,1.1,0,0,0,.9.4,1.1,1.1,0,0,0,.9-.4l.9-.9h.4l1.3.2a1.2,1.2,0,0,0,1.4-1.1l.2-1.2c.1-.2.1-.3.3-.3l1.1-.6a1.4,1.4,0,0,0,.6-1.8m-1,1-1.1.6a1.3,1.3,0,0,0-.7.9l-.2,1.3c-.1.2-.3.4-.5.3H9.5a1.1,1.1,0,0,0-1.1.3l-.9.9a.4.4,0,0,1-.6,0L6,13.1l-.9-.3H3.6c-.2.1-.4-.1-.5-.3l-.2-1.3a1.3,1.3,0,0,0-.7-.9L1.1,9.8a.5.5,0,0,1-.2-.6l.6-1.1a2.4,2.4,0,0,0,0-1.2L.9,5.8a.5.5,0,0,1,.2-.6l1.1-.6a1.3,1.3,0,0,0,.7-.9l.2-1.3c.1-.2.3-.4.5-.3H4.9A1.1,1.1,0,0,0,6,1.9L6.9,1a.4.4,0,0,1,.6,0l.9.9a1.1,1.1,0,0,0,1.1.3h1.3c.2-.1.4.1.5.3l.2,1.3a1.3,1.3,0,0,0,.7.9l1.1.6a.5.5,0,0,1,.2.6l-.6,1.1a1.3,1.3,0,0,0,0,1.2l.6,1.1a.5.5,0,0,1-.2.6"/><path class="cls-1" d="M10.4,4.3H9.7L4,10a.9.9,0,0,0,0,.7h.6L10.4,5a.9.9,0,0,0,0-.7"/><path class="cls-1" d="M5.5,6.8A1.6,1.6,0,0,0,7.1,5.2,1.6,1.6,0,0,0,5.5,3.6a1.6,1.6,0,0,0,0,3.2m0-2.3a.7.7,0,0,1,0,1.4.8.8,0,0,1-.8-.7.8.8,0,0,1,.8-.7"/><path class="cls-1" d="M8.9,8.2a1.6,1.6,0,0,0,0,3.2,1.6,1.6,0,0,0,0-3.2m0,2.3a.7.7,0,1,1,.7-.7.7.7,0,0,1-.7.7"/></g></g></svg>
                        <div class="title">Offers</div>
                    </a>
                    @if (Auth::check())
                        <!-- User is logged in -->
                         <div class="btn-group account">
                            <button class="link border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile">
                                    <img src="{{ asset('assets/images/user.png') }}" alt="">
                                </div>
                                <div class="title">{{ auth()->user()->first_name}}</div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('myaccount') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('myaccount-order') }}">My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('myaccount-address') }}">Addresses</a></li>
                                <li><a class="dropdown-item" href="{{ route('myaccount-details') }}">Account details</a></li>
                                <li><a class="dropdown-item" href="{{ route('myaccount-wishlist') }}">Wishlist</a></li>
                                <li><a class="dropdown-item logoutButton" href="javascript:void(0)">Logout</a></li>
                            </ul>
                        </div>
                    @else
                    <a href="" class="link" data-toggle="modal" data-target="#account_modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.6 14"><defs></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M6.8,9.2a.5.5,0,0,0,0,.7h.7L10,7.3h.2c0-.2,0-.3-.2-.4L7.5,4.1a.5.5,0,0,0-.7.7L8.6,6.5H.5a.5.5,0,0,0,0,1H8.6Z"/><path class="cls-1" d="M7.6,0A6.9,6.9,0,0,0,1.1,4.4a.5.5,0,0,0,.3.7c.2.1.5-.1.6-.3A6,6,0,0,1,7.6,1a6,6,0,0,1,6.1,6,6,6,0,0,1-6.1,6A6,6,0,0,1,2,9.2c-.1-.2-.4-.4-.6-.3a.5.5,0,0,0-.3.7A6.9,6.9,0,0,0,7.6,14a7,7,0,0,0,7-7,7,7,0,0,0-7-7"/></g></g></svg>
                        <div class="title">Login</div>
                    </a>
                    @endif

                    <a href="javascript:void(0)" class="link @if(session()->has('cart') && count(session()->get('cart')) > 0) cartAdded @endif addtoCartToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.4 14"><defs></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M4.6,11a1.5,1.5,0,1,0,0,3,1.5,1.5,0,1,0,0-3m0,2.3a.7.7,0,0,1-.8-.8.7.7,0,0,1,.8-.8.8.8,0,1,1,0,1.6"/><path class="cls-1" d="M10.9,11a1.5,1.5,0,1,0,0,3,1.5,1.5,0,0,0,0-3m0,2.3a.8.8,0,1,1,0-1.6.8.8,0,1,1,0,1.6"/><path class="cls-1" d="M14.3,2.2H3.2L2.9,1A1.5,1.5,0,0,0,1.5,0H.3A.3.3,0,0,0,0,.3C0,.5.1.7.3.7H1.5a.9.9,0,0,1,.8.6L4.4,7.6,4.2,8a1.6,1.6,0,0,0,.2,1.5,1.4,1.4,0,0,0,1.2.7h6.5c.2,0,.3-.2.3-.4a.3.3,0,0,0-.3-.3H5.6a.8.8,0,0,1-.7-.4,1.1,1.1,0,0,1-.1-.8L5,8l7-.7a1.9,1.9,0,0,0,1.6-1.4l.8-3.4a.4.4,0,0,0-.1-.3M12.9,5.7a1.1,1.1,0,0,1-1,.9L5,7.3,3.4,2.6l10.2.2Z"/></g></g></svg>
                        <div class="title">Cart</div>
                        
                        @if(session()->has('cart') && count(session()->get('cart')) > 0)
                        <div class="items">
                            <div class="total"><span class="jqueryTotalItem">{{ count(session()->get('cart')) }} </span> Items</div>
                            <div class="price">₹ <span class="jqueryTotal">{{ calculateTotalPriceCart(session()->get('cart', [])) }}</span></div>
                        </div>
                        @else
                            <div class="items">
                                <div class="total"><span class="jqueryTotalItem"> </span> Items</div>
                                <div class="price">₹ <span class="jqueryTotal">0</span></div>
                            </div>
                        @endif
                    </a>

                </div>
            </div>
        </div>
    </header>

    @include('frontend.layouts.side-modal')

    @push('scripts')
        <script>
            $(".postalCode").val('360006');
            $.ajaxSetup({
                headers: {   
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            function checkPincode() {
                var pincode = $('#pincode').val();
                
                if (pincode) {
                    $.ajax({
                        url: '{{ route("pincode-check") }}', // Replace with your API endpoint
                        type: 'POST',
                        data: { pincode: pincode },
                        success: function(response) {
                            if (response.available) {
                                location.reload(); 
                            } else {
                                alert('Pincode is not available for delivery');
                            }
                        },
                        error: function() {
                            alert('Error checking pincode');
                        }
                    });
                } else {
                    alert('Please enter a pincode');
                }
            }

            $('#pincode').keypress(function(event) {
                if (event.which == 13) { // Enter key pressed
                    checkPincode();
                }
            });
            
            let currentRoute = "{{ Route::currentRouteName() }}"
            if ("{{session()->get('pincode')}}" == "") {
               if (currentRoute !== "home") {
                    alert('Pincode is required to access');
                    window.location.href = "{{ route('home') }}";
               }
            }
        </script>
    @endpush