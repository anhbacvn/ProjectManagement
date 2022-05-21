@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            <th>Tên người đặt</th>
            <th>Tổng giá tiền</th>
            <th>Tình trạng</th>
            <th>Hiển thị</th>
            <th>Ngày thêm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $key => $order)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$order->name}}</td>
            <td>{{number_format($order->order_total)}}<sup>đ</sup></td>
            <td><span class="text-ellipsis">
                @if($order->order_status == 0)
                <b><a style="color:#333;" href="{{URL::to('/change-order-status/'.$order->order_id)}}">Chờ xác nhận</a></b>
                @elseif($order->order_status == 1)
                <b><a style="color:blue;" href="{{URL::to('/change-order-status/'.$order->order_id)}}">Chờ lấy hàng</a></b>
                @elseif($order->order_status == 2)
                <b><a style="color:green;" href="{{URL::to('/change-order-status/'.$order->order_id)}}">Đang giao</a></b>
                @elseif($order->order_status == 3)
                <b><a style="color:#FE980F;" href="{{URL::to('/change-order-status/'.$order->order_id)}}">Đã giao</a></b>
                @else
                <b><a style="color:red;" href="{{URL::to('/change-order-status/'.$order->order_id)}}">Đã huỷ</a></b>
                @endif
              </span></td>
            <td>
              <span class="text-ellipsis">
                {{date('H:i:s d-m-Y',strtotime($order->created_at))}}
              </span>
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
                <span class="tooltiptext">Edit</span>
              </a>
              <a onclick="return confirm('Bạn chắc chắn muốn xoá đơn hàng này?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
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