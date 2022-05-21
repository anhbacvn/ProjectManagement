{{View::make('pages.header')}}

<?php

use Illuminate\Support\Facades\Session;
?>
{{View::make('pages.navbar')}}
</header>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs"  style="margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Payment</li>
            </ol>
        </div>
        <div class="review-payment">
            <h2>Giỏ hàng của bạn</h2>
        </div>

        <div class="table-responsive cart_info" style="width:100%;">
            <table class="table table-condensed">
                <thead>

                    <tr class="cart_menu">

                        <td class="image" style="text-align: center" ;>Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_cart as $key => $item)
                    <tr>

                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/upload/product/' .$item->product_image)}}" alt="" style="height: 256px;width: 256px;object-fit: contain;"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->product_name}}</a></h4>
                            <p>ID sản phẩm:{{$item->product_id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($item->product_price)}}<sup>đ</sup></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <div class="cart_quantity_up cart_quantity_change" style=" cursor:pointer; height:28px; background: #F0F0E9; color: #696763; font-size: 16px; height: 28pxpx; overflow: hidden; text-align: center; width: 35px; float: left;" data-id='{{$item->cart_id}}' href="#"> + </div>
                                <input class="cart_quantity_input" onkeypress="return isNumberKey(event)" data-id='{{$item->cart_id}}' type="text" name="quantity" value="{{$item->quatity}}" autocomplete="off" size="2">
                                <div class="cart_quantity_down cart_quantity_change" style=" cursor:pointer; height:28px; background: #F0F0E9; color: #696763; font-size: 16px; height: 28pxpx; overflow: hidden; text-align: center; width: 35px; float: left;" data-id='{{$item->cart_id}}' href="#"> - </div>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($item->cart_price)}}<sup>đ</sup></p>
                        </td>
                        <td class="cart_delete">
                            <div class="cart_quantity_delete" style="background: #F0F0E9; color: #FFFFFF; padding: 5px 7px; font-size: 16px; display:inline-block;margin-right:5px;" data-id='{{$item->cart_id}}' href="#"><i class="fa fa-times"></i></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 pull-right" style="padding: 0;margin-right: 30px;">
                        <div class="total_area" style="padding: 0 25px;">
                            <ul style="padding:0;">
                                <li id='total_cart'>Tổng tiền<span>{{number_format($total_cart)}}<sup>đ</sup></span></li>
                                <li>Tiền ship<span>Free</span></li>
                                <li id='sub_total_cart'>Tổng cộng<span>{{number_format($total_cart)}}<sup>đ</sup></span></li>
                            </ul>
                            <h4 style="margin:38px 0;font-size:18px;">Chọn hình thức thanh toán</h4>
                            <form action="{{URL::to('/order-place')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$id_address}}" name="id_address">
                                <div class="payment-options" style="margin-bottom: 10px;text-align:center; justify-content: space-between;display: flex;margin-top: 30px; position: initial;">
                                    @foreach($get_payment_method as $item)
                                    <span>
                                        <label style="cursor:pointer; user-select:none;">
                                        <input value="{{$item->payment_id}}" style=" margin-right:10px" type="radio" name="payment_method" class="payment_method_input" checked>{{$item->payment_type}}</label>
                                    </span>
                                    @endforeach
                                </div>
                                <input type="submit" style="width:100%; height:40px; font-size:1.6rem;" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</section>
<!--/#cart_items-->

<script type="text/javascript">
    $(document).ready(function() {
        $('.cart_quantity_up').click(function() {
            var row = this;
            var id = $(this).data('id');

            var data = $(row).parents('td').find('input');

            var input = Number(data.val()) + 1;

            data.val(input);
            if (data.val() === '0') {
                delete_cart_product(id, row);
            } else {

                change_quantity(id, data.val(), row);
            }
        });
    });

    $(document).ready(function() {
        $('.cart_quantity_down').click(function() {
            var row = this;
            var id = $(this).data('id');
            var data = $(row).parents('td').find('input');

            var input = Number(data.val()) - 1;

            data.val(input);
            if (data.val() === '0') {
                delete_cart_product(id, row);
            } else {

                change_quantity(id, data.val(), row);
            }
        });
    });

    $(document).ready(function() {
        $('.cart_quantity_input').keyup(function() {
            var row = this;
            var id = $(this).data('id');
            var qty = $(this).val();
            if (qty === '0') {
                delete_cart_product(id, row);
            } else {

                change_quantity(id, qty, row);
            }
        });
    });

    function isNumberKey(e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $(document).ready(function() {
        $('.cart_quantity_delete').click(function() {
            var row = this;
            var id = $(this).data('id');

            swal({
                    title: "Are you sure?",
                    text: "Your will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function() {
                    delete_cart_product(id, row);
                });
        });
    });


    function change_quantity(id, qty, row) {
        $.ajax({
            url: 'change-quantity\/' + id + '\/' + qty,
            type: 'get',
            success: function(res) {
                if (res.status === 402) {
                    alert(res.msg);
                }
                if (res.status === 200) {

                    var data = $(row).parents('tr').find('td');

                    var cart_price = new Intl.NumberFormat().format(res.cart_price);
                    data.eq(4).html(`
								<p class="cart_total_price">${cart_price}<sup>đ</sup></p>
							`)

                    var total = new Intl.NumberFormat().format(res.total);
                    $('#total_cart').html(`Tổng tiền<span>` + total + `<sup>đ</sup></span>`);

                    $('#sub_total_cart').html(`Tổng cộng<span>` + total + `<sup>đ</sup></span>`);
                }
            }
        });
    }

    function delete_cart_product(id, row) {
        $.ajax({
            url: 'delete-cart-product\/' + id,
            type: 'get',
            success: function(res) {
                if (res.status === 402) {
                    alert(res.msg);
                }
                if (res.status === 200) {

                    $(row).closest('tr').fadeOut(800, function() {
                        $(this).remove();
                        swal("Thông báo", res.msg, "success");
                    });
                    var total = new Intl.NumberFormat().format(res.total);
                    $('#total_cart').html(`Tổng tiền<span>` + total + `<sup>đ</sup></span>`);

                    $('#sub_total_cart').html(`Tổng cộng<span>` + total + `<sup>đ</sup></span>`);
                }
            }
        });
    }

    var payment_method_input = document.querySelectorAll('.payment_method_input');
    payment_method_input[0].checked=true;
</script>
{{View::make('pages.footer')}}