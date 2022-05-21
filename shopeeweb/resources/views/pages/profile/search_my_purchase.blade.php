@extends('pages.profile.profile_my_purchase')
@section('my_purchase_status_content')
<?php

use Illuminate\Support\Facades\Session;

$data_all_order = Session::get('data_all_order');

if ($data_all_order) {
?>
    @foreach($data_all_order as $row)
    <div class="content_mypurchase-order">
        <ul class="mypurchase_product">
            @foreach($row['detail'] as $item)
            <li>
                <img class="product_image" src="{{URL::to('public/upload/product/'.$item->product_image)}}" alt="">
                <div class="info_product">
                    <h2>{{$item->product_name}}</h2>
                    <h4>Số lượng:{{$item->order_detail_quantity}}</h4>
                </div>
                <h3 class="price_product"><sup style="margin-right:5px;">đ</sup>{{number_format($item->order_detail_price),2,",","."}}</h3>
            </li>
            @endforeach
        </ul>
        <div>
            <div class="total">
                <h2 class="total-span">
                    <span class="_2FYYuf"><span class="PbUiaK">
                            <svg width="16" height="16" viewBox="0 0 253 263" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M126.5 0.389801C126.5 0.389801 82.61 27.8998 5.75 26.8598C5.08763 26.8507 4.43006 26.9733 3.81548 27.2205C3.20091 27.4677 2.64159 27.8346 2.17 28.2998C1.69998 28.7657 1.32713 29.3203 1.07307 29.9314C0.819019 30.5425 0.688805 31.198 0.689995 31.8598V106.97C0.687073 131.07 6.77532 154.78 18.3892 175.898C30.003 197.015 46.7657 214.855 67.12 227.76L118.47 260.28C120.872 261.802 123.657 262.61 126.5 262.61C129.343 262.61 132.128 261.802 134.53 260.28L185.88 227.73C206.234 214.825 222.997 196.985 234.611 175.868C246.225 154.75 252.313 131.04 252.31 106.94V31.8598C252.31 31.1973 252.178 30.5414 251.922 29.9303C251.667 29.3191 251.292 28.7649 250.82 28.2998C250.35 27.8358 249.792 27.4696 249.179 27.2225C248.566 26.9753 247.911 26.852 247.25 26.8598C170.39 27.8998 126.5 0.389801 126.5 0.389801Z" fill="#ee4d2d"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M207.7 149.66L119.61 107.03C116.386 105.472 113.914 102.697 112.736 99.3154C111.558 95.9342 111.772 92.2235 113.33 88.9998C114.888 85.7761 117.663 83.3034 121.044 82.1257C124.426 80.948 128.136 81.1617 131.36 82.7198L215.43 123.38C215.7 120.38 215.85 117.38 215.85 114.31V61.0298C215.848 60.5592 215.753 60.0936 215.57 59.6598C215.393 59.2232 215.128 58.8281 214.79 58.4998C214.457 58.1705 214.063 57.909 213.63 57.7298C213.194 57.5576 212.729 57.4727 212.26 57.4798C157.69 58.2298 126.5 38.6798 126.5 38.6798C126.5 38.6798 95.31 58.2298 40.71 57.4798C40.2401 57.4732 39.7735 57.5602 39.3376 57.7357C38.9017 57.9113 38.5051 58.1719 38.1709 58.5023C37.8367 58.8328 37.5717 59.2264 37.3913 59.6604C37.2108 60.0943 37.1186 60.5599 37.12 61.0298V108.03L118.84 147.57C121.591 148.902 123.808 151.128 125.129 153.884C126.45 156.64 126.797 159.762 126.113 162.741C125.429 165.72 123.755 168.378 121.363 170.282C118.972 172.185 116.006 173.221 112.95 173.22C110.919 173.221 108.915 172.76 107.09 171.87L40.24 139.48C46.6407 164.573 62.3785 186.277 84.24 200.16L124.49 225.7C125.061 226.053 125.719 226.24 126.39 226.24C127.061 226.24 127.719 226.053 128.29 225.7L168.57 200.16C187.187 188.399 201.464 170.892 209.24 150.29C208.715 150.11 208.2 149.9 207.7 149.66Z" fill="#fff"></path>
                            </svg>
                        </span>
                    </span>
                    <h3 style="color: rgba(0,0,0,.8);margin-right: 10px;">Tổng số tiền:</h3>
                </h2>
                <span class="total-order"><sup>đ</sup>{{number_format($row['total'])}}</span>
            </div>
            <div style="display:flex;margin-top:10px;justify-content: space-between;margin-right:8px;">
                <div class="desc-order">
                    @if($row['order_status'] == 0)
                    Kiện Hàng của bạn đang chờ xác nhận
                    @elseif($row['order_status'] == 1)
                    Kiện Hàng của bạn đang chờ ĐVVC lấy hàng
                    @elseif($row['order_status'] == 2)
                    Bạn hài lòng với sản phẩm đã nhận?.Nếu có, chọn "Đã nhận được hàng" nha.
                    @elseif($row['order_status'] == 3)
                    Không được đánh giá
                    @elseif($row['order_status'] == 4)
                    Bạn đã huỷ
                    @endif
                </div>
                <div>
                    @if($row['order_status'] == 2)
                    <button style="margin-right:10px;" type="button" class="stardust-button-status btn btn-default" data-id="{{$row['order_id']}}">Đã nhận hàng</button>
                    <button type="button" id="product-detail" class="product-detail btn btn-default" data-id="{{$row['order_id']}}">Chi tiết đơn hàng</button>
                    @elseif($row['order_status'] == 0 || $row['order_status'] == 1)
                    <button type="button" id="product-detail" class="product-detail btn btn-default" data-id="{{$row['order_id']}}">Chi tiết đơn hàng</button>
                    @elseif($row['order_status'] == 3)
                    <button style="margin-right:10px;" type="button" class="repurchase btn btn-default" data-id="{{$row['order_id']}}">Mua lần nữa</button>
                    <button type="button" id="product-detail" class="product-detail btn btn-default" data-id="{{$row['order_id']}}">Chi tiết đơn hàng</button>
                    @elseif($row['order_status'] == 4)
                    <button style="margin-right:10px;" type="button" class="repurchase btn btn-default" data-id="{{$row['order_id']}}">Mua lần nữa</button>
                    <button type="button" id="product-detail" class="product-detail btn btn-default" data-id="{{$row['order_id']}}">Chi tiết đơn huỷ</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
<?php
} else {
?>
    <div class="mypurchase-container">
        <div class="image-nopurchase"></div>
        <div style="margin: 20px 0 0;font-size: 18px;line-height: 1.4;color: rgba(0,0,0,1.0);">Chưa có đơn hàng</div>
    </div>
<?php
}
?>

