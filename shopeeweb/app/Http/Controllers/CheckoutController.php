<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

session_start();

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Kiểm tra admin đăng nhập
    public function AuthLogin_admin()
    {
        $admin_id  = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    // Kiểm tra khách hàng đăng nhập
    public function AuthLogin()
    {
        $user = Session::get('get_user');
        if (!$user) {
            return Redirect::to('/user-login')->send();
        }
    }

    public function show_checkout()
    {
        $user = Session::get('get_user');
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status', '1')->orderby('brand_product_id', 'desc')->get();

        $data_cart_by_user =  DB::table('tbl_cart')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart.product_id')
            ->where('user_id', $user->id)->get();
        Session::put('data_cart_by_user', $data_cart_by_user);

        $total_cart = DB::table('tbl_cart')->where('user_id', $user->id)->sum('cart_price');

        $check_address_shipping = DB::table('tbl_address_shipping')->where('user_id', $user->id)->count();

        if ($check_address_shipping > 0) {
            $all_cart_by_user = DB::table('tbl_address_shipping')->where('user_id', $user->id)->where('address_shipping_status','1')->get();
            Session::put('all_cart_by_user', $all_cart_by_user);
            return view('pages.checkout.show_checkout')->with('address_by_user', $check_address_shipping)->with('category', $cate_product)->with('brand', $brand_product)->with('data_cart', $data_cart_by_user)->with('total_cart', $total_cart);
        } else {
            return view('pages.checkout.show_checkout')->with('address_by_user', null)->with('category', $cate_product)->with('brand', $brand_product)->with('data_cart', $data_cart_by_user)->with('total_cart', $total_cart);
        }
    }

    public function save_checkout_customer(Request $request)
    {
        $user = Session::get('get_user');
        $user_data = $request->input();
        $validator = Validator::make($user_data, [
            'shipping_name' => 'required',
            'shipping_phone' => 'required',
            'shipping_country' => 'required',
            'shipping_city' => 'required',
            'shipping_district' => 'required',
            'shipping_wards' => 'required',
            'shipping_address_detail' => 'required',
        ], [
            'shipping_name.required' => 'Vui lòng nhập tên',
            'shipping_phone.required' => 'Vui lòng nhập số điện thoại',
            'shipping_country.required' => 'Vui lòng nhập quốc gia',
            'shipping_city.required' => 'Vui lòng nhập thành phố đang sống',
            'shipping_district.required' => 'Vui lòng nhập quận đang sống',
            'shipping_wards.required' => 'Vui lòng nhập phường/xã đang sống',
            'shipping_address_detail.required' => 'Vui lòng nhập địa chỉ cụ thể',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()->first()]);
        }

        $data = array(
            'address_shipping_country' => $request->shipping_country,
            'address_shipping_city' => $request->shipping_city,
            'address_shipping_district' => $request->shipping_district,
            'address_shipping_wards' => $request->shipping_wards,
            'address_shipping_detail' => $request->shipping_address_detail,
            'address_shipping_name' => $request->shipping_name,
            'address_shipping_phone' => $request->shipping_phone,
            'address_shipping_status' => 0,
            'user_id' => $user->id,
        );

        $address_shipping_id = DB::table('tbl_address_shipping')->insertGetId($data);

        return response()->json(['status' => 200, 'msg' => 'Thêm thành công', 'address_shipping_id' => $address_shipping_id]);
    }

    public function payment($id)
    {
        $user = Session::get('get_user');

        $data_cart_by_user =  DB::table('tbl_cart')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart.product_id')
            ->where('user_id', $user->id)->get();

        $total_cart = DB::table('tbl_cart')->where('user_id', $user->id)->sum('cart_price');

        $get_payment_method = DB::table('tbl_payment')->get();

        return view('pages.checkout.payment')->with('id_address', $id)->with('data_cart', $data_cart_by_user)->with('total_cart', $total_cart)->with('get_payment_method', $get_payment_method);
    }

    public function order_place(Request $request)
    {
        $user = Session::get('get_user');

        $total_cart = DB::table('tbl_cart')->where('user_id', $user->id)->sum('cart_price');
        // Insert order
        $order_data = array();
        $order_data['user_id'] = $user->id;
        $order_data['address_shipping_id'] = $request->id_address;
        $order_data['payment_id'] = $request->payment_method;
        $order_data['order_total'] = $total_cart;
        $order_data['order_status'] = 0;

        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        if ($order_id) {
            $data_cart = DB::table('tbl_cart')->where('user_id', $user->id)->get();

            if (count($data_cart) > 0) {
                $order_detail_data = array();
                foreach ($data_cart as $item) {
                    $order_detail_data['order_id'] = $order_id;
                    $order_detail_data['product_id'] = $item->product_id;
                    $order_detail_data['order_detail_quantity'] = $item->quatity;
                    $order_detail_data['order_detail_price'] = $item->cart_price;
                    DB::table('tbl_order_detail')->insert($order_detail_data);
                }

                DB::table('tbl_cart')->where('user_id', $user->id)->delete();
                $new_order = DB::table('tbl_order_detail')
                    ->select('tbl_order_detail.created_at', 'tbl_order_detail.order_detail_quantity', 'tbl_order_detail.order_detail_price', 'tbl_product.product_name')
                    ->join('tbl_product', 'tbl_order_detail.product_id', '=', 'tbl_product.product_id')
                    ->where('order_id', $order_id)->get();
                return view('pages.checkout.payment_success')->with('new_order', $new_order)->with('order_id', $order_id);
            }
        }
    }

    // Admin quản lý đơn hàng
    public function manage_order()
    {
        $this->AuthLogin_admin();
        $all_order = DB::table('tbl_order')
            // Join hai hay nhiều bảng với nhau
            ->join('users', 'users.id', '=', 'tbl_order.user_id')
            ->select('tbl_order.*', 'users.name')
            ->orderby('tbl_order.order_id', 'desc')->get();

        $manager_order = view('admin.order.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('manage_order', $manager_order);
    }

    public function change_order_status($order_id)
    {
        $this->AuthLogin_admin();
        $get_order_id = DB::table('tbl_order')->where('order_id', $order_id)->first();
        if ($get_order_id && $get_order_id->order_status == 0) {
            DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 1]);
            return Redirect::to('/manage-order');
        } elseif ($get_order_id && $get_order_id->order_status == 1) {
            DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 2]);
            return Redirect::to('/manage-order');
        } elseif ($get_order_id && $get_order_id->order_status == 2) {
            DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 3]);
            return Redirect::to('/manage-order');
        } elseif ($get_order_id && $get_order_id->order_status == 3) {
            DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 4]);
            return Redirect::to('/manage-order');
        } else {
            DB::table('tbl_order')->where('order_id', $order_id)->update(['order_status' => 0]);
            return Redirect::to('/manage-order');
        }
    }

    public function view_order($order_id)
    {
        $this->AuthLogin_admin();
        $order_detail_by_id = DB::table('tbl_order_detail')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
            ->where('tbl_order_detail.order_id', $order_id)
            ->get();

        $get_info_order = DB::table('tbl_order')
            ->join('users', 'users.id', '=', 'tbl_order.user_id')
            ->join('tbl_address_shipping', 'tbl_address_shipping.address_shipping_id', '=', 'tbl_order.address_shipping_id')
            ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_order.payment_id')
            ->where('tbl_order.order_id', $order_id)
            ->first();

        return view('admin.order.view_order')->with('order_detail_by_id', $order_detail_by_id)->with('get_info_order', $get_info_order);
    }

    public function delete_order($order_id)
    {
        $this->AuthLogin_admin();
        $get_order_by_id = DB::table('tbl_order')->where('order_id', $order_id)->first();
        $get_order_detail_by_id =  DB::table('tbl_order_detail')->where('order_id', $order_id)->first();
        if ($get_order_detail_by_id) {
            DB::table('tbl_order_detail')->where('order_id', $order_id)->delete();
        }
        if ($get_order_by_id) {
            DB::table('tbl_order')->where('order_id', $order_id)->delete();
        }
        return Redirect::to('manage-order');
    }
}
