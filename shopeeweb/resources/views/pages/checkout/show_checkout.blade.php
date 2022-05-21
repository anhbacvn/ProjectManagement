{{View::make('pages.header')}}

<?php

use Illuminate\Support\Facades\Session;
?>
{{View::make('pages.navbar')}}
</header>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs" style="margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <div class="_1TKMuK">
                            <div class="_20Qrq_ " style="display: flex;color: #ee4d2d;">
                                <div class="_2t2xOY" style="margin-right: 10px;"><svg height="16" viewBox="0 0 12 16" width="12" class="shopee-svg-icon icon-location-marker">
                                        <path d="M6 3.2c1.506 0 2.727 1.195 2.727 2.667 0 1.473-1.22 2.666-2.727 2.666S3.273 7.34 3.273 5.867C3.273 4.395 4.493 3.2 6 3.2zM0 6c0-3.315 2.686-6 6-6s6 2.685 6 6c0 2.498-1.964 5.742-6 9.933C1.613 11.743 0 8.498 0 6z" fill-rule="evenodd"></path>
                                    </svg></div>
                                <div style="font-size:18px;position: relative;top: -5px;">Địa Chỉ Nhận Hàng</div>
                            </div>
                        </div>
                        <div class="form-one" style="width:80%;margin-bottom:20px">
                            <?php
                            if ($address_by_user != null) {
                            ?>
                                <div class="address" style="display:flex;">
                                    <select name="" id="address_select" style="font-size:15px;" class="col-sm-8">
                                        <?php
                                        $all_cart_by_user = Session::get('all_cart_by_user');
                                        ?>
                                        @foreach ($all_cart_by_user as $item)
                                        <option value="{{$item->address_shipping_id}}">{{$item->address_shipping_name}} (+84) {{$item->address_shipping_phone}} {{$item->address_shipping_country}} {{$item->address_shipping_city}} {{$item->address_shipping_district}} {{$item->address_shipping_wards}} {{$item->address_shipping_detail}}</option>
                                        @endforeach
                                    </select>
                                    <button class="change-address col-sm-2" id="change-address" style="color: #05a;text-transform: uppercase;margin-left: 20px;font-weight: 300;border: none;cursor: pointer;">Thêm địa chỉ mới</button>
                                </div>
                                <form class="form-change-address" id="form-change-address" style="display:none;">
                                    {{ csrf_field() }}
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ tên*">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Điện thoại*">
                                    <input type="text" name="shipping_country" class="shipping_country" placeholder="Đất nước*">
                                    <div>
                                        <select class="form-input" class="city-checkout" id="city-checkout" style="margin-bottom:12px;">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                        </select>
                                        <select class="form-input" class="district-checkout" id="district-checkout" style="margin-bottom:12px;">
                                            <option value="" selected>Chọn quận huyện</option>
                                        </select>
                                        <select class="form-input" class="ward-checkout" id="ward-checkout" style="margin-bottom:12px;">
                                            <option value="" selected>Chọn phường xã</option>
                                        </select>
                                    </div>
                                    <input type="text" name="shipping_address_detail" class="shipping_address_detail" placeholder="Địa chỉ cụ thể (Số nhà,Số đường)*">
                                    <input type="submit" value="Tiếp tục" class="btn btn-primary btn-sm change-send-order" style="padding: 10px 24px;margin: 10px;margin-left: 0;width:120px;">
                                    <button type="button" class="buton-change-back" onclick="location.href='http://shopeeweb.test/show-checkout';" class="btn btn-primary btn-sm" style="padding: 10px 24px;background-color:#fff;color:#555;border-radius:2px;border:1px solid rgba(0,0,0,.09);width:120px;margin:0;">Trở lại</button>
                                </form>
                                <input type="submit" value="Tiếp tục" id="send-order" class="btn btn-primary btn-sm" style="padding: 10px 24px;margin-right:15px;width:120px;">
                                <button type="button" id="change-back" onclick="location.href='http://shopeeweb.test/show-cart';" class="btn btn-primary btn-sm" style="padding: 10px 24px;background-color:#fff;color:#555;border-radius:2px;border:1px solid rgba(0,0,0,.09);width:120px;">Trở lại</button>
                            <?php
                            } else {
                            ?>
                                <form class="form-change-address" style="display:block;">
                                    {{ csrf_field() }}
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ tên*">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Điện thoại*">
                                    <input type="text" name="shipping_country" class="shipping_country" placeholder="Đất nước*">
                                    <div>
                                        <select class="form-input" class="city-checkout" id="city-checkout" style="margin-bottom:12px;">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                        </select>
                                        <select class="form-input" class="district-checkout" id="district-checkout" style="margin-bottom:12px;">
                                            <option value="" selected>Chọn quận huyện</option>
                                        </select>
                                        <select class="form-input" class="ward-checkout" id="ward-checkout" style="margin-bottom:12px;">
                                            <option value="" selected>Chọn phường xã</option>
                                        </select>
                                    </div>
                                    <input type="text" name="shipping_address_detail" class="shipping_address_detail" placeholder="Địa chỉ cụ thể (Số nhà,Số đường)*">
                                    <input type="submit" value="Tiếp tục" class="btn btn-primary btn-sm change-send-order" style="padding: 10px 24px;margin: 10px;margin-left: 0;width:120px;">
                                    <button type="button" class="buton-change-back" onclick="location.href='http://shopeeweb.test/show-checkout';" class="btn btn-primary btn-sm" style="padding: 10px 24px;background-color:#fff;color:#555;border-radius:2px;border:1px solid rgba(0,0,0,.09);width:120px;margin:0;">Trở lại</button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--/#cart_items-->

<script type="text/javascript">
    $("#change-address").click(function() {
        document.getElementById("form-change-address").style.display = 'block';
        document.getElementById("change-address").style.display = "none";
        document.getElementById("address_select").style.display = "none";
        document.getElementById("change-back").style.display = "none";
        document.getElementById("send-order").style.display = "none";
    });

    $('#send-order').click(function(e) {
        var address_id = $('#address_select option:selected').val();
        window.location.href = 'payment\/' + address_id;
    });

    $(document).ready(function() {
        let citis2 = document.getElementById("city-checkout");
        let districts2 = document.getElementById("district-checkout");
        let wards2 = document.getElementById("ward-checkout");
        getCity(citis2, districts2, wards2);
        $('.form-change-address').submit(function(e) {
            e.preventDefault();
            let shipping_name = $(this).find('.shipping_name').val();
            let shipping_phone = $(this).find('.shipping_phone').val();
            let shipping_country = $(this).find('.shipping_country').val();
            var shipping_city = $(this).find('#city-checkout option:selected').text();
            var shipping_district = $(this).find('#district-checkout option:selected').text();
            var shipping_wards = $(this).find('#ward-checkout option:selected').text();
            let shipping_address_detail = $(this).find('.shipping_address_detail').val();
            let token = $(this).find('input[name="_token"]').val();
            $.ajax({
                url: '{{URL::to("/save-checkout-customer")}}',
                type: 'post',
                data: {
                    '_token': token,
                    'shipping_name': shipping_name,
                    'shipping_phone': shipping_phone,
                    'shipping_country': shipping_country,
                    'shipping_city': shipping_city,
                    'shipping_district': shipping_district,
                    'shipping_wards': shipping_wards,
                    'shipping_address_detail': shipping_address_detail,
                },
                success: function(res) {
                    if (res.status === 403) {
                        swal('Thông báo', res.msg, 'error');
                    }
                    if (res.status === 200) {
                        swal('Thông báo', res.msg, 'success');
                        window.location.href = "/payment\/" + res.address_shipping_id;
                    }
                }
            });
        });


    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js?123"></script>
<script src="{{asset('fontend/js/app_edit.js')}}"></script>
{{View::make('pages.footer')}}