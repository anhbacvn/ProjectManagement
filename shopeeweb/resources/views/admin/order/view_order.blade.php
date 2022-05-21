@extends('admin_layout')
@section('admin_content')

<style>
    body {
        margin: 0;
        font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: .8125rem;
        font-weight: 400;
        line-height: 1.5385;
        color: #333;
        text-align: left;
        background-color: #eee
    }

    /* .mt-50 {
        margin-top: 50px
    }

    .mb-50 {
        margin-bottom: 50px
    } */

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .1875rem
    }

    .card-img-actions {
        position: relative
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .card-title {
        margin-top: 10px;
        font-size: 17px
    }

    .invoice-color {
        color: red !important
    }

    .card-header {
        padding: .9375rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .02);
        border-bottom: 1px solid rgba(0, 0, 0, .125)
    }

    a {
        text-decoration: none !important
    }

    .btn-light {
        color: #333;
        background-color: #fafafa;
        border-color: #ddd
    }

    .header-elements-inline {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap
    }

    @media (min-width: 768px) {
        .wmin-md-400 {
            min-width: 400px !important
        }
    }

    .btn-primary {
        color: #fff;
        background-color: #2196f3
    }

    .btn-labeled>b {
        position: absolute;
        top: -1px;
        background-color: blue;
        display: block;
        line-height: 1;
        padding: .62503rem
    }
</style>

<div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    </div>
                    <div class="d-md-flex flex-md-wrap">
                        <div class="mb-4 mb-md-2 text-left"> <span class="text-muted" style="font-size:1.2rem;">Thông tin khách hàng</span>
                            <ul class="list list-unstyled mb-0" style="font-size:0.9rem;">
                                <li>Tên khách hàng: {{$get_info_order->name}}</li>
                                <li>Email khách hàng: {{$get_info_order->email}}</li>
                            </ul>
                        </div>
                        <div class="mb-4 mb-md-2 ml-auto"> <span class="text-muted" style="font-size:1.2rem;">Thông tin vận chuyển</span>
                            <ul class="list list-unstyled mb-0" style="font-size:0.9rem;">
                                <li>Tên người vận chuyển: {{$get_info_order->address_shipping_name}}</li>
                                <li>Số điện thoại: {{$get_info_order->address_shipping_phone}}</li>
                                <li>Địa chỉ: {{$get_info_order->address_shipping_detail}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead style="text-align:center;">
                            <tr style="font-size:1.0rem;">
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                            @foreach($order_detail_by_id as $item)
                            <tr style="font-size:0.8rem;">
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->order_detail_quantity}}</td>
                                <td>{{number_format($item->product_price)}}<sup>đ</sup></td>
                                <td><span class="font-weight-semibold">{{number_format($item->order_detail_price)}}<sup>đ</sup></span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="d-md-flex flex-md-wrap">
                        <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                            <h6 class="mb-3 text-left" style="margin-left: 12px;">Thông tin thanh toán</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="text-left">Tổng tiền:</th>
                                            <td class="text-right">{{number_format($get_info_order->order_total)}}<sup>đ</sup></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Phương thức thanh toán:</th>
                                            <td class="text-right">{{($get_info_order->payment_type)}}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Tiền ship: <span class="font-weight-normal"></span></th>
                                            <td class="text-right">Free</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Tổng cộng:</th>
                                            <td class="text-right text-primary">
                                                <h5 class="font-weight-semibold">{{number_format($get_info_order->order_total)}}<sup>đ</sup></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection