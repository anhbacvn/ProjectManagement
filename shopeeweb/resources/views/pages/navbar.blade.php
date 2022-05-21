{{View::make('pages.header')}}
<?php

use Illuminate\Support\Facades\Session;
?>
<header id="header">
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle" id="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{URL::to('/home')}}"><img src="{{('../fontend/images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{URL::to('show-cart')}}" id="cart"><i class="fa fa-shopping-cart"></i>Giỏ hàng
                                    <?php
                                    $qty_cart = Session::get('qty_cart');
                                    ?>
                                    @if($qty_cart != -1)
                                    <sup id="qty-cart">{{$qty_cart}}</sup>
                                    @endif
                                </a>
                            </li>
                            <?php
                            $get_user = Session::get('get_user');
                            if ($get_user) {
                            ?>
                                <li class="user-menu-dropdown">
                                    <a href="{{URL::to('profile-info')}}">
                                        @if($get_user->avatar!=null)
                                        <img src="{{URL::to('public/upload/image_user/'.$get_user->avatar)}}" alt="" style="width:25px;height:25px;">
                                        @else
                                        <img src="{{URL::to('public/upload/image_user/avatar_default.jpg')}}" alt="" style="width:25px;height:25px;">
                                        @endif
                                        {{$get_user->name}}
                                    </a>
                                    <ul class="user-menu-dropdown-content body-tab">
                                        <li id="dropdown_info"><a href="{{URL::to('profile-info')}}"><i class="fa fa-lock"></i> Tài khoản của tôi</a></li>
                                        <li id="dropdown_my_purchase"><a href="{{URL::to('my-purchase-status/-1')}}"><i class="fa fa-lock"></i> Đơn mua</a></li>
                                        <li><a href="{{URL::to('user-logout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                    </ul>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li><a href="{{URL::to('user-login')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(window).scroll(function() {
            var y = pageYOffset;
            if (y > 38) {
                $('#header-middle').addClass('fixed');
            } else {
                $('#header-middle').removeClass('fixed');
            }
        })
    </script>
    <!--/header-middle-->