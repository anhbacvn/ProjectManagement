<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class CategoryProduct extends Controller
{
    public function AuthLogin() {
        $admin_id  = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product() {
        $this->AuthLogin();
        return view('admin.category_product.add_category_product');
    }

    public function all_category_product() {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.category_product.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.category_product.all_category_product',$manager_category_product);
    }


    public function save_category_product(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    public function change_category_status($category_id) {
        $this->AuthLogin();
        $get_category_id = DB::table('tbl_category_product')->where('category_id',$category_id)->first();
        if($get_category_id && $get_category_id->category_status == 1) {
            DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=> 0]);
            return Redirect::to('all-category-product');
        }
        else {
            DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status'=> 1]);
            return Redirect::to('all-category-product');
        }
    }

    public function edit_category_product($category_id) {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_id)->first();
        return view('admin.category_product.edit_category_product')->with('category_product',$edit_category_product);
    }

    public function update_category_product(Request $request, $category_id) {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_id)->first();
        $data = array(
            'category_name' => $request->category_product_name,
            'category_desc' => $request ->category_product_desc
        );
        $update_data = DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
        if($update_data){
            Session::put('message','Sửa danh mục sản phẩm thành công');
            return Redirect::to('all-category-product')->with('category_product',$edit_category_product);
        }
        Session::put('message','Sửa danh mục sản phẩm thất bại');
        return Redirect::to('all-category-product')->with('category_product',$edit_category_product);
    }

    public function delete_category_product($category_id) {
        $this->AuthLogin();
        $get_category_id = DB::table('tbl_category_product')->where('category_id',$category_id)->first();
        if($get_category_id) {
            DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
            return Redirect::to('all-category-product');
        }
        else {
            DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
            return Redirect::to('all-category-product');
        }
    }

    // End Function Admin Page

    // Home Category
    public Function show_category_home($category_id) {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_product_status','1')->orderby('brand_product_id','desc')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
