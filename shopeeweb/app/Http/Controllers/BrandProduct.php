<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class BrandProduct extends Controller
{
    public function AuthLogin() {
        $admin_id  = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product() {
        $this->AuthLogin();
        return view('admin.brand_product.add_brand_product');
    }

    public function all_brand_product() {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.brand_product.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.brand_product.all_brand_product',$manager_brand_product);
    }

    public function save_brand_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['brand_product_name'] = $request->brand_product_name;
        $data['brand_product_desc'] = $request->brand_product_desc;
        $data['brand_product_status'] = $request->brand_product_status;

        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }

    public function change_brand_status($brand_product_id) {
        $this->AuthLogin();
        $get_brand_id = DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->first();
        if($get_brand_id && $get_brand_id->brand_product_status == 1) {
            DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->update(['brand_product_status'=> 0]);
            return Redirect::to('all-brand-product');
        }
        else {
            DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->update(['brand_product_status'=> 1]);
            return Redirect::to('all-brand-product');
        }
    }

    public function edit_brand_product($brand_product_id) {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->first();
        return view('admin.brand_product.edit_brand_product')->with('brand_product',$edit_brand_product);
    }

    public function update_brand_product(Request $request, $brand_product_id) {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->first();
        $data = array(
            'brand_product_name' => $request->brand_product_name,
            'brand_product_desc' => $request->brand_product_desc
        );

        $update_data = DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->update($data);
        if($update_data){
            Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
            return Redirect::to('all-brand-product')->with('brand_product',$brand_product_id);
        }
        Session::put('message','Cập nhật thương hiệu sản phẩm thất bại');
        return Redirect::to('all-brand-product')->with('brand_product',$edit_brand_product);
    }

    public function delete_brand_product($brand_product_id) {
        $this->AuthLogin();
        $get_brand_id = DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->first();
        if($get_brand_id) {
            DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->delete();
            return Redirect::to('all-brand-product');
        }
        else {
            DB::table('tbl_brand_product')->where('brand_product_id',$brand_product_id)->delete();
            return Redirect::to('all-brand-product');
        }
    }

    //  End Function Admin Page

    // Home Brand
    public function show_brand_home($brand_product_id) {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status','1')->orderby('brand_product_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_product.brand_product_id', '=', 'tbl_brand_product.brand_product_id')->where('tbl_product.brand_product_id',$brand_product_id)->get();

        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_product_id',$brand_product_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
