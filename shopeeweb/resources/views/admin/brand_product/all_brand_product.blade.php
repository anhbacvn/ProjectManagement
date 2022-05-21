@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên thương hiệu</th>
            <th>Hiển thị</th>
            <th>Ngày thêm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand_product as $key => $cate_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cate_pro->brand_product_name}}</td>
            <td><span class="text-ellipsis">
              @if($cate_pro->brand_product_status == 1)
                 <b><a style="color:green;" href="{{URL::to('/change-brand-status/'.$cate_pro->brand_product_id)}}">Hiển thị</a></b>
              @else
                 <b><a style="color:red;" href="{{URL::to('/change-brand-status/'.$cate_pro->brand_product_id)}}">Ẩn</a></b>
              @endif
            </span></td>
            <td><span class="text-ellipsis">
              {{date('H:i:s d-m-Y',strtotime($cate_pro->created_at))}}
            </span></td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$cate_pro->brand_product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
                <span class="tooltiptext">Edit</span>
              </a>
              <a onclick="return confirm('Bạn chắc chắn muốn xoá thương hiệu này?')" href="{{URL::to('/delete-brand-product/'.$cate_pro->brand_product_id)}}" class="active styling-edit" ui-toggle-class="">  
                <i class="fa fa-times text-danger text"></i>
                <span class="tooltiptext">Delete</span>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
    </div>
</div>
@endsection