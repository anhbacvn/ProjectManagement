@extends('pages.profile')
@section('profile_content')
<?php

use Illuminate\Support\Facades\Session;

$get_order = Session::get('get_order');
// echo '<pre>';
// print_r($get_address);
// echo '</pre>';
?>
<div class="Product_detail">
    <input type="hidden" value="{{$get_order->order_status}}">
    <div class="product_detail_header">
        <div id="product_detail_back" style="color: rgba(0,0,0,.54);cursor: pointer;">
            <svg style="height:16px;margin: 0 5px 0 0;font-size: 14px;" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon icon-arrow-left">
                <g>
                    <path d="m8.5 11c-.1 0-.2 0-.3-.1l-6-5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4l6-5c .2-.2.5-.1.7.1s.1.5-.1.7l-5.5 4.6 5.5 4.6c.2.2.2.5.1.7-.1.1-.3.2-.4.2z"></path>
                </g>
            </svg>
            <span style="line-height:20px;vertical-align:bottom;">TRỞ LẠI</span>
        </div>
        <div>
            <span>ID ĐƠN HÀNG: {{$get_order->order_id}}</span>
            <span style="margin: 0 16px;">|</span>
            @switch($get_order->order_status)
            @case(0)
            <span style="color:#FE980F;text-transform: uppercase;">Đang chờ xác nhận</span>
            @break
            @case (1)
            <span style="color:#FE980F;text-transform: uppercase;">Đang chờ lấy hàng</span>
            @break
            @case (2)
            <span style="color:#FE980F;text-transform: uppercase;">Đang giao</span>
            @break
            @case (3)
            <span style="color:#FE980F;text-transform: uppercase;">Đã giao</span>
            @break
            @case (4)
            <span style="color:#FE980F;text-transform: uppercase;">Đã huỷ</span>
            @break
            @endswitch
        </div>
    </div>

    @switch($get_order->order_status)
    @case(0)
    <!-- Chờ xác nhận -->
    <div class="product_detail_content">
        <div class="product_detail_stepper">
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-order">
                        <g>
                            <path d="m5 3.4v23.7c0 .4.3.7.7.7.2 0 .3 0 .3-.2.5-.4 1-.5 1.7-.5.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1s1.7.4 2.2 1.1c.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.7 0 1.2.2 1.7.5.2.2.3.2.3.2.3 0 .7-.4.7-.7v-23.7z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></path>
                            <g>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="11.5" y2="11.5"></line>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="18.5" y2="18.5"></line>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đơn hàng đã đặt</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-paid">
                        <g>
                            <path clip-rule="evenodd" d="m24 22h-21c-.5 0-1-.5-1-1v-15c0-.6.5-1 1-1h21c .5 0 1 .4 1 1v15c0 .5-.5 1-1 1z" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path clip-rule="evenodd" d="m24.8 10h4.2c.5 0 1 .4 1 1v15c0 .5-.5 1-1 1h-21c-.6 0-1-.4-1-1v-4" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path d="m12.9 17.2c-.7-.1-1.5-.4-2.1-.9l.8-1.2c.6.5 1.1.7 1.7.7.7 0 1-.3 1-.8 0-1.2-3.2-1.2-3.2-3.4 0-1.2.7-2 1.8-2.2v-1.3h1.2v1.2c.8.1 1.3.5 1.8 1l-.9 1c-.4-.4-.8-.6-1.3-.6-.6 0-.9.2-.9.8 0 1.1 3.2 1 3.2 3.3 0 1.2-.6 2-1.9 2.3v1.2h-1.2z" stroke="none"></path>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Chờ xác nhận thông tin thanh toán</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-shipping">
                        <g>
                            <line fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="18.1" x2="9.6" y1="20.5" y2="20.5"></line>
                            <circle cx="7.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <circle cx="20.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <line fill="none" stroke-miterlimit="10" stroke-width="3" x1="19.7" x2="30" y1="15.5" y2="15.5"></line>
                            <polyline fill="none" points="4.6 20.5 1.5 20.5 1.5 4.5 20.5 4.5 20.5 18.4" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="20.5 9 29.5 9 30.5 22 24.7 22" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đã giao cho ĐVVC</div>
            </div>
            <div class="stepper__step stepper__step--pending">
                <div class="stepper__step-icon"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-received">
                        <g>
                            <polygon fill="none" points="2 28 2 19.2 10.6 19.2 11.7 21.5 19.8 21.5 20.9 19.2 30 19.1 30 28" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                            <polyline fill="none" points="21 8 27 8 30 19.1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="2 19.2 5 8 11 8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="16" x2="16" y1="4" y2="14"></line>
                            <path d="m20.1 13.4-3.6 3.6c-.3.3-.7.3-.9 0l-3.6-3.6c-.4-.4-.1-1.1.5-1.1h7.2c.5 0 .8.7.4 1.1z" stroke="none"></path>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đang giao</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__step">
                <div class="stepper__step-icon">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-rating">
                        <polygon fill="none" points="16 3.2 20.2 11.9 29.5 13 22.2 19 24.3 28.8 16 23.8 7.7 28.8 9.8 19 2.5 13 11.8 11.9" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                    </svg>
                </div>
                <div class="stepper__step-text">đánh giá</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__line">
                <div class="stepper__line-background" style="background: rgb(224, 224, 224);"></div>
                <div class="stepper__line-foreground" style="width: calc((100% - 630px) * 0.75); background: rgb(45, 194, 88);"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="bbL+1w">
            <div class="SfqFiN">Đơn hàng của bạn đang chờ được xác nhận thông tin thanh toán.</div>
        </div>
    </div>
    @break
    @case (1)
    <!-- Chờ lấy hàng -->
    <div class="product_detail_content">
        <div class="product_detail_stepper">
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-order">
                        <g>
                            <path d="m5 3.4v23.7c0 .4.3.7.7.7.2 0 .3 0 .3-.2.5-.4 1-.5 1.7-.5.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1s1.7.4 2.2 1.1c.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.7 0 1.2.2 1.7.5.2.2.3.2.3.2.3 0 .7-.4.7-.7v-23.7z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></path>
                            <g>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="11.5" y2="11.5"></line>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="18.5" y2="18.5"></line>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đơn hàng đã đặt</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-paid">
                        <g>
                            <path clip-rule="evenodd" d="m24 22h-21c-.5 0-1-.5-1-1v-15c0-.6.5-1 1-1h21c .5 0 1 .4 1 1v15c0 .5-.5 1-1 1z" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path clip-rule="evenodd" d="m24.8 10h4.2c.5 0 1 .4 1 1v15c0 .5-.5 1-1 1h-21c-.6 0-1-.4-1-1v-4" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path d="m12.9 17.2c-.7-.1-1.5-.4-2.1-.9l.8-1.2c.6.5 1.1.7 1.7.7.7 0 1-.3 1-.8 0-1.2-3.2-1.2-3.2-3.4 0-1.2.7-2 1.8-2.2v-1.3h1.2v1.2c.8.1 1.3.5 1.8 1l-.9 1c-.4-.4-.8-.6-1.3-.6-.6 0-.9.2-.9.8 0 1.1 3.2 1 3.2 3.3 0 1.2-.6 2-1.9 2.3v1.2h-1.2z" stroke="none"></path>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đã xác nhận thông tin thanh toán</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-shipping">
                        <g>
                            <line fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="18.1" x2="9.6" y1="20.5" y2="20.5"></line>
                            <circle cx="7.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <circle cx="20.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <line fill="none" stroke-miterlimit="10" stroke-width="3" x1="19.7" x2="30" y1="15.5" y2="15.5"></line>
                            <polyline fill="none" points="4.6 20.5 1.5 20.5 1.5 4.5 20.5 4.5 20.5 18.4" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="20.5 9 29.5 9 30.5 22 24.7 22" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Chờ ĐVVC lấy hàng</div>
            </div>
            <div class="stepper__step stepper__step--pending">
                <div class="stepper__step-icon"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-received">
                        <g>
                            <polygon fill="none" points="2 28 2 19.2 10.6 19.2 11.7 21.5 19.8 21.5 20.9 19.2 30 19.1 30 28" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                            <polyline fill="none" points="21 8 27 8 30 19.1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="2 19.2 5 8 11 8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="16" x2="16" y1="4" y2="14"></line>
                            <path d="m20.1 13.4-3.6 3.6c-.3.3-.7.3-.9 0l-3.6-3.6c-.4-.4-.1-1.1.5-1.1h7.2c.5 0 .8.7.4 1.1z" stroke="none"></path>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đang giao</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__step">
                <div class="stepper__step-icon">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-rating">
                        <polygon fill="none" points="16 3.2 20.2 11.9 29.5 13 22.2 19 24.3 28.8 16 23.8 7.7 28.8 9.8 19 2.5 13 11.8 11.9" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                    </svg>
                </div>
                <div class="stepper__step-text">đánh giá</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__line">
                <div class="stepper__line-background" style="background: rgb(224, 224, 224);"></div>
                <div class="stepper__line-foreground" style="width: calc((100% - 360px) * 0.75); background: rgb(45, 194, 88);"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="bbL+1w">
            <div class="SfqFiN">Đơn hàng của bạn đang được bàn giao cho ĐVVC.</div>
        </div>
    </div>
    @break
    @case (2)
    <!-- Đang giao -->
    <div class="product_detail_content">
        <div class="product_detail_stepper">
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-order">
                        <g>
                            <path d="m5 3.4v23.7c0 .4.3.7.7.7.2 0 .3 0 .3-.2.5-.4 1-.5 1.7-.5.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1s1.7.4 2.2 1.1c.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.7 0 1.2.2 1.7.5.2.2.3.2.3.2.3 0 .7-.4.7-.7v-23.7z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></path>
                            <g>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="11.5" y2="11.5"></line>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="18.5" y2="18.5"></line>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đơn hàng đã đặt</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-paid">
                        <g>
                            <path clip-rule="evenodd" d="m24 22h-21c-.5 0-1-.5-1-1v-15c0-.6.5-1 1-1h21c .5 0 1 .4 1 1v15c0 .5-.5 1-1 1z" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path clip-rule="evenodd" d="m24.8 10h4.2c.5 0 1 .4 1 1v15c0 .5-.5 1-1 1h-21c-.6 0-1-.4-1-1v-4" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path d="m12.9 17.2c-.7-.1-1.5-.4-2.1-.9l.8-1.2c.6.5 1.1.7 1.7.7.7 0 1-.3 1-.8 0-1.2-3.2-1.2-3.2-3.4 0-1.2.7-2 1.8-2.2v-1.3h1.2v1.2c.8.1 1.3.5 1.8 1l-.9 1c-.4-.4-.8-.6-1.3-.6-.6 0-.9.2-.9.8 0 1.1 3.2 1 3.2 3.3 0 1.2-.6 2-1.9 2.3v1.2h-1.2z" stroke="none"></path>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">đã xác nhận thông tin thanh toán</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-shipping">
                        <g>
                            <line fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="18.1" x2="9.6" y1="20.5" y2="20.5"></line>
                            <circle cx="7.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <circle cx="20.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <line fill="none" stroke-miterlimit="10" stroke-width="3" x1="19.7" x2="30" y1="15.5" y2="15.5"></line>
                            <polyline fill="none" points="4.6 20.5 1.5 20.5 1.5 4.5 20.5 4.5 20.5 18.4" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="20.5 9 29.5 9 30.5 22 24.7 22" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đã giao cho ĐVVC</div>
            </div>
            <div class="stepper__step stepper__step--pending">
                <div class="stepper__step-icon stepper__step-icon--pending"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-received">
                        <g>
                            <polygon fill="none" points="2 28 2 19.2 10.6 19.2 11.7 21.5 19.8 21.5 20.9 19.2 30 19.1 30 28" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                            <polyline fill="none" points="21 8 27 8 30 19.1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="2 19.2 5 8 11 8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="16" x2="16" y1="4" y2="14"></line>
                            <path d="m20.1 13.4-3.6 3.6c-.3.3-.7.3-.9 0l-3.6-3.6c-.4-.4-.1-1.1.5-1.1h7.2c.5 0 .8.7.4 1.1z" stroke="none"></path>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đang giao</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__step">
                <div class="stepper__step-icon">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-rating">
                        <polygon fill="none" points="16 3.2 20.2 11.9 29.5 13 22.2 19 24.3 28.8 16 23.8 7.7 28.8 9.8 19 2.5 13 11.8 11.9" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                    </svg>
                </div>
                <div class="stepper__step-text">đánh giá</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__line">
                <div class="stepper__line-background" style="background: rgb(224, 224, 224);"></div>
                <div class="stepper__line-foreground" style="width: calc((100% - 140px) * 0.75); background: rgb(45, 194, 88);"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="bbL+1w">
            <div class="SfqFiN">Bạn hài lòng với sản phẩm đã nhận? Nếu có, chọn "Đã nhận được hàng" nha.</div>
            <div class="lR6IMn">
                <button type="button" class="stardust-button stardust-button--primary Kz9HeM">Đã nhận hàng</button>
            </div>
        </div>
    </div>
    @break
    @case (3)
    <!-- Đã giao -->
    <div class="product_detail_content">
        <div class="product_detail_stepper">
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-order">
                        <g>
                            <path d="m5 3.4v23.7c0 .4.3.7.7.7.2 0 .3 0 .3-.2.5-.4 1-.5 1.7-.5.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1s1.7.4 2.2 1.1c.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.7 0 1.2.2 1.7.5.2.2.3.2.3.2.3 0 .7-.4.7-.7v-23.7z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></path>
                            <g>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="11.5" y2="11.5"></line>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="18.5" y2="18.5"></line>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đơn hàng đã đặt</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-paid">
                        <g>
                            <path clip-rule="evenodd" d="m24 22h-21c-.5 0-1-.5-1-1v-15c0-.6.5-1 1-1h21c .5 0 1 .4 1 1v15c0 .5-.5 1-1 1z" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path clip-rule="evenodd" d="m24.8 10h4.2c.5 0 1 .4 1 1v15c0 .5-.5 1-1 1h-21c-.6 0-1-.4-1-1v-4" fill="none" fill-rule="evenodd" stroke-miterlimit="10" stroke-width="3"></path>
                            <path d="m12.9 17.2c-.7-.1-1.5-.4-2.1-.9l.8-1.2c.6.5 1.1.7 1.7.7.7 0 1-.3 1-.8 0-1.2-3.2-1.2-3.2-3.4 0-1.2.7-2 1.8-2.2v-1.3h1.2v1.2c.8.1 1.3.5 1.8 1l-.9 1c-.4-.4-.8-.6-1.3-.6-.6 0-.9.2-.9.8 0 1.1 3.2 1 3.2 3.3 0 1.2-.6 2-1.9 2.3v1.2h-1.2z" stroke="none"></path>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">đã xác nhận thông tin thanh toán</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-shipping">
                        <g>
                            <line fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="18.1" x2="9.6" y1="20.5" y2="20.5"></line>
                            <circle cx="7.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <circle cx="20.5" cy="23.5" fill="none" r="4" stroke-miterlimit="10" stroke-width="3"></circle>
                            <line fill="none" stroke-miterlimit="10" stroke-width="3" x1="19.7" x2="30" y1="15.5" y2="15.5"></line>
                            <polyline fill="none" points="4.6 20.5 1.5 20.5 1.5 4.5 20.5 4.5 20.5 18.4" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="20.5 9 29.5 9 30.5 22 24.7 22" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đã giao cho ĐVVC</div>
                <div class="stepper__step-date">17:05 09-05-2022</div>
            </div>
            <div class="stepper__step stepper__step--pending">
                <div class="stepper__step-icon stepper__step-icon--pending"><svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-received">
                        <g>
                            <polygon fill="none" points="2 28 2 19.2 10.6 19.2 11.7 21.5 19.8 21.5 20.9 19.2 30 19.1 30 28" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                            <polyline fill="none" points="21 8 27 8 30 19.1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <polyline fill="none" points="2 19.2 5 8 11 8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polyline>
                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="16" x2="16" y1="4" y2="14"></line>
                            <path d="m20.1 13.4-3.6 3.6c-.3.3-.7.3-.9 0l-3.6-3.6c-.4-.4-.1-1.1.5-1.1h7.2c.5 0 .8.7.4 1.1z" stroke="none"></path>
                        </g>
                    </svg></div>
                <div class="stepper__step-text">Đang giao</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-rating">
                        <polygon fill="none" points="16 3.2 20.2 11.9 29.5 13 22.2 19 24.3 28.8 16 23.8 7.7 28.8 9.8 19 2.5 13 11.8 11.9" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></polygon>
                    </svg>
                </div>
                <div class="stepper__step-text ">Đã giao</div>
                <div class="stepper__step-date"></div>
            </div>
            <div class="stepper__line">
                <div class="stepper__line-background" style="background: rgb(224, 224, 224);"></div>
                <div class="stepper__line-foreground" style="background: rgb(45, 194, 88);"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="bbL+1w">
            <div class="SfqFiN">Cảm ơn bạn đã mua sắm tại Shoppe!</div>
        </div>
    </div>
    @break
    @case (4)
    <!-- Đã huỷ -->
    <div class="product_detail_content">
        <div class="product_detail_stepper">
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-order">
                        <g>
                            <path d="m5 3.4v23.7c0 .4.3.7.7.7.2 0 .3 0 .3-.2.5-.4 1-.5 1.7-.5.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1s1.7.4 2.2 1.1c.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.7 0 1.2.2 1.7.5.2.2.3.2.3.2.3 0 .7-.4.7-.7v-23.7z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></path>
                            <g>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="11.5" y2="11.5"></line>
                                <line fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" x1="10" x2="22" y1="18.5" y2="18.5"></line>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đơn hàng đã đặt</div>
            </div>
            <div class="stepper__step stepper__step--finish">
                <div class="stepper__step-icon stepper__step-icon--finish">
                    <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" x="0" y="0" class="shopee-svg-icon icon-order-problem">
                        <g>
                            <g>
                                <path d="m5 3.4v23.7c0 .4.3.7.7.7.2 0 .3 0 .3-.2.5-.4 1-.5 1.7-.5.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1s1.7.4 2.2 1.1c.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.9 0 1.7.4 2.2 1.1.2.2.3.4.5.4s.3-.2.5-.4c.5-.7 1.4-1.1 2.2-1.1.7 0 1.2.2 1.7.5.2.2.3.2.3.2.3 0 .7-.4.7-.7v-23.7z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"></path>
                            </g>
                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3" x1="16" x2="16" y1="9" y2="15"></line>
                            <circle cx="16" cy="20.5" r="2" stroke="none"></circle>
                        </g>
                    </svg>
                </div>
                <div class="stepper__step-text">Đã hàng đã bị huỷ</div>
            </div>
            <div class="stepper__line">
                <div class="stepper__line-background" style="background: rgb(224, 224, 224);"></div>
                <div class="stepper__line-foreground" style="background: rgb(45, 194, 88);"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="bbL+1w">
            <div class="SfqFiN">Bạn đã huỷ đơn hàng này.</div>
            <div class="lR6IMn">
                <button type="button" class="stardust-button stardust-button--primary Kz9HeM">Mua lại</button>
            </div>
        </div>
    </div>
    @break
    @endswitch

