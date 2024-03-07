<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Marina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    
    <?php include('_header.php') ?>
    
    <div id="main">
        <section class="shoppingFlow | padding-top-main">
            <div class="container">
                <div class="row row-gap-5 gx-5 justify-content-md-center">
                    <ul>
                        <li>
                            <div class="title">Shopping Cart</div>
                            <div class="dot">

                            </div>
                        </li>
                        <li class="active">
                            <div class="title">Details</div>
                            <div class="dot">

                            </div>
                        </li>
                        <li>
                            <div class="title">Complete Order</div>
                            <div class="dot">

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="orderPage | padding-top-main margin-bottom-max">
            <div class="container">
                <div class="row row-gap-5 gx-5">
                    <div class="col-md-7">
                        <div class="mt-3">
                            <table class="table align-middle">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="position-relative">
                                                    <div class="thumb">
                                                        <img src="assets/images/products/pro1.jpg" alt="">
                                                    </div>
                                                    <div class="count"><span>2</span></div>
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
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="position-relative">
                                                    <div class="thumb">
                                                        <img src="assets/images/products/pro1.jpg" alt="">
                                                    </div>
                                                    <div class="count"><span>1</span></div>
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <ul class="checkoutSec">
                                    <li>
                                        <div class="title">Subtotal :</div>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            1000
                                        </div>
                                    </li>
                                    <li>
                                        <div class="title">Shipping Charges :</div>
                                        <div class="price">
                                            <span class="rupee">₹</span>
                                            100
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <ul class="checkoutSec pt-2">
                                    <li>
                                        <div class="title">Grand Total :</div>
                                        <div class="total">
                                            <span class="rupee">₹</span>
                                            1000
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <form>
                            <div class="row row-gap-3">
                                <div class="col-12">
                                    <label for="" class="head">Full Name</label>
                                    <input type="text">
                                </div>
                                <div class="col-12">
                                    <label for="" class="head">Email Address</label>
                                    <input type="text">
                                </div>
                                <div class="col-12">
                                    <label for="" class="head">Billing Address</label>
                                    <input type="text">
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Enter City">
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Zip Code">
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="head">Payment Method </div>
                                    <div class="row mt-2 gx-5">
                                        <div class="col-5 d-flex flex-column align-items-center">
                                            <label for="razorpay" class="mb-2">
                                                <img src="assets/images/icons/Razorpay_logo.svg" style="width: 150px;" alt="">
                                            </label>
                                            <input type="radio" name="paymentMethod" id="razorpay" checked  />
                                        </div>
                                        <div class="col-5 d-flex flex-column align-items-center">
                                            <label for="paytm" class="mb-2">
                                                <img src="assets/images/icons/Paytm_Logo.svg" style="width: 100px;" alt="">
                                            </label>
                                            <input type="radio" name="paymentMethod" id="paytm" />
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-12">
                                    <label class="d-flex align-items-center mt-3">
                                        <input name="rememberme" type="checkbox" value="forever" > <span class="ms-2 pt-1">Billing address is same as shipping & Save Address</span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <button class="btn1"><span>Place Order</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </section>
        
        <?php include('_footer.php') ?>
    </div>
    
    <?php include('_side-modal.php') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.4/js/bootstrap-select.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/mega-menu.js"></script>
    

  </body>
</html>