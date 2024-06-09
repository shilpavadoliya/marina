<style>
    .btn-primary-outline {
      background-color: transparent;
      border-color: #ccc;
    }
    .btn-primary-outline:hover {
      color: #fff;
    }
</style>

<section class="whatsyourmind | padding-top-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="heading2 text-center">My Account</h1>
                <h2 class="subHeading2 text-center"><a href="{{ route('home') }}">HOME</a> / MY ACCOUNT</h2>
            </div>
        </div>
    </div>
</section>
<section class="account | padding-top-main margin-bottom-max">
    <div class="container">
        <div class="row row-gap-5">
            <div class="col-md-3">
                <ul class="leftMenu">
                    <li class="active"><a href="{{ route('myaccount') }}">Dashboard</a></li>
                    <li><a href="{{ route('myaccount-order') }}">Orders</a></li>
                    <li><a href="{{ route('myaccount-address') }}">Addresses</a></li>
                    <li><a href="{{ route('myaccount-details') }}">Account details</a></li>
                    <li><a href="{{ route('myaccount-wishlist') }}">Wishlist</a></li>
                    <li class="logout">
                        <a href="javascript:void(0)" class="logoutButton">
                            Log out
                        </a>
                    </li>
                </ul>
            </div>