</div>


<div>
    <div class="JNf2c8">
        <div class="r3nkAD"></div>
    </div>
    <div class="rU5kQ6">
        <div class="ASGNe9">
            <div class="ver7Tm">Địa chỉ nhận hàng</div>
        </div>
        <div class="RKBD1x">
            <div class="ikpx1p">
                <div class="D+2WM2">{{$get_address->address_shipping_name}}</div>
                <div class="IqSKNq"><span>(+84) {{$get_address->address_shipping_phone}}</span><br>{{$get_address->address_shipping_detail}}, {{$get_address->address_shipping_wards}}, {{$get_address->address_shipping_district}}, {{$get_address->address_shipping_city}}</div>
            </div>
            <div class="w5KHDc">
                <div>
                    @foreach($get_order_status_detail as $item)
                    <div class="Wo2MM5">
                        <div class="VLmetq"></div>
                        <div class="iMSI13">
                            <div class="oejwON"></div>
                            <div class="_15h9PB">{{$item->created_at}}</div>
                            <div><span>{{$item->order_status_title}}</span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div>
        <div class="z1upOh">
            <div class="vdofqJ">
                @foreach($get_order_detail_product as $value)
                <div>
                    <a class="QkIuzE" href="/Giầy-nhựa-nam-đi-mưa-và-bảo-hộ-lao-động-size-38-43-i.17013884.5329056332">
                        <div></div>
                        <div class="hDGdsD">
                            <div class="_50XPwl">
                                <img class="product_image" src="{{URL::to('public/upload/product/'.$value->product_image)}}" alt="">
                            </div>
                            <div class="tODfT4">
                                <div>
                                    <div class="QJqUaT"><span class="WVc4Oc">{{$value->product_name}}</span></div>
                                </div>
                                <div>
                                    <div class="qGisqd">Số lượng: {{$value->order_detail_quantity}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="+QRFJX">
                            <div><span class="ghw9hb"><sup>đ</sup>{{number_format($value->order_detail_price)}}</span></div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="QZ4vFF">
            <div class="MqHNeD">
                <div class="vXeTuK"><span>Tổng tiền hàng</span></div>
                <div class="_30Hj4X">
                    <div><sup>đ</sup>{{number_format($get_order->order_total)}}</div>
                </div>
            </div>
            <div class="MqHNeD">
                <div class="vXeTuK"><span>Phí vận chuyển</span></div>
                <div class="_30Hj4X">
                    <div>Free</div>
                </div>
            </div>

            <div class="MqHNeD fF6WqS">
                <div class="vXeTuK _4I0y7U"><span>Tổng số tiền</span></div>
                <div class="_30Hj4X">
                    <div class="fqySNq"><sup>đ</sup>{{number_format($get_order->order_total)}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="QFUBut">
    <div class="MqHNeD">
        <div class="vXeTuK">
            <span>
                <span class="_2FYYuf"><span class="PbUiaK">
                        <svg width="16" height="16" viewBox="0 0 253 263" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M126.5 0.389801C126.5 0.389801 82.61 27.8998 5.75 26.8598C5.08763 26.8507 4.43006 26.9733 3.81548 27.2205C3.20091 27.4677 2.64159 27.8346 2.17 28.2998C1.69998 28.7657 1.32713 29.3203 1.07307 29.9314C0.819019 30.5425 0.688805 31.198 0.689995 31.8598V106.97C0.687073 131.07 6.77532 154.78 18.3892 175.898C30.003 197.015 46.7657 214.855 67.12 227.76L118.47 260.28C120.872 261.802 123.657 262.61 126.5 262.61C129.343 262.61 132.128 261.802 134.53 260.28L185.88 227.73C206.234 214.825 222.997 196.985 234.611 175.868C246.225 154.75 252.313 131.04 252.31 106.94V31.8598C252.31 31.1973 252.178 30.5414 251.922 29.9303C251.667 29.3191 251.292 28.7649 250.82 28.2998C250.35 27.8358 249.792 27.4696 249.179 27.2225C248.566 26.9753 247.911 26.852 247.25 26.8598C170.39 27.8998 126.5 0.389801 126.5 0.389801Z" fill="#ee4d2d"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M207.7 149.66L119.61 107.03C116.386 105.472 113.914 102.697 112.736 99.3154C111.558 95.9342 111.772 92.2235 113.33 88.9998C114.888 85.7761 117.663 83.3034 121.044 82.1257C124.426 80.948 128.136 81.1617 131.36 82.7198L215.43 123.38C215.7 120.38 215.85 117.38 215.85 114.31V61.0298C215.848 60.5592 215.753 60.0936 215.57 59.6598C215.393 59.2232 215.128 58.8281 214.79 58.4998C214.457 58.1705 214.063 57.909 213.63 57.7298C213.194 57.5576 212.729 57.4727 212.26 57.4798C157.69 58.2298 126.5 38.6798 126.5 38.6798C126.5 38.6798 95.31 58.2298 40.71 57.4798C40.2401 57.4732 39.7735 57.5602 39.3376 57.7357C38.9017 57.9113 38.5051 58.1719 38.1709 58.5023C37.8367 58.8328 37.5717 59.2264 37.3913 59.6604C37.2108 60.0943 37.1186 60.5599 37.12 61.0298V108.03L118.84 147.57C121.591 148.902 123.808 151.128 125.129 153.884C126.45 156.64 126.797 159.762 126.113 162.741C125.429 165.72 123.755 168.378 121.363 170.282C118.972 172.185 116.006 173.221 112.95 173.22C110.919 173.221 108.915 172.76 107.09 171.87L40.24 139.48C46.6407 164.573 62.3785 186.277 84.24 200.16L124.49 225.7C125.061 226.053 125.719 226.24 126.39 226.24C127.061 226.24 127.719 226.053 128.29 225.7L168.57 200.16C187.187 188.399 201.464 170.892 209.24 150.29C208.715 150.11 208.2 149.9 207.7 149.66Z" fill="#fff"></path>
                        </svg>
                    </span>
                </span>
                <span class="HFmUTM">Phương thức Thanh toán</span>
            </span>
        </div>
        <div class="_30Hj4X">
            <span class="HFmUTM">{{$get_order->payment_type}}</span>
        </div>
    </div>
</div>

<!-- Modal xác nhận hàng -->
<div class="modal_confirm">
    <div class="stardust-popup__overlay"></div>
    <div class="stardust-popup">
        <div class="stardust-popup__dialog--wrapper-top">
            <div class="stardust-popup-content">Tôi đã nhận và hài lòng với sản phẩm.Tôi sẽ không yêu cầu Hoàn Tiền hay Trả hàng</div>
        </div>
        <div class="stardust-popup-buttons">
            <span id="close_modal_confirm" class="stardust-popup-button stardust-popup-button--secondary" role="button">Không phải bây giờ</span>
            <span id="confirm_button" data-id="{{$get_order->order_id}}" class="stardust-popup-button stardust-popup-button--main" role="button">Xác nhận</span>
        </div>
    </div>
</div>



<script>
    $('#product_detail_back').click(function() {
        window.history.back();
    });

    $('.stardust-button').click(function() {
        $('.modal_confirm').css('display', 'flex');
    })

    $('#close_modal_confirm').click(function() {
        $('.modal_confirm').css('display', 'none');
    })

    $('#confirm_button').click(function() {
        $.ajax({
            url: '/confirm-order\/' + $(this).data('id'),
            type: 'get',
            success: function(res) {
                $('.modal_confirm').css('display', 'none');
                if (res.status === 200) {
                    window.location.href = '/product-detail\/' + res.id;
                }
                if (res.status === 403) {
                    swal("Thông báo", res.msg, 'error');
                }
            }
        });
    });
</script>
@endsection