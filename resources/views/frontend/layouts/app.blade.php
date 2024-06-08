
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Marina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdC-KsOjDvFCHbgaXfFsvLhjfUzEM5fYY&libraries=places"></script>

    @stack('styles')

  </head>
  <body>
    <input type="hidden" class="postalCode" value="360006">
    <form action="{{ route('logout') }}" method="POST" hidden class="logoutForm">
        @csrf
        <button hidden type="submit" class="border-0">Logout</button>
    </form>
      @include('frontend.layouts.header')

      <div id="main">
        @yield('content')

        @include('frontend.layouts.footer')

        @include('frontend.layouts.side-modal')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.4/js/bootstrap-select.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/mega-menu.js') }}"></script>
    
     @stack('scripts')

     <script>
         $('.logoutButton').on('click', function () {
             $('.logoutForm').submit();
         })

         $(document).ready(function () {
            $('.addtoCartToggle').on('click', function(){
                if($(this).hasClass('cartAdded')){
                    $('#cart_modal').modal("show");
                }
             });

            let btn = document.querySelector(".addToCart .mainBtn");
            let counterWrapper = document.querySelector(".addToCart .counterWrapper");
            
            $('.mainBtn').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(1);
                $input.change();
                $(this).css('display', 'none');
                $(this).next('.counterWrapper').css('display', 'block');

                console.log($(this).data('name'));
                let productId = $(this).data('id');
                let productName = $(this).data('name');
                let productUnit = $(this).data('unit');
                let productPrice = $(this).data('price');
                addCart(productId, productName, productUnit, productPrice);

                return false;
            });

            $(document).on('click', '.minus', function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 0 ? 0 : count;
                $input.val(count);
                $input.change();
                if (count == 0) {
                    btn.style.display = "block";
                    counterWrapper.style.display = "none"
                }

                let productId = $(this).data('id');
                removeCart(productId);

                return false;
            });

            $(document).on('click', '.plus', function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();

                let productId = $(this).data('id');
                let productName = $(this).data('name');
                let productUnit = $(this).data('unit');
                let productPrice = $(this).data('price');
                addCart(productId, productName, productUnit, productPrice);

                return false;
            });
         });

         $(document).on('click', '.removeCartProdcut', function () {
            let productId = $(this).data('id');
            removeCart(productId, removeAll=true);

            let hideClass = '.removeDiv_'+productId;
            $(hideClass).addClass('d-none');

         });

        function addCart(productId, productName, productUnit, productPrice) {
            
            $.ajax({
             type: 'POST',
             url: "{{ route('cart.add') }}",
             data: {
                 productId: productId,
                 productName: productName,
                 productUnit: productUnit,
                 productPrice: productPrice,
                 _token: $('meta[name="csrf-token"]').attr('content'),
             },
             success: function(response) {
                 cartModalHTML(response);
             },
             error: function(xhr, status, error) {
                 console.error(xhr.responseText);
             }
            });
         }

         function removeCart(productId, removeAll=false) {
             $.ajax({
              type: 'POST',
              url: "{{ route('cart.remove') }}",
              data: {
                  productId: productId,
                  removeAll: removeAll,
                  _token: $('meta[name="csrf-token"]').attr('content'),
              },
              success: function(response) {
                  cartModalHTML(response);
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
              }
             });
          }

          function cartModalHTML(response){
            let html = '';
            var totalPrice = 0;
            var itemCount = 0;
            $.each(response.message, function(productId, item) {
                
                html += 

                `<li>
                    <div class="box">
                        <h2>${ item.productName }</h2>
                        <div class="details">
                            <div class="weight">
                                ${ item.productUnit } gm
                            </div>
                            <div class="cost">
                                ₹ ${ item.productPrice }
                            </div>
                            <div class="addToCart" >
                                <div class="number">
                                    <span class="minus border-end-0" data-id="${productId}" data-price="${ item.productPrice }" data-name="${ item.productName }" data-unit="${ item.productUnit }">-</span>
                                    <input type="text" value="${ item.quantity }"/>
                                    <span class="plus border-start-0" data-id="${productId}" data-price="${ item.productPrice }" data-name="${ item.productName }" data-unit="${ item.productUnit }">+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="close removeCartProdcut" data-id="${productId}">&times;</div>
                </li>`;

                var subtotal = item.quantity * item.productPrice;
                totalPrice += subtotal;
                itemCount += 1;

                $('.itemTotal').html('₹'+subtotal);

            });

            if(itemCount >= 1){
                $('.addtoCartToggle').addClass('cartAdded');
                $('.checkoutButton').removeClass('d-none');
            }

            if(itemCount == 0){
                $('.addtoCartToggle').removeClass('cartAdded');
                $('.checkoutButton').addClass('d-none');
            }

            $('#cartModal').html(html);
            $('.jqueryTotal').html(totalPrice);
            $('.jqueryTotalItem').html(itemCount);
            
        }

     </script>
  </body>
</html>