<?php

namespace App\Http\Controllers;

use App\Models\getavatar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
session_start();

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function AuthLogin()
    {
        $user = Session::get('get_user');
        if (!$user) {
            return Redirect::to('/user-login')->send();
        }
    }

    public function index()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status', '1')->orderby('brand_product_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->limit(6)->get();

        $get_user = Session::get('get_user');

        $count = -1;
        if ($get_user) {
            $count = DB::table('tbl_cart')->where('user_id', $get_user->id)->count();

            Session::put('qty_cart', $count);
        }
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    public function user_login()
    {
        $get_user = Session::get('get_user');
        if ($get_user) {
            return Redirect::to('/');
        }
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_product_id', 'desc')->get();

        return view('pages.login')->with('category', $cate_product)->with('brand', $brand_product);
    }

    // Forget password
    public function forget_password($email)
    {
        $get_email = DB::table('users')->where('email', $email)->first();
        if (!$get_email) {
            return response()->json(['status' => 403, 'msg' => 'Email n??y ch??a ????ng k??']);
        }

        $newpassword = $this->randomString(10);

        $encrypt_password = Hash::make($newpassword);

        $update_password = DB::table('users')->where('email', $email)->update(['password' => $encrypt_password]);
        if ($update_password) {

            $data = [
                'password' => $newpassword,
                'email' => $email,
                'name' => $get_email->name,
            ];

            Mail::send('pages.send_mail', $data, function ($message) use ($data) {
                $message->from('nvhshopee@gmail.com', 'NVH Shopee');
                $message->to($data['email'], $data['name']);
                $message->subject('L???y l???i m???t kh???u');
            });
            $new_user = DB::table('users')->where('email', $email)->first();
            Session::put('get_user', $new_user);
            return response()->json(['status' => 200, 'msg' => '??a?? g????i tha??nh c??ng, vui lo??ng ki????m tra email']);
        }
        return response()->json(['status' => 403, 'msg' => 'G???i th???t b???i,vui l??ng ki???m tra l???i email']);
    }

    // Login customer
    public function login_post(Request $request)
    {
        $get_user = DB::table('users')->where('email', $request->email)->orWhere('user_login', $request->email)->first();

        if (!$get_user) {
            return response()->json(['status' => 403, 'msg' => 'Email na??y kh??ng t????n ta??i']);
        }

        if (!Hash::check($request->password, $get_user->password)) {
            return response()->json(['status' => 403, 'msg' => 'M????t kh????u kh??ng chi??nh xa??c']);
        }

        if (($get_user->status != 0) && ($get_user->status != 1)) {
            return response()->json(['status' => 403, 'msg' => 'T??i kho???n c???a b???n ???? b??? kho??']);
        }

        if (Auth::attempt($request->only('user_login', 'password')) || Auth::attempt($request->only('email', 'password'))) {
            Session::put('get_user', $get_user);
            return response()->json(['status' => 200, 'msg' => '????ng nh????p tha??nh c??ng']);
        }
        return response()->json(['status' => 403, 'msg' => '????ng nh????p th????t ba??i']);
    }


    public function user_logout()
    {
        $this->AuthLogin();
        Session::put('get_user', null);
        Session::put('qty_cart', null);
        return Redirect::to('/user-login');
    }

    // Register
    public function user_register()
    {
        $get_user = Session::get('get_user');
        if ($get_user) {
            return Redirect::to('/');
        }
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_product_id', 'desc')->get();

        return view('pages.register')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function register_post(Request $request)
    {
        $user_data = $request->input();
        $validator = Validator::make($user_data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'reenter'  => 'required_with:password|same:password',
        ], [
            'name.required' => 'Vui lo??ng nh????p t??n',
            'email.required' => 'Vui lo??ng nh????p email',
            'email.email' => 'Email sai ??i??nh da??ng',
            'password.required' => 'Vui lo??ng nh????p m????t kh????u',
            'password.min' => 'M????t kh????u t????i thi????u la?? 6 ky?? t????',
            'reenter.required_with' => 'Vui lo??ng xa??c nh????n m????t kh????u',
            'reenter.same' => 'Xa??c nh????n m????t kh????u ch??a chi??nh xa??c',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()->first()]);
        }

        $get_user = DB::table('users')->where('email', $request->email)->first();

        if ($get_user) {
            return response()->json(['status' => 403, 'msg' => 'Email ????ng ky?? ??a?? t????n ta??i']);
        }
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_login' => $this->randomString(10)
        );

        $result = DB::table('users')->insertGetId($data);
        $get_new_user = DB::table('users')->where('id', $result)->first();
        if ($result) {
            Session::put('get_user', $get_new_user);
            return response()->json(['status' => 200, 'msg' => '????ng ky?? ta??i khoa??n tha??nh c??ng']);
        } else {
            return response()->json(['status' => 403, 'msg' => '????ng ky?? ta??i khoa??n th????t ba??i']);
        }
    }

    // T??m ki???m s???n ph???m
    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status', '1')->orderby('brand_product_id', 'desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }

    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
