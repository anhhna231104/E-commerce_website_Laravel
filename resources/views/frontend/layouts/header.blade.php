<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{asset('/frontend/images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canada</a></li>
                                <li><a href="">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            @if(Auth::check())
                                <li><a href="{{url('/member/account')}}"><i class="fa fa-user"></i> Account</a></li>
                            @endif
                            <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="{{url('/cart/checkout')}}" class="checkout-href"><i
                                        class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{url('/cart')}}" class="cart-href"><i class="fa fa-shopping-cart"></i> Cart
                                    <sup class="cart-qty">
                                        {{$totalQty}}
                                    </sup>
                                </a>
                            </li>
                            @if(Auth::check())
                                <li><a href="{{ url('/member/logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
                            @else
                                <li><a href="{{ url('/member/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                                <li><a href="{{ url('/member/register') }}"><i class="fa fa-lock"></i> Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="active">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('/blog/list')}}" class="active">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                            <li><a href="{{url('/search-advanced')}}">Search advanced</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form method="post" action="{{route('search-product')}}">
                        @csrf
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search" name="keyword" />
                            <button type="submit" class="btn btn-default"
                                style="background-color: #FE980F; color: #fff">Go</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateQty() {
            $.ajax({
                type: 'GET',
                url: '{{ route("update-qty") }}',
                success: function (res) {
                    if (res.totalQty !== undefined) {
                        $('sup.cart-qty').text(res.totalQty);
                    }
                },
                error: function (error) {
                    console.log(error.responseText);
                    alert('Error occurred while fetching cart quantity');
                }
            });
        }

        updateQty(); // Call this function when the page loads

        // Optionally, call this function whenever an item is added to the cart
        $(document).on('cart-updated', function () {
            updateQty();
        });

        $('.cart-href').click(function (e) {
            e.preventDefault()
            var loginCk = "{{Auth::check()}}"

            if (loginCk == "") {
                alert('Please login to go to the cart page.')
            }
            else {
                window.location.href = '{{ url("/cart") }}';
            }
        })

        $('.checkout-href').click(function (e) {
            e.preventDefault()
            var loginCk = "{{Auth::check()}}"

            if (loginCk == "") {
                alert('Please login to go to the checkout page.')
            }
            else {
                window.location.href = '{{ url("/cart/checkout") }}';
            }
        })


    });
</script>