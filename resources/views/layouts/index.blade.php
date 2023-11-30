<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>{{ $title }}</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset("/eshop/images/favicon.png") }}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset("/eshop/css/bootstrap.css") }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/magnific-popup.min.css") }}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/font-awesome.css") }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset("/eshop/css/jquery.fancybox.min.css") }}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/themify-icons.css") }}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/niceselect.css") }}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/animate.css") }}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/flex-slider.min.css") }}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/owl-carousel.css") }}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset("/eshop/css/slicknav.min.css") }}">

	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{ asset("/eshop/css/reset.css") }}">
	<link rel="stylesheet" href="{{ asset("/eshop/style.css") }}">
    <link rel="stylesheet" href="{{ asset("/eshop/css/responsive.css") }}">


<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

@stack('css')

</head>
<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->


	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
								<li><i class="ti-email"></i> support@shophub.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-location-pin"></i> Store location</li>
								<li><i class="ti-alarm-clock"></i> <a href="{{ url("#") }}">Daily deal</a></li>
								<li><i class="ti-user"></i> <a href="{{ url("#") }}">My account</a></li>
								<li><i class="ti-power-off"></i><a href="{{ route('login') }}">Login</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="{{ url("index.html") }}"><img src="{{ asset("/eshop/images/logo.png") }}" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="{{ url("#0") }}"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">All Category</option>
									<option>watch</option>
									<option>mobile</option>
									<option>kid’s item</option>
								</select>
								<form>
									<input name="search" placeholder="Search Products Here....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="{{ url("#") }}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="{{ url("#") }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
                            @if(Auth::check())
                            <div class="sinlge-bar shopping">
								<a href="{{ url("#") }}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>{{ $kerajangs->count() }} Items</span>
									</div>
									<ul class="shopping-list">
                                        @php
                                            $total = 0;
                                        @endphp
										@foreach ($kerajangs as $item)
                                        @php
                                            $total += $item->produk->harga * $item->kuantitas;
                                        @endphp
                                        <li>
											<form action="{{ route('kerajang.destroy', $item->id) }}" method="post">
												@csrf
												@method('delete')
												<button class="remove" title="Remove this item"><i
														class="fa fa-remove"></i></button>
											</form>
											<a class="cart-img" href="{{ url("#") }}"><img src="{{ Storage::url($item->produk->foto) }}" alt="{{ Storage::url($item->produk->foto) }}"></a>
											<h4><a href="{{ url("#") }}">{{ $item->produk->nama }}</a></h4>
											<p class="quantity">{{ $item->kuantitas }}x - <span class="amount">Rp {{ number_format($item->produk->harga * $item->kuantitas) }}</span></p>
										</li>
                                        @endforeach
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">Rp {{ number_format($total) }}</span>
										</div>
										<a href="{{ route('kerajang.checkout') }}" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>
                            @endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						{{-- <div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									<li><a href="{{ url("#") }}">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="sub-category">
											<li><a href="{{ url("#") }}">accessories</a></li>
											<li><a href="{{ url("#") }}">best selling</a></li>
											<li><a href="{{ url("#") }}">top 100 offer</a></li>
											<li><a href="{{ url("#") }}">sunglass</a></li>
											<li><a href="{{ url("#") }}">watch</a></li>
											<li><a href="{{ url("#") }}">man’s product</a></li>
											<li><a href="{{ url("#") }}">ladies</a></li>
											<li><a href="{{ url("#") }}">westrn dress</a></li>
											<li><a href="{{ url("#") }}">denim </a></li>
										</ul>
									</li>
									<li class="main-mega"><a href="{{ url("#") }}">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="mega-menu">
											<li class="single-menu">
												<a href="{{ url("#") }}" class="title-link">Shop Kid's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="{{ url("#") }}">Kids Toys</a>
													<a href="{{ url("#") }}">Kids Travel Car</a>
													<a href="{{ url("#") }}">Kids Color Shape</a>
													<a href="{{ url("#") }}">Kids Tent</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="{{ url("#") }}" class="title-link">Shop Men's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="{{ url("#") }}">Watch</a>
													<a href="{{ url("#") }}">T-shirt</a>
													<a href="{{ url("#") }}">Hoodies</a>
													<a href="{{ url("#") }}">Formal Pant</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="{{ url("#") }}" class="title-link">Shop Women's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="{{ url("#") }}">Ladies Shirt</a>
													<a href="{{ url("#") }}">Ladies Frog</a>
													<a href="{{ url("#") }}">Ladies Sun Glass</a>
													<a href="{{ url("#") }}">Ladies Watch</a>
												</div>
											</li>
										</ul>
									</li>
									<li><a href="{{ url("#") }}">accessories</a></li>
									<li><a href="{{ url("#") }}">top 100 offer</a></li>
									<li><a href="{{ url("#") }}">sunglass</a></li>
									<li><a href="{{ url("#") }}">watch</a></li>
									<li><a href="{{ url("#") }}">man’s product</a></li>
									<li><a href="{{ url("#") }}">ladies</a></li>
									<li><a href="{{ url("#") }}">westrn dress</a></li>
									<li><a href="{{ url("#") }}">denim </a></li>
								</ul>
							</div>
						</div> --}}
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
													<li class="active"><a href="{{ url("#") }}">Home</a></li>
													<li><a href="{{ url("#") }}">Product</a></li>
													<li><a href="{{ url("#") }}">Service</a></li>
													<li><a href="{{ url("#") }}">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
														<ul class="dropdown">
															<li><a href="{{ url("shop-grid.html") }}">Shop Grid</a></li>
															<li><a href="{{ url("cart.html") }}">Cart</a></li>
															<li><a href="{{ url("checkout.html") }}">Checkout</a></li>
														</ul>
													</li>
													<li><a href="{{ url("#") }}">Pages</a></li>
													<li><a href="{{ url("#") }}">Blog<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="{{ url("blog-single-sidebar.html") }}">Blog Single Sidebar</a></li>
														</ul>
													</li>
													<li><a href="{{ url("contact.html") }}">Contact Us</a></li>
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->

	@yield('content')

	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="{{ url("index.html") }}"><img src="{{ asset("/eshop/images/logo2.png") }}" alt="#"></a>
							</div>
							<p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
							<p class="call">Got Question? Call us 24/7<span><a href="{{ url("tel:123456789") }}">+0123 456 789</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="{{ url("#") }}">About Us</a></li>
								<li><a href="{{ url("#") }}">Faq</a></li>
								<li><a href="{{ url("#") }}">Terms & Conditions</a></li>
								<li><a href="{{ url("#") }}">Contact Us</a></li>
								<li><a href="{{ url("#") }}">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="{{ url("#") }}">Payment Methods</a></li>
								<li><a href="{{ url("#") }}">Money-back</a></li>
								<li><a href="{{ url("#") }}">Returns</a></li>
								<li><a href="{{ url("#") }}">Shipping</a></li>
								<li><a href="{{ url("#") }}">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>NO. 342 - London Oxford Street.</li>
									<li>012 United Kingdom.</li>
									<li>info@eshop.com</li>
									<li>+032 3456 7890</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="{{ url("#") }}"><i class="ti-facebook"></i></a></li>
								<li><a href="{{ url("#") }}"><i class="ti-twitter"></i></a></li>
								<li><a href="{{ url("#") }}"><i class="ti-flickr"></i></a></li>
								<li><a href="{{ url("#") }}"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2020 <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{ asset("/eshop/images/payments.png") }}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->

    <div class="modal fade" id="add_cart_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" style="width: 300px !important" role="document">
            <form method="post" action="{{ route('kerajang.store') }}">
                @csrf
                <div class="modal-content">
                    <input type="hidden" name="produk_id" id="produk_id" value="">
                    <div class="modal-body p-3" style="height: 100px !important; overflow-y: hidden">
                        <div class="mb-3">
                          <div class="d-flex justify-content-between">
                            <label for="kuantitas" class="form-label">Kuantitas</label>
                          <label for="kuantitas" class="form-label" id="num_qty"></label>
                          </div>
                          <input type="number"
                            class="form-control" name="kuantitas" id="kuantitas" placeholder="Masukan jumlah kuantitas" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="padding: 10px !important">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

	<!-- Jquery -->
    <script src="{{ asset("/eshop/js/jquery.min.js") }}"></script>
    <script src="{{ asset("/eshop/js/jquery-migrate-3.0.0.js") }}"></script>
	<script src="{{ asset("/eshop/js/jquery-ui.min.js") }}"></script>
	<!-- Popper JS -->
	<script src="{{ asset("/eshop/js/popper.min.js") }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset("/eshop/js/bootstrap.min.js") }}"></script>
	<!-- Color JS -->
	<script src="{{ asset("/eshop/js/colors.js") }}"></script>
	<!-- Slicknav JS -->
	<script src="{{ asset("/eshop/js/slicknav.min.js") }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset("/eshop/js/owl-carousel.js") }}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{ asset("/eshop/js/magnific-popup.js") }}"></script>
	<!-- Waypoints JS -->
	<script src="{{ asset("/eshop/js/waypoints.min.js") }}"></script>
	<!-- Countdown JS -->
	<script src="{{ asset("/eshop/js/finalcountdown.min.js") }}"></script>
	<!-- Nice Select JS -->
	<script src="{{ asset("/eshop/js/nicesellect.js") }}"></script>
	<!-- Flex Slider JS -->
	<script src="{{ asset("/eshop/js/flex-slider.js") }}"></script>
	<!-- ScrollUp JS -->
	<script src="{{ asset("/eshop/js/scrollup.js") }}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{ asset("/eshop/js/onepage-nav.min.js") }}"></script>
	<!-- Easing JS -->
	<script src="{{ asset("/eshop/js/easing.js") }}"></script>
	<!-- Active JS -->
	<script src="{{ asset("/eshop/js/active.js") }}"></script>


    <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

@stack('js')
<script>
    function add_card(produk_id,stok){
                let modal = $('#add_cart_modal')
                modal.find('#produk_id').val(produk_id)
                modal.find('#num_qty').text('Tersedia '+ stok)
                modal.find('input[name="kuantitas"]').attr('max', stok)
                modal.modal('show')
            }
</script>

        @if (session('success'))
        <script>
            alertify.success("{{ session('success') }}");
        </script>
        @endif
        @if (session('error'))
        <script>
            alertify.error("{{ session('error') }}");
        </script>
        @endif
</body>
</html>
