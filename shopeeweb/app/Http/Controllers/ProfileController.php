<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController as Cart;

class ProfileController extends Controller
{
    public function AuthLogin()
    {
        $user = Session::get('get_user');
        if (!$user) {
            return Redirect::to('/user-login')->send();
        }
    }

    public function profile()
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();
        Session::put('get_info_user',$get_info_user);
        return view('pages.profile')->with('get_info_user', $get_info_user);
    }

    // Load ajax profile info
    public function profile_info()
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();

        return view('pages.profile.profile_info')->with('get_info_user', $get_info_user);
    }

    // Load ajax profile address
    public function profile_address()
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();

        $get_address_user = DB::table('tbl_address_shipping')->where('user_id', $user->id)->orderByDesc('tbl_address_shipping.address_shipping_status')->get();
        if (count($get_address_user) > 0) {
            Session::put('get_address_user', $get_address_user);
        } else {
            Session::put('get_address_user', null);
        }
        return view('pages.profile.profile_address')->with('get_info_user', $get_info_user);
    }

    // Load ajax đổi mật khẩu
    public function profile_password()
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();

        return view('pages.profile.profile_password')->with('get_info_user', $get_info_user);
    }

    // Thay đổi mật khẩu
    public function form_change_password_post(Request $request)
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $user_data = $request->input();
        $validator = Validator::make($user_data, [
            'password' => 'required',
            'newPassword' => 'required|min:6',
            'newPasswordRepeat' => 'required_with:newPassword|same:newPassword',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'newPassword.required' => 'Vui lòng nhập mật khẩu mới',
            'newPassword.min' => 'Mặt khẩu tối thiểu là 6 ký tự',
            'newPasswordRepeat.required_with' => 'Vui lòng xác nhận mặt khẩu',
            'newPasswordRepeat.same' => 'Xác nhận mặt khẩu chưa chính xác',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()->first()]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 403, 'msg' => 'Mặt khẩu hiện tại không chính xác']);
        }

        $update_newpassword = array(
            'password' => Hash::make($request->newPassword),
        );
        $user_new_password = DB::table('users')->where('id', $user->id)->update($update_newpassword);

        if ($user_new_password) {
            return response()->json(['status' => 200, 'msg' => 'Thay đổi mật khẩu thành công.Vui lòng đăng nhập lại!']);
        }
        return response()->json(['status' => 403, 'msg' => 'Thay đổi mật khẩu thất bại']);
    }

    // Load ajax đơn mua
    public function profile_my_purchase()
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();

        if ($get_info_user) {
            $data_all_order = array();

            $all_order = DB::table('tbl_order')->where('user_id', $user->id)->orderby('order_id', 'desc')->get();
            if ($all_order) {

                foreach ($all_order as $item) {
                    $all_order_detail = DB::table('tbl_order_detail')
                        ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
                        ->where('order_id', $item->order_id)->get();

                    array_push($data_all_order, array(
                        'total' => $item->order_total,
                        'detail' => $all_order_detail,
                        'order_id' => $item->order_id,
                    ));
                }
            }
            Session::put('data_all_order', $data_all_order);

            return view('pages.profile.profile_my_purchase')->with('get_info_user', $get_info_user);
        }
    }

    // Load purchase ứng với status
    public function my_purchase_status($status)
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();
        $order_status = array(
            '0' => "Chờ xác nhận",
            '1' => "Chờ lấy hàng",
            '2' => "Đang giao",
            '3' => "Đã giao",
            '4' => "Đã huỷ",
        );
        Session::put('order_status', $order_status);
        if ($get_info_user) {
            $data_all_order = array();
            if ($status == '-1') {
                $all_order = DB::table('tbl_order')->where('user_id', $user->id)->orderby('order_id', 'desc')->get();
            } else {
                $all_order = DB::table('tbl_order')->where('user_id', $user->id)->where('order_status', $status)->orderby('order_id', 'desc')->get();
            }
            if ($all_order) {
                foreach ($all_order as $item) {
                    $all_order_detail = DB::table('tbl_order_detail')
                        ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
                        ->where('order_id', $item->order_id)->get();

                    array_push($data_all_order, array(
                        'total' => $item->order_total,
                        'detail' => $all_order_detail,
                        'order_id' => $item->order_id,
                        'order_status' => $item->order_status,
                    ));
                }
            }
            Session::put('data_all_order', $data_all_order);

            return view('pages.profile.my_purchase_status')->with('get_info_user', $get_info_user);
        }
    }


    // Thêm vào giỏ cart ứng với order_id 
    public function repurchase($id)
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $cart = new Cart();
        $get_order = DB::table('tbl_order_detail')->where('order_id', $id)->get();
        foreach ($get_order as $item) {
            $cart->add_cart_ajax($item->product_id, $item->order_detail_quantity);
        }
        return response()->json(['status' => 200]);
    }


    // Xem chi tiết đơn hàng ứng với order_id
    public function product_detail($id)
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_info_user = DB::table('users')->where('id', $user->id)->first();

        $get_order = DB::table('tbl_order')
            ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_order.payment_id')
            ->where('order_id', $id)->where('user_id', $user->id)->first();
        Session::put('get_order', $get_order);

        $get_address = DB::table('tbl_order')
            ->join('tbl_address_shipping', 'tbl_address_shipping.address_shipping_id', '=', 'tbl_order.address_shipping_id')
            ->where('order_id', $id)->first();

        $get_order_detail_product = DB::table('tbl_order_detail')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
            ->where('order_id', $id)->get();

        $get_order_status_detail = DB::table('tbl_order_status_detail')->where('order_id', $id)->orderByDesc('order_status_id')->get();
        return view('pages.profile.product_detail')->with('get_info_user', $get_info_user)->with('get_order_detail_product', $get_order_detail_product)->with('get_address', $get_address)->with('get_order_status_detail', $get_order_status_detail);
    }

    public function confirm_order($id)
    {
        $this->AuthLogin();
        $user = Session::get('get_user');
        $get_order_status = DB::table('tbl_order')->where('order_id', $id)->where('user_id', $user->id)->first();
        if ($get_order_status) {
            $update_order_status = DB::table('tbl_order')->where('order_id', $id)->where('user_id', $user->id)->update(['order_status' => 3]);
            if ($update_order_status)
                return response()->json(['status' => 200, 'msg' => 'Cập nhật thành công', 'id' => $id]);
            return response()->json(['status' => 403, 'msg' => 'Cập nhật thất bại']);
        }
        return response()->json(['status' => 403, 'msg' => 'Đơn hàng không tồn tại']);
    }

    public function change_info_post(Request $request)
    {
        $user = Session::get('get_user');
        $user_data = $request->input();
        $validator = Validator::make($user_data, [
            'user_login' => 'required',
            'user_email' => 'required|email',
            'user_name' => 'required',
        ], [
            'user_login.required' => 'Vui lòng nhập tên đăng nhập',
            'user_email.required' => 'Vui lòng nhập email',
            'user_email.email' => 'Email sai định dạng',
            'user_name.required' => 'Vui lòng nhập họ tên',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()->first()]);
        }


        $check_email = DB::table('users')->where('id', '!=', $user->id)->where('email', $request->user_email)->first();

        $check_user_login = DB::table('users')->where('id', '!=', $user->id)->where('user_login', $request->user_login)->first();

        if ($check_email) {
            return response()->json(['status' => 403, 'msg' => 'Email đăng ký đã tồn tại']);
        }

        if ($check_user_login) {
            return response()->json(['status' => 403, 'msg' => 'Tên đăng nhập đã tồn tại']);
        }

        if ($request->file('user_image')) {

            $file = $request->file('user_image');

            $file_name = time() . '_' . $file->getClientOriginalName();
            $data = array(
                'user_login' => $request->user_login,
                'email' => $request->user_email,
                'name' => $request->user_name,
                'birthday' => $request->user_birthday,
                'gender' => $request->gender,
                'phone'  => $request->user_phone,
                'avatar' => $file_name,
            );
            $result = DB::table('users')->where('id', $user->id)->update($data);
            if ($result) {
                move_uploaded_file($file, 'public/upload/image_user/' . $file_name);
                return response()->json(['status' => 200, 'msg' => 'Thay đổi thông tin thành công']);
            }
        } else {
            $data = array(
                'user_login' => $request->user_login,
                'email' => $request->user_email,
                'name' => $request->user_name,
                'birthday' => $request->user_birthday,
                'phone'  => $request->user_phone,
                'gender' => $request->gender,
            );

            $result = DB::table('users')->where('id', $user->id)->update($data);
            if ($result) {
                return response()->json(['status' => 200, 'msg' => 'Thay đổi thông tin thành công']);
            }
        }
        return response()->json(['status' => 403, 'msg' => 'Thay đổi thông tin thất bại']);
    }

    public function add_address_post(Request $request)
    {
        $user = Session::get('get_user');
        $user_data = $request->input();
        $validator = Validator::make($user_data, [
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address_detail' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập đầy đủ họ tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'city.required' => 'Vui lòng chọn thành phố',
            'district.required' => 'Vui lòng chọn quận/huyện',
            'ward.required' => 'Vui lòng chọn phường/xã',
            'address_detail.required' => 'Vui lòng nhập địa chỉ cụ thể',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()->first()]);
        }

        if ($request->status == 1) {
            DB::table('tbl_address_shipping')->where('user_id', $user->id)->update(['address_shipping_status' => 0]);
        }

        $data_address = array(
            'address_shipping_country' => 'Việt Nam',
            'address_shipping_city' => $request->city,
            'address_shipping_district' => $request->district,
            'address_shipping_wards' => $request->ward,
            'address_shipping_detail' => $request->address_detail,
            'address_shipping_name' => $request->name,
            'address_shipping_phone' => $request->phone,
            'address_shipping_status' => $request->status,
            'user_id' => $user->id,
        );

        $user_address = DB::table('tbl_address_shipping')->insert($data_address);

        if ($user_address) {
            return response()->json(['status' => 200, 'msg' => 'Thêm thành công']);
        }
        return response()->json(['status' => 403, 'msg' => 'Thêm thất bại']);
    }

    public function edit_address($id)
    {
        $user = Session::get('get_user');

        $get_address_by_id = DB::table('tbl_address_shipping')->where('address_shipping_id', $id)->where('user_id', $user->id)->first();
        if ($get_address_by_id) {
            return response()->json(['status' => 200, 'data' => $get_address_by_id]);
        }
        return response()->json(['status' => 403, 'msg' => 'Thêm thất bại']);
    }

    public function edit_address_post(Request $request)
    {
        $user = Session::get('get_user');
        $user_data = $request->input();
        $validator = Validator::make($user_data, [
            'edit_name' => 'required',
            'edit_phone' => 'required',
            'edit_city' => 'required',
            'edit_district' => 'required',
            'edit_ward' => 'required',
            'edit_address_detail' => 'required',
        ], [
            'edit_name.required' => 'Vui lòng nhập đầy đủ họ tên',
            'edit_phone.required' => 'Vui lòng nhập số điện thoại',
            'edit_city.required' => 'Vui lòng chọn thành phố',
            'edit_district.required' => 'Vui lòng chọn quận/huyện',
            'edit_ward.required' => 'Vui lòng chọn phường/xã',
            'edit_address_detail.required' => 'Vui lòng nhập địa chỉ cụ thể',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()->first()]);
        }

        if ($request->edit_status == 1) {
            DB::table('tbl_address_shipping')->where('user_id', $user->id)->update(['address_shipping_status' => 0]);
        }

        $edit_data_address = array(
            'address_shipping_country' => 'Việt Nam',
            'address_shipping_city' => $request->edit_city,
            'address_shipping_district' => $request->edit_district,
            'address_shipping_wards' => $request->edit_ward,
            'address_shipping_detail' => $request->edit_address_detail,
            'address_shipping_name' => $request->edit_name,
            'address_shipping_phone' => $request->edit_phone,
            'address_shipping_status' => $request->edit_status,
            'user_id' => $user->id,
        );

        $user_new_address = DB::table('tbl_address_shipping')->where('user_id', $user->id)->where('address_shipping_id', $request->edit_id)->update($edit_data_address);

        if ($user_new_address) {
            return response()->json(['status' => 200, 'msg' => 'Sửa thành công']);
        }
        return response()->json(['status' => 403, 'msg' => 'Sửa thất bại']);
    }

    public function change_default_address($id, $status)
    {
        $user = Session::get('get_user');

        if ($status == 1) {
            DB::table('tbl_address_shipping')->where('user_id', $user->id)->update(['address_shipping_status' => 0]);
            DB::table('tbl_address_shipping')->where('user_id', $user->id)->where('address_shipping_id', $id)->update(['address_shipping_status' => 1]);
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 403, 'msg' => 'Thay đổi thật bại']);
    }

    public function delete_profile_address($id)
    {
        $user = Session::get('get_user');
        $delete_address_by_id  = DB::table('tbl_address_shipping')->where('address_shipping_id', $id)->where('user_id', $user->id)->delete();
        if ($delete_address_by_id) {
            return response()->json(['status' => 200, 'msg' => 'Xoá địa chỉ thành công']);
        }
        return response()->json(['status' => 403, 'msg' => 'Xoá địa chỉ thất bại']);
    }

    public function search_my_purchase(Request $request){

        $this->AuthLogin();
        $user = Session::get('get_user');
        $keywords = $request->keywords_mypurchase_submit;

        $search_my_purchase = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->join('tbl_order','tbl_product.order_id','=','tbl_order_detail.order_id')
        ->where('product_name', 'like', '%' . $keywords . '%')->where('user_id',$user->id)->get();

        // if(){
        //     return response()->json(['status' => 200]);
        // }
        // return response()->json(['status' => 403, 'msg' => 'Không tìm thấy sản phẩm mà bạn yêu cầu!' ]);
    }
}
