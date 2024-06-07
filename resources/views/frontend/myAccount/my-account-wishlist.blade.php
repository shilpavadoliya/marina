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
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="thumb">
                                                <img src="assets/images/products/pro1.jpg" alt="">
                                            </div>
                                            <div class="details">
                                                <h1>SURMAI Steaks</h1>
                                                <ul class="tags">
                                                    <li><strong>1000 g</strong></li>
                                                    <li>4-5 pcs</li>
                                                    <li>Serves 3</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            575
                                        </div>
                                    </td>
                                    <td>
                                        <strong>In Stock</strong>
                                    </td>
                                    <td>
                                        <div class="addToCart">
                                            <button class="mainBtn" style="display:block">
                                                <div>
                                                    <span>Add</span> <img src="assets/images/icons/plus.svg" alt="">
                                                </div>
                                            </button>
                                            <div class="counterWrapper" style="display: none;">
                                                <div class="number">
                                                    <span class="minus border-end-0">-</span>
                                                    <input type="text" value="1"/>
                                                    <span class="plus border-start-0">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="delete"><img src="assets/images/icons/delete.svg" alt=""></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="thumb">
                                                <img src="assets/images/products/pro1.jpg" alt="">
                                            </div>
                                            <div class="details">
                                                <h1>SURMAI Steaks</h1>
                                                <ul class="tags">
                                                    <li><strong>1000 g</strong></li>
                                                    <li>4-5 pcs</li>
                                                    <li>Serves 3</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            575
                                        </div>
                                    </td>
                                    <td>
                                        <strong>In Stock</strong>
                                    </td>
                                    <td>
                                        <div class="addToCart">
                                            <button class="mainBtn" style="display:block">
                                                <div>
                                                    <span>Add</span> <img src="assets/images/icons/plus.svg" alt="">
                                                </div>
                                            </button>
                                            <div class="counterWrapper" style="display: none;">
                                                <div class="number">
                                                    <span class="minus border-end-0">-</span>
                                                    <input type="text" value="1"/>
                                                    <span class="plus border-start-0">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="delete"><img src="assets/images/icons/delete.svg" alt=""></a>
                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    
@endsection