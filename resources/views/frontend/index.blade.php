@extends('frontend.layouts.app')
@section('content')
        
    
        <section class="banner">
            <video playsinline autoplay muted loop>
                    <source src="{{ asset('assets/videos/KFC _ Perfect Every Bite.mp4') }}" type="video/mp4" />
            </video>

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
        <section class="padding-top-main">
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
        </section>
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
                                        <h1>Quality controlled from the get go!</h1>
                                        <p>Quality checks are performed before harvest. After the harvest seafood is brought in at controlled temperatures to prevent bacterial growth.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="queAnsBox">
                                        <div class="icon">
                                            <img src="assets/images/icons/questions-02.svg" alt="">
                                        </div>
                                        <h1>No harmful ingredients</h1>
                                        <p>Our quality processes ensure that all our seafood is free from antibiotics, pesticides, sulphites and metals.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="queAnsBox">
                                        <div class="icon">
                                            <img src="assets/images/icons/questions-03.svg" alt="">
                                        </div>
                                        <h1>Locking in that Marina goodness</h1>
                                        <p>We quick freeze our seafood at its best, locking in all the freshness, nutrition & maximum flavour.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="queAnsBox">
                                        <div class="icon">
                                            <img src="assets/images/icons/questions-04.svg" alt="" style="width: 70px;">
                                        </div>
                                        <h1>Always staying perfect frosty!</h1>
                                        <p>Our special truck and packaging keep our products perfectly frozen until they reach you.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="queAnsBox">
                                        <div class="icon">
                                            <img src="assets/images/icons/questions-05.svg" alt="">
                                        </div>
                                        <h1>Unlocking that Marina flavour</h1>
                                        <p>You unlock the freshness at home, plate up your favourite dishes and deep dive into the flavour of Marina!</p>
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
                                        <h2>Happy reviews from happy tummies</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget semper elit. Cras ut justo a sapien dapibus pharetra. Integer pellentesque urna non tincidunt posuere. Vestibulum dignissim egestas magna, eu congue urna ultrices non. Nullam libero lectus, porta non ligula id, sollicitudin pellentesque sem.</p>
                                        <div class="details">
                                            <div class="name">George Fernandez</div>
                                            <div class="location">Mumbai</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="items">
                                        <h2>Happy reviews from happy tummies</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget semper elit. Cras ut justo a sapien dapibus pharetra. Integer pellentesque urna non tincidunt posuere. Vestibulum dignissim egestas magna, eu congue urna ultrices non. Nullam libero lectus, porta non ligula id, sollicitudin pellentesque sem.</p>
                                        <div class="details">
                                            <div class="name">George Fernandez</div>
                                            <div class="location">Mumbai</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="items">
                                        <h2>Happy reviews from happy tummies</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget semper elit. Cras ut justo a sapien dapibus pharetra. Integer pellentesque urna non tincidunt posuere. Vestibulum dignissim egestas magna, eu congue urna ultrices non. Nullam libero lectus, porta non ligula id, sollicitudin pellentesque sem.</p>
                                        <div class="details">
                                            <div class="name">George Fernandez</div>
                                            <div class="location">Mumbai</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="items">
                                        <h2>Happy reviews from happy tummies</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget semper elit. Cras ut justo a sapien dapibus pharetra. Integer pellentesque urna non tincidunt posuere. Vestibulum dignissim egestas magna, eu congue urna ultrices non. Nullam libero lectus, porta non ligula id, sollicitudin pellentesque sem.</p>
                                        <div class="details">
                                            <div class="name">George Fernandez</div>
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