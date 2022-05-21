<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>

<head>
	<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />


	<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
	<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet" />
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css" />
	<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('fontend/css/bootstrap4.css')}}" type="text/css" />
	<!-- <link rel="stylesheet" href="{{asset('fontend/css/icon-font-awesome.min.css')}}" type="text/css"> -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
</head>

<body>
	<section id="container">
		<!--header start-->
		<header class="header fixed-top clearfix">
			<!--logo start-->
			<div class="brand">
				<a href="index.html" class="logo">
					ADMIN
				</a>
				<div class="sidebar-toggle-box">
					<div class="fa fa-bars"></div>
				</div>
			</div>
			<!--logo end-->

			<div class="top-nav clearfix">
				<!--search & user info start-->
				<ul class="nav pull-right top-menu">
					<!-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> -->
					<!-- user login dropdown start-->
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<img alt="" src="{{('backend/images/2.png')}}">
							<span class="username">
								<?php
								$name = Session::get('admin_name');
								if ($name) {
									echo $name;
								}
								?>
							</span>
						</a>
						<ul class="dropdown-menu extended logout">
							<li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
							<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
						</ul>
					</li>
					<!-- user login dropdown end -->

				</ul>
				<!--search & user info end-->
			</div>
		</header>
		<!--header end-->
		<!--sidebar start-->
		<aside>
			<div id="sidebar" class="nav-collapse">
				<k!-- sidebar menu start-->
					<div class="leftside-navigation">
						<ul class="sidebar-menu" id="nav-accordion">
							<li>
								<a class="active" href="{{URL::to('/dashboard')}}">
									<i class="fa fa-dashboard"></i>
									<span>Tổng quan</span>
								</a>
							</li>

							<li class="sub-menu">
								<a href="javascript:;">
									<i class="fa fa-book"></i>
									<span>Đơn hàng</span>
								</a>
								<ul class="sub">
									<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
								</ul>
							</li>

							<li class="sub-menu">
								<a href="javascript:;">
									<i class="fa fa-book"></i>
									<span>Danh mục sản phẩm</span>
								</a>
								<ul class="sub">
									<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
									<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
								</ul>
							</li>

							<li class="sub-menu">
								<a href="javascript:;">
									<i class="fa fa-book"></i>
									<span>Thương hiệu sản phẩm</span>
								</a>
								<ul class="sub">
									<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
									<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
								</ul>
							</li>

							<li class="sub-menu">
								<a href="javascript:;">
									<i class="fa fa-book"></i>
									<span>Sản phẩm</span>
								</a>
								<ul class="sub">
									<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
									<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- sidebar menu end-->
			</div>
		</aside>
		<!--sidebar end-->
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper" id="pjax">
				@yield('admin_content')
			</section>
			<!-- footer -->
			<div class="footer">
				<div class="wthree-copyright">
					<p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
				</div>
			</div>
			<!-- / footer -->
		</section>
		<!--main content end-->
	</section>
	<script src="{{asset('backend/js/bootstrap.js')}}"></script>
	<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
	<script src="{{asset('backend/js/scripts.js')}}"></script>
	<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
	<script>
		$(document).ready(function() {
			$(document).pjax('a', '#pjax');
		})
	</script>
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="{{asset('backend/js/monthly.js')}}"></script>
	<script src="{{asset('backend/js/jquery.pjax.js')}}"></script>
	<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
	<script src="{{asset('backend/js/raphael-min.js')}}"></script>
	<script src="{{asset('backend/js/morris.js')}}"></script>
	<script src="{{asset('fontend/js/bootstrap4.js')}}"></script>
	<script src="{{asset('fontend/js/jquery.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js" integrity="sha512-7G7ueVi8m7Ldo2APeWMCoGjs4EjXDhJ20DrPglDQqy8fnxsFQZeJNtuQlTT0xoBQJzWRFp4+ikyMdzDOcW36kQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>