<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Electro - HTML Ecommerce Template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="{{asset('indexPage/css/bootstrap.min.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('indexPage/css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('indexPage/css/slick-theme.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('indexPage/css/nouislider.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('indexPage/css/font-awesome.min.css')}}">
		<link type="text/css" rel="stylesheet" href="{{asset('indexPage/css/style.css')}}"/>
        <link href="{{ asset('homes/css/style.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
   </head>
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        @livewireStyles
</head>
	<body>
		<header>
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i>{{ session()->get('site_data')->phone1??'' }}</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> {{ session()->get('site_data')->email??'' }}</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i>{{ session()->get('site_data')->address??'' }}</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                        @if(auth()->guard('customer')->check())
                        <li><a href="{{ route('profile') }}">My Account</a></li>
                         @else
                        <li><a href="{{ route('customer.login.form') }}">Login</a></li>
                        @endif
					</ul>
				</div>
			</div>
			<div id="header">
				<div class="container">
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="{{asset('indexPage/img/logo.png')}}" alt="">
								</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="header-search">
                                <nav id="">
                                    <div class="container">
                                        <div id="responsive-nav">
                                            {{--  <ul class="main-nav nav navbar-nav">
                                                <li><a style="color:white" href="{{route('index')}}">Home</a></li>
                                                <li><a style="color:white" href="{{route('order')}}">Orders</a></li>
                                                <li><a style="color:white" href="{{ route('contact') }}">Contact</a></li>
                                                @if(auth()->guard('customer')->check())
                                                <li><a style="color:white" href="{{ route('profile') }}">Profile</a></li>
                                                 @else
                                                <li><a style="color:white" href="{{ route('customer.login.form') }}">Login</a></li>
                                                @endif
                                            </ul>  --}}
                                        </div>
                                    </div>
                                </nav>
								{{--  <form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>  --}}
							</div>
						</div>
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<div>
									<a href="{{ route('show.favorite') }}">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">{{ count(auth()->guard('customer')->user()->favoriteIds??[])??0 }}</div>
									</a>
								</div>

								<div class="">
									<a href="{{route('cart')}}">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div id="count_array" class="qty">{{ count((array) session('cart')) }}</div>
									</a>
								</div>
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<nav id="navigation">
			<div class="container">
				<div id="responsive-nav">
					<ul class="main-nav nav navbar-nav">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('order')}}">Orders</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        @if(auth()->guard('customer')->check())
                        <li><a href="{{ route('profile') }}">Profile</a></li>
                         @else
                        <li><a href="{{ route('customer.login.form') }}">Login</a></li>
                        @endif
                    </ul>
				</div>
			</div>
		</nav>


		<div class="section">
			<div class="container">

                @yield('content')

			</div>
		</div>
		<div id="hot-deal" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>

			</div>

		</div>
		<div id="newsletter" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer id="footer">
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
                                    <li><a href="#"><i class="fa fa-phone"></i>{{ session()->get('site_data')->phone1??'' }}</a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i>{{ session()->get('site_data')->phone2??'' }}</a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i> {{ session()->get('site_data')->email??'' }}</a></li>
                                    <li><a href="#"><i class="fa fa-map-marker"></i>{{ session()->get('site_data')->address??'' }}</a></li>
                                </ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
                                    @foreach (getSubCategory() as $item)
                                    <li><a href="{{ route('show-products.show',$item->id) }}"> {{ $item->name }}</a></li>

                                    @endforeach

                                </ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="{{route('about')}}">About Us</a></li>
									<li><a href="{{route('contact')}}">Contact Us</a></li>
									<li><a href="{{ route('order') }}">Orders</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
                                    @if(auth()->guard('customer')->check())
                                    <li><a href="{{ route('profile') }}">My Account</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}"  accept-charset="UTF-8" id="form1">
                                            {{ method_field('POST') }} {{ csrf_field() }}
                                            <a  class="nav-link" href="#" onclick="document.getElementById('form1').submit();">logout!</a>
                                        </form>
                                    </li>
                                     @else
                                    <li><a href="{{ route('customer.login.form') }}">Login</a></li>
                                    @endif
                                                <li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom-footer" class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>

				</div>

			</div>
		</footer>
		<!-- jQuery Plugins -->
		<script src="{{asset('indexPage/js/jquery.min.js')}}"></script>
		<script src="{{asset('indexPage/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('indexPage/js/slick.min.js')}}"></script>
		<script src="{{asset('indexPage/js/nouislider.min.js')}}"></script>
		<script src="{{asset('indexPage/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('indexPage/js/main.js')}}"></script>
        @livewireScripts
	</body>
    </html>
