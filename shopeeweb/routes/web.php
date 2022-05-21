<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend
Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'index']);
Route::post('/tim-kiem',[HomeController::class,'search']);

// Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}',[CategoryProduct::class,'show_category_home']);

// Chi tiết sản phẩm 
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class,'details_product']);

// Thương hiệu sản phẩm trang chủ
Route::get('/thuong-hieu-san-pham/{brand_product_id}',[BrandProduct::class,'show_brand_home']);



// Backend
Route::get('/admin',[AdminController::class,'index']);
Route::get('/dashboard',[AdminController::class,'show_dashboard']);
Route::get('/logout',[AdminController::class,'log_out']);
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);


//Category Product
Route::get('/add-category-product',[CategoryProduct::class,'add_category_product']);
Route::get('/all-category-product',[CategoryProduct::class,'all_category_product']);
Route::post('/save-category-product',[CategoryProduct::class,'save_category_product']);

Route::get('/edit-category-product/{category_id}',[CategoryProduct::class,'edit_category_product']);
Route::get('/delete-category-product/{category_id}',[CategoryProduct::class,'delete_category_product']);
Route::post('/update-category-product/{category_id}',[CategoryProduct::class,'update_category_product']);


Route::get('/change-category-status/{category_id}',[CategoryProduct::class,'change_category_status']);


//Brand Product
Route::get('/add-brand-product',[BrandProduct::class,'add_brand_product']);
Route::get('/all-brand-product',[BrandProduct::class,'all_brand_product']);
Route::post('/save-brand-product',[BrandProduct::class,'save_brand_product']);

Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class,'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class,'delete_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProduct::class,'update_brand_product']);

Route::get('/change-brand-status/{brand_product_id}',[BrandProduct::class,'change_brand_status']);


// Product
Route::get('/add-product',[ProductController::class,'add_product']);
Route::get('/all-product',[ProductController::class,'all_product']);
Route::post('/save-product',[ProductController::class,'save_product']);

Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);
Route::post('/update-product/{product_id}',[ProductController::class,'update_product']);

Route::get('/change-status/{product_id}',[ProductController::class,'change_status']);


// Cart
Route::post('/save-cart',[CartController::class,'save_cart']);
Route::get('/show-cart',[CartController::class,'show_cart']);
Route::get('/add-cart-ajax/{id}/{qty}',[CartController::class,'add_cart_ajax']);
Route::get('/danh-muc-san-pham/add-cart-ajax/{id}/{qty}',[CartController::class,'add_cart_ajax']);
Route::get('/thuong-hieu-san-pham/add-cart-ajax/{id}/{qty}',[CartController::class,'add_cart_ajax']);
Route::get('/chi-tiet-san-pham/add-cart-ajax/{id}/{qty}',[CartController::class,'add_cart_ajax']);

Route::get('/change-quantity-cart/{id}/{type}',[CartController::class,'change_quantity_cart']);
Route::get('/change-quantity/{id}/{qty}',[CartController::class,'change_quantity']);
Route::get('/delete-cart-product/{id}/',[CartController::class,'delete_cart_product']);

// User login
Route::get('/user-login',[HomeController::class,'user_login']);
Route::post('/login-post',[HomeController::class,'login_post']);
Route::get('/user-logout',[HomeController::class,'user_logout']);
Route::get('/forget-password/{email}',[HomeController::class,'forget_password']);




// User regiser
Route::get('/user-register',[HomeController::class,'user_register']);
Route::post('/register-post',[HomeController::class,'register_post']);

// Checkout
Route::get('/show-checkout',[CheckoutController::class,'show_checkout']);
Route::get('/payment/{id}',[CheckoutController::class,'payment']);
Route::post('/save-checkout-customer',[CheckoutController::class,'save_checkout_customer']);
Route::post('/order-place',[CheckoutController::class,'order_place']);

//Đơn hàng
Route::get('/manage-order',[CheckoutController::class,'manage_order']);
Route::get('/view-order/{order_id}',[CheckoutController::class,'view_order']);
Route::get('/change-order-status/{order_id}',[CheckoutController::class,'change_order_status']);
Route::get('/delete-order/{order_id}',[CheckoutController::class,'delete_order']);

// Profile
Route::get('/profile',[ProfileController::class,'profile']);
Route::post('/change-info-post',[ProfileController::class,'change_info_post']);
Route::post('/add-address-post',[ProfileController::class,'add_address_post']);
Route::get('/edit-address/{id}',[ProfileController::class,'edit_address']);
Route::post('/edit-address-post',[ProfileController::class,'edit_address_post']);
Route::get('/change-default-address/{id}/{status}',[ProfileController::class,'change_default_address']);
Route::get('/delete-profile-address/{id}',[ProfileController::class,'delete_profile_address']);
Route::get('/my-purchase-status/repurchase/{id}',[ProfileController::class,'repurchase']);


// Load Ajax profile
Route::get('/profile-info',[ProfileController::class,'profile_info']);
Route::get('/profile-address',[ProfileController::class,'profile_address']);
Route::get('/profile-password',[ProfileController::class,'profile_password']);
Route::post('/form-change-password-post',[ProfileController::class,'form_change_password_post']);
Route::get('/profile-my-purchase',[ProfileController::class,'profile_my_purchase']);
Route::get('/my-purchase-status/{status}',[ProfileController::class,'my_purchase_status']);
Route::get('/product-detail/{id}',[ProfileController::class,'product_detail']);
Route::get('/confirm-order/{id}',[ProfileController::class,'confirm_order'])->whereNumber('id');
Route::post('/search-my-purchase',[ProfileController::class,'search_my_purchase']);


















