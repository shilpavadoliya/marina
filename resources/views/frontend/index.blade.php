@extends('frontend.layouts.app')

@section('content')

        

    

        <!-- <section class="banner">

            <video playsinline autoplay muted loop>

                    <source src="{{ asset('assets/images/1900x800.jpg') }}" alt="">

            </video>



        </section> -->
        <section class="imgBanner">
            <img src="{{ asset('assets/images/banners/1900x800.jpg') }}" class="desktop" alt="">
            <img src="{{ asset('assets/images/banners/400x800.jpg') }}" class="mobile" alt="">

        </section>

        

        <section class="padding-top-main">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h1 class="heading1 text-center">Premium Indian seafood now home delivered</h1>

                    </div>

                </div>

                <div class="row margin-top-main">

                    <div class="col-12">

                        <div class="swiper advSwiper">

                                <div class="swiper-wrapper">

                                    <div class="swiper-slide">

                                        <img src="{{ asset('assets/images/home-banner.jpg') }}" alt="">

                                    </div>

                                    <div class="swiper-slide">

                                        <img src="{{ asset('assets/images/home-banner.jpg') }}" alt="">

                                    </div>

                                    <div class="swiper-slide">

                                        <img src="{{ asset('assets/images/home-banner.jpg') }}" alt="">

                                    </div>

                                </div>

                        </div>

                        

                    </div>

                </div>

            </div>

        </section>

        <section class="whatsyourmind | padding-top-main">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h1 class="heading2 text-center">What's on your mind?</h1>

                        <h2 class="subHeading2 text-center">Freshest meats and much more!</h2>

                    </div>

                </div>

                <div class="row margin-top-main">

                    <div class="col-12 position-relative">

                        <div class="swiper wymSwiper">

                            <div class="swiper-wrapper">

                                

                                @foreach($getCategory as $category)

                                <div class="swiper-slide">

                                    <a href="{{ route('category',$category->id ) }}" class="item">

                                        <div class="thumb">

                                            <img src="{{ $category['image_url'] }}" alt="">

                                        </div>

                                        <h3>{{ $category->name }}</h3>

                                    </a>

                                </div>

                                @endforeach



                            </div>

                        </div>

                        <div class="wyp-prev swiper-button-prev"><img src="assets/images/icons/left-arrow.svg" alt=""></div>

                        <div class="wym-next swiper-button-next"><img src="assets/images/icons/right-arrow.svg" alt=""></div>

                        

                    </div>

                </div>

            </div>

        </section>

        {{--<section class="padding-top-main">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h1 class="heading2 text-center">Bestseller</h1>

                        <h2 class="subHeading2 text-center">Most Popular Product Near You!</h2>

                    </div>

                </div>

                <div class="row row-gap-5 margin-top-main">

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro1.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro2.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro3.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro4.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro5.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro6.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro1.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="productBox">

                            <div class="thumb">

                                <img src="assets/images/products/pro2.jpg" alt="">

                            </div>

                            <div class="details">

                                <h2>MACKERAL Whole</h2>

                                <div class="des">

                                    Fresh whole fish for curries & fry-up

                                </div>

                                <ul class="tags">

                                    <li><strong>1000 g</strong></li>

                                    <li>4-5 pcs</li>

                                    <li>Serves 3</li>

                                </ul>

                            </div>

                            <div class="cartDetails">

                                <div class="price">

                                    <span class="rupee">₹</span>

                                    575

                                </div>

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

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>--}}

        <section class="padding-top-main">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h1 class="heading2 text-center">All your questions, answered!</h1>

                    </div>

                </div>

                <div class="row margin-top-main">

                    <div class="col-12 position-relative">

                        <div class="swiper qaSwiper">

                            <div class="swiper-wrapper">

                                <div class="swiper-slide">

                                    <div class="queAnsBox">

                                        <div class="icon">

                                            <img src="assets/images/icons/qa1.svg" alt="">

                                        </div>

                                        <h1>Ensuring Quality from Start to Finish!</h1>

                                        <p>Our seafood is rigorously checked and monitored from procurement to delivery, ensuring health and safety.</p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="queAnsBox">

                                        <div class="icon">

                                            <img src="assets/images/icons/questions-02.svg" alt="">

                                        </div>

                                        <h1>Good for You, Good for the Planet!</h1>

                                        <p>Marina is guilt-free, adhering to top food safety and quality standards, all while protecting our planet.</p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="queAnsBox">

                                        <div class="icon">

                                            <img src="assets/images/icons/questions-03.svg" alt="">

                                        </div>

                                        <h1>Locking in that Marina Goodness</h1>

                                        <p>We use Individual Quick Freezing to preserve peak freshness, nutrition, and flavor. Our supply chain ensures products stay perfectly frozen until delivery.</p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="queAnsBox">

                                        <div class="icon">

                                            <img src="assets/images/icons/questions-04.svg" alt="" style="width: 70px;">

                                        </div>

                                        <h1>Delivering Globally Enjoyed Seafood to Indian Homes</h1>

                                        <p>Marina Frozen Seafood, loved in over 25 countries, is now at your doorstep in India. Enjoy what the world has cherished for six decades.</p>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="queAnsBox">

                                        <div class="icon">

                                            <img src="assets/images/icons/questions-05.svg" alt="">

                                        </div>

                                        <h1>The Smarter Choice for You</h1>

                                        <p>Skip the chaos of the fish market and the hassle of cleaning fish. Order Marina for convenient, export-quality seafood anytime, anywhere.</p>

                                    </div>

                                </div>

                                

                            </div>

                        </div>

                        <div class="qa-prev swiper-button-prev"><img src="assets/images/icons/left-arrow.svg" alt=""></div>

                        <div class="qa-next swiper-button-next"><img src="assets/images/icons/right-arrow.svg" alt=""></div>

                    </div>

                    

                </div>

            </div>

        </section>

        

        <section class="testimonials | padding-block-main">

            <div class="container">

                <div class="row">

                    <div class="col-12">

                        <h1 class="heading2 text-center">Compliments We Didn't Fish For</h1>

                    </div>

                </div>

                <div class="row">

                    <div class="col-12 position-relative">

                        <div class="swiper testimonialSwiper">

                            <div class="swiper-wrapper">

                                <div class="swiper-slide">

                                    <div class="items">

                                        <h2>I want to share my experience with frozen seafood</h2>

                                        <p>"Particularly from Marina Seafood. As someone who enjoys cooking at home, I was pleasantly surprised by the quality and convenience of their frozen seafood products. The prawns were remarkably fresh-tasting and preserved well, maintaining their natural flavors and textures after thawing. Cooking with their frozen seafood has made preparing meals easier without compromising on taste or nutrition. I highly recommend Marina frozen seafood for anyone looking to enjoy high-quality seafood at home."</p>

                                        <div class="details">

                                            <div class="name">Sylvia Dsouza</div>

                                            <div class="location">Mumbai</div>

                                        </div>

                                    </div>

                                </div>

                                <div class="swiper-slide">

                                    <div class="items">

                                        <h2>The best frozen sea food we have tasted</h2>

                                        <p>"I ordered prawns of Marina Brand and 
                                        I was pleasantly surprised by the quality of these frozen prawns! Despite being frozen, they tasted fresh and had a firm texture. Perfect for quick meals, they cooked up beautifully in stir-fries and pasta dishes. I'd definitely recommend them for their convenience and great taste!"
                                        </p>

                                        <div class="details">

                                            <div class="name">Sharvari Narkar</div>

                                            <div class="location">Mumbai</div>

                                        </div>

                                    </div>

                                </div>

                                <div class="swiper-slide">
                                    <div class="items">
                                        <h2>Better than the Fresh Prawns</h2>
                                        <p>"It’s like one stop solution for quality seafood. Tried the Prawn recently and it’s so amazing; better than fresh as it comes clean and deveined. Quality, size, glazing everything is perfect and best part is the taste. My son never had so many prawns ever before"</p>

                                        <div class="details">

                                            <div class="name">Yogesh Rawat</div>

                                            <div class="location">Delhi NCR</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="items">
                                        <h2>Exceptional Freshness: Marina Prawns Impress in Every Dish</h2>
                                        <p>"I am extremely happy with the Freshness and overall quality of the Marina Prawns. Tried them in the Starters and also in the Gravy. Were really nice."</p>

                                        <div class="details">
                                            <div class="name">Ravi Punjabi</div>
                                            <div class="location">Mumbai</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="items">
                                        <h2>The combination of quality, taste, and freshness are unmatched.</h2>
                                        <p>"The culinary experience with Marina is simply outstanding. Prawns are well packed. The combination of quality, taste, and freshness are unmatched."</p>

                                        <div class="details">
                                            <div class="name">Vinayak Haldankar</div>
                                            <div class="location">Mumbai</div>
                                        </div>
                                    </div>
                                </div>







                            </div>

                        </div>

                        <div class="sbp swiper-button-prev"><img src="assets/images/icons/left-arrow.svg" alt=""></div>

                        <div class="sbn swiper-button-next"><img src="assets/images/icons/right-arrow.svg" alt=""></div>

                    </div>

                </div>

            </div>

        </section>

    



@endsection