<!-- Modal xác nhận hàng -->
<div class="modal_confirm">
    <div class="stardust-popup__overlay"></div>
    <div class="stardust-popup">
        <div class="stardust-popup__dialog--wrapper-top">
            <div class="stardust-popup-content">Tôi đã nhận và hài lòng với sản phẩm.Tôi sẽ không yêu cầu Hoàn Tiền hay Trả hàng</div>
        </div>
        <div class="stardust-popup-buttons">
            <span id="close_modal_confirm" class="stardust-popup-button stardust-popup-button--secondary" role="button">Không phải bây giờ</span>

            <span id="confirm_button" class="stardust-popup-button stardust-popup-button--main" role="button">Xác nhận</span>
        </div>
    </div>
</div>

<script text="text/javascript">
    var order_id = '';
    $(document).ready(function() {
        let status = location.href.split('my-purchase-status/')[1];
        let type_purchase = '#mypurchase_' + status;
        if (status == '-1') {
            $('.mypurchase_header--active').removeClass('mypurchase_header--active');
            $('#mypurchase_all').addClass('mypurchase_header--active');
        } else {
            $('.mypurchase_header--active').removeClass('mypurchase_header--active');
            $(type_purchase).addClass('mypurchase_header--active');
        }
    })

    // Trường hợp xuất kết quả tìm kiếm
    $(document).ready(function() {
        // Load purchase_status sơ pjax
        $('.mypurchase_header').click(function() {
            $.pjax({
                url: 'search-my-purchase',
                type: 'get',
                container: '#content_my_purchase_status',
                timeout: 9000000,
            })
        })
    })


    $('.stardust-button-status').click(function() {
        $('.modal_confirm').css('display', 'flex');
        order_id = $(this).data('id');
    })

    $('#close_modal_confirm').click(function() {
        $('.modal_confirm').css('display', 'none');
    })

    // Đã nhận hàng
    $('#confirm_button').click(function() {
        $.ajax({
            url: '/confirm-order\/' + order_id,
            type: 'get',
            success: function(res) {
                $('.modal_confirm').css('display', 'none');
                if (res.status === 200) {
                    location.reload();
                    swal("Thông báo", res.msg, 'success');
                }
                if (res.status === 403) {
                    swal("Thông báo", res.msg, 'error');
                }
            },

        });
    });
</script>

@endsection