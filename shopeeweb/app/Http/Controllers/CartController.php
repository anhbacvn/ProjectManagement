<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AuthLogin()
    {
        $user = Session::get('get_user');
        if (!$user) {
            return Redirect::to('/user-login')->send();
        }
    }

    public function save_cart(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status', '1')->orderby('brand_product_id', 'desc')->get();

        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $data =  DB::table('tbl_product')->where('product_id', $productId)->get();

        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_cart_ajax($id, $qty)
    {
        $user = Session::get('get_user');
        $this->AuthLogin();
        $get_product_by_id = DB::table('tbl_product')->where('product_id', $id)->first();

        if ($get_product_by_id) {
            $check_cart = DB::table('tbl_cart')->where('product_id', $id)->where('user_id', $user->id)->first();
            if ($check_cart) {
                $new_quatity = $check_cart->quatity + $qty;
                $update = DB::table('tbl_cart')->where('product_id', $id)->where('user_id', $user->id)->update(['quatity' => $new_quatity, 'cart_price' => $get_product_by_id->product_price * $new_quatity]);
                if ($update) {
                    return response()->json(['status' => 200, 'msg' => 'Thêm thành công']);
                }
                return response()->json(['status' => 403, 'msg' => 'Thêm thất bại']);
            } else {
                $data_cart = array(
                    'product_id' => $get_product_by_id->product_id,
                    'user_id'  =>  $user->id,
                    'quatity'  => $qty,
                    'cart_price' => $get_product_by_id->product_price * $qty
                );
                $insert_cart = DB::table('tbl_cart')->where('user_id', $user->id)->insert($data_cart);

                if ($insert_cart) {
                    $count = DB::table('tbl_cart')->where('user_id', $user->id)->count();

                    Session::put('qty_cart', $count);
                    return response()->json(['status' => 200, 'msg' => 'Thêm thành công','qty_cart' => $count]);
                }
                return response()->json(['status' => 403, 'msg' => 'Thêm thất bại']);
            }
        }

        return response()->json(['status' => 402, 'msg' => 'Sản phẩm không tồn tại']);
    }

    public function show_cart()
    {
        $user = Session::get('get_user');
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status', '1')->orderby('brand_product_id', 'desc')->get();

        $data_cart_by_user =  DB::table('tbl_cart')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart.product_id')
            ->where('user_id', $user->id)->get();
        if (count($data_cart_by_user) > 0) {
            $total_cart = DB::table('tbl_cart')->where('user_id', $user->id)->sum('cart_price');

            return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)->with('data_cart', $data_cart_by_user)->with('total_cart', $total_cart);
        }
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)->with('data_cart', null)->with('total_cart', null);
    }

    public function change_quantity($id, $qty)
    {
        $user = Session::get('get_user');
        $get_cart_by_id = DB::table('tbl_cart')->where('cart_id', $id)->where('user_id', $user->id)
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart.product_id')
            ->first();

        if ($get_cart_by_id) {
            $data = array(
                'quatity' => $qty,
                'cart_price' => $get_cart_by_id->product_price * $qty,
            );
            $update = DB::table('tbl_cart')->where('cart_id', $id)->where('user_id', $user->id)->update($data);
            $new_update = DB::table('tbl_cart')->where('cart_id', $id)->where('user_id', $user->id)->first();
            $total_cart = DB::table('tbl_cart')->where('user_id', $user->id)->sum('cart_price');
            return response()->json(['status' => 200, 'qty' => $new_update->quatity, 'cart_price' => $new_update->cart_price, 'total' => $total_cart]);
        }

        return response()->json(['status' => 402, 'msg' => 'Thay đổi thất bại']);
    }

    public function delete_cart_product($id)
    {
        $user = Session::get('get_user');


        $delete_cart_by_id  = DB::table('tbl_cart')->where('cart_id', $id)->where('user_id', $user->id)->delete();
        if ($delete_cart_by_id) {
            $get_cart_by_id = DB::table('tbl_cart')->where('user_id', $user->id)->count();
            $total_cart = DB::table('tbl_cart')->where('user_id', $user->id)->sum('cart_price');
            $count_qty = DB::table('tbl_cart')->where('user_id', $user->id)->count();

            Session::put('qty_cart', $count_qty);
            if ($get_cart_by_id > 0) {
               
                return response()->json(['status' => 200, 'msg' => 'Xoá sản phẩm thành công', 'total' => $total_cart, 'count' => 1,'qty_cart' => $count_qty]);
            }
            return response()->json(['status' => 200, 'msg' => 'Xoá sản phẩm thành công', 'total' => $total_cart, 'count' => 0,'qty_cart' => $count_qty]);
        }
        return response()->json(['status' => 403, 'msg' => 'Xoá sản phẩm thất bại']);
    }
}
