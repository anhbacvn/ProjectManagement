@extends('pages.profile')
@section('profile_content')
<!-- Đơn mua -->
<?php

use Illuminate\Support\Facades\Session;

$data_all_order = Session::get('data_all_order');
$order_status = Session::get('order_status');

?>
<div class="content__mypurchase">
    <div id="content__mypurchase-header" class="content__mypurchase-header">
        <div id="mypurchase_all" data-id="-1" class="mypurchase_header">
            <span class="ajax-select">
                Tất cả
            </span>
        </div>
        @for($i=0 ; $i < count($order_status) ; $i++) <div id="mypurchase_{{$i}}" data-id="{{$i}}" class="mypurchase_header">
            <span class="ajax-select">
                {{$order_status[$i]}}
            </span>
    </div>
    @endfor


</div>

<!-- Search đơn hàng -->
<form action="" id="form-search-my-purchase">
    <div id="search-mypurchase" class="search-mypurchase" style="display:block;">
        <svg width="19px" height="19px" viewBox="0 0 19 19" style="margin: 0 15px;stroke: #bbb;">
            <g id="Search-New" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="my-purchase-copy-27" transform="translate(-399.000000, -221.000000)" stroke-width="2">
                    <g id="Group-32" transform="translate(400.000000, 222.000000)">
                        <circle id="Oval-27" cx="7" cy="7" r="7"></circle>
                        <path d="M12,12 L16.9799555,16.919354" id="Path-184" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </g>
            </g>
        </svg>
        <input type="text" style="width: 94%;flex: 1;font-size: 14px;line-height: 16px;border: 0;outline: none;background-color: inherit;" id="keywords_mypurchase_submit" placeholder="Tìm kiếm theo tên sản phẩm" />
    </div>
</form>
<!-- Tất cả đơn mua -->
<div class="content_mypurchase-container" id="content_my_purchase_status">
    @yield('my_purchase_status_content')
</div>

</div>

<script text="text/javascript">
    $(document).ready(function() {
        // Load purchase_status sơ pjax
        $('.mypurchase_header').click(function() {
            $.pjax({
                url: '/my-purchase-status\/' + $(this).data('id'),
                type: 'get',
                container: '#content_my_purchase_status',
                timeout: 9000000,
            })
        })
    })

    $('.mypurchase_header').click(function() {
        remove_active_mypurchase();
        $(this).addClass('mypurchase_header--active');
    });

    function remove_active_mypurchase() {
        $('.mypurchase_header--active').removeClass('mypurchase_header--active');
    }

    // Ẩn hiện thành search
    $("#mypurchase_pay").click(function() {
        document.getElementById("search-mypurchase").style.display = "none";
    });
    $("#mypurchase_all").click(function() {
        document.getElementById("search-mypurchase").style.display = "block";
    });

    // Trường hợp mua lần nữa
    $(document).ready(function() {
        $('.repurchase').click(function() {
            var id = $(this).data('id');

            var _url = 'repurchase\/' + id;
            repurchase(id, _url);
        });

        $('.my_info--active').removeClass('my_info--active');
        $('#my_purchase').addClass('my_info--active');
    });

    function repurchase(id, _url) {
        $.ajax({
            url: _url,
            method: 'GET',
            success: function(data) {
                if (data.status === 200) {
                    url_show_cart = '{{URL::to("show-cart")}}';
                    window.location.href = url_show_cart;
                }
                if (!data.status) {
                    url_user_login = '{{URL::to("user-login")}}';
                    window.location.href = url_user_login;
                }
            }
        });
    }

    //Tìm kiếm đơn hàng
    $(document).ready(function() {
        $('#form-search-my-purchase').submit(function(e) {
            e.preventDefault();
            let keywords_mypurchase_submit = $('#keywords_mypurchase_submit').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{URL::to("search-my-purchase")}}',
                type: 'post',
                data: {
                    '_token': token,
                    'keywords_mypurchase_submit': keywords_mypurchase_submit,
                },
                success: function(res) {
                    if (res.status === 403) {
                        swal('Thông báo', res.msg, 'error');
                    }
                    if (res.status === 200) {
                        window.location.href = 'my-purchase-status\/-1';
                    }
                }
            });
        });
    });
</script>
@endsection