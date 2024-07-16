@extends('frontend.layouts.app')
@section('content')
    
    
    @include('frontend.myAccount.sidebar-account')
                
                <div class="col-md-9">
                    <h3 class="heading3">My Wishlist</h3>
                    <div class="table-responsive wishlist mt-3">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th width="250">Product</th>
                                    <th>Price</th>
                                    <th>Stock Status</th>
                                    <th>Add To Cart</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlist as $data)
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="thumb">
                                                <img src="{{ $data->product->getMainImageUrlAttribute() }}" alt="">
                                            </div>
                                            <div class="details">
                                                <h1>{{ $data->product->name }}</h1>
                                                <ul class="tags">
                                                    <li><strong>{{ $data->product->product_unit_quantity }} g</strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            {{ $data->product->product_price }} 
                                        </div>
                                    </td>
                                    <td>
                                        @if($data->product->stock == null)
                                            <strong>Out Of Stock</strong>
                                        @else
                                            <strong>In Stock</strong>
                                        @endif
                                        
                                    </td>
                                    
                                    @if($data->product->stock != null)
                                    <td>
                                    <div class="addToCart">

                                        <button class="mainBtn" @if(countProductInCart($data->product->name) != 0)style="display: none;" @endif data-id="{{ $data->product->id }}" data-price="{{ $data->product->product_price }}" data-name="{{ $data->product->name }}" data-unit="{{ $data->product->product_unit_quantity }}">

                                            <div>

                                                <span>Add</span> <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="">

                                            </div>

                                        </button>

                                        <div class="counterWrapper" @if(countProductInCart($data->product->name) == 0)style="display: none;" @endif>

                                            <div class="number">

                                                <span class="minus border-end-0" data-id="{{ $data->product->id }}" data-price="{{ $data->product->product_price }}" data-name="{{ $data->product->name }}" data-unit="{{ $data->product->product_unit_quantity }}">-</span>

                                                <input type="text" value="{{ countProductInCart($data->product->name) }}"/>

                                                <span class="plus border-start-0" data-id="{{ $data->product->id }}" data-price="{{ $data->product->product_price }}" data-name="{{ $data->product->name }}" data-unit="{{ $data->product->product_unit_quantity }}">+</span>

                                            </div>

                                        </div>

                                        </div>
                                    </td>
                                    @else
                                    <td class="text-center">
                                        -
                                    </td>
                                    @endif
                                    <td>
                                        @if(Auth::check())
                                            <form action="{{ route('wishlist.remove', $data->product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Remove from Wishlist</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    
@endsection