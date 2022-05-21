{{View::make('pages.header')}}
<?php

use Illuminate\Support\Facades\Session;
?>
{{View::make('pages.navbar')}}
</header>
<section id="cart_items">
    <div class="container" style="width: 1170px;">
        <div class="breadcrumbs" style="margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info" id='no-cart' style="width: 100%;">
            @if($data_cart != null)
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
            <!--/#cart_items-->



            <div class="row">
                <div class="col-sm-8">
                    <div class="total_area">
                        <ul>
                            <li id='total_cart'>Tổng tiền<span>{{number_format($total_cart)}}<sup>đ</sup></span></li>
                            <li>Tiền ship<span>Free</span></li>
                            <li id='sub_total_cart'>Tổng cộng<span>{{number_format($total_cart)}}<sup>đ</sup></span></li>
                        </ul>
                        <a class="btn btn-default check_out" href="{{URL::to('show-checkout')}}">Thanh toán</a>
                    </div>
                </div>
            </div>

            @else
            <div class="content" id='no-cart'>
                <img src="https://sona.net.vn/uploads/img/cart.png" alt="" class="img__nocart">
                <div style="margin-top: 1.125rem;;color: rgba(0,0,0,.5);font-size: .875rem;line-height: 1rem;">Giỏ hàng của bạn còn trống</div>
                <button type="button" class="btn__order" onclick="location.href='http://shopeeweb.test/home';">Đặt hàng ngay</button>
            </div>
            @endif
        </div>
    </div>
</section>




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
                    swal("Thông báo", res.msg, "error");
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
                if (res.status === 403) {
                    swal("Thông báo", res.msg, "error");
                }
                if (res.status === 200 && res.count === 1) {
                    swal("Thông báo", res.msg, "success");
                    $(row).closest('tr').fadeOut(800, function() {
                        $(this).remove();

                    });
                    var total = new Intl.NumberFormat().format(res.total);
                    $('#total_cart').html(`Tổng tiền<span>` + total + `<sup>đ</sup></span>`);

                    $('#sub_total_cart').html(`Tổng cộng<span>` + total + `<sup>đ</sup></span>`);
                    $('#qty-cart').html(res.qty_cart);
                }
                if (res.status === 200 && res.count === 0) {
                    swal("Thông báo", res.msg, "success");
                    $(row).closest('tr').fadeOut(800, function() {
                        $(this).remove();
                    });
                    $('#no-cart').html(`
                    <div class="content">
                        <img src="https://sona.net.vn/uploads/img/cart.png" alt="" class="img__nocart">
                        <div style="margin-top: 1.125rem;;color: rgba(0,0,0,.5);font-size: .875rem;line-height: 1rem;">Giỏ hàng của bạn còn trống</div>
                        <button class="btn__order"><a href="{{URL::to('/home')}}" style="color:white;">Đặt hàng ngay</a></button>
                    </div>
                    `);
                    $('#qty-cart').html(res.qty_cart);
                }
            }
        });
    }
</script>
{{View::make('pages.footer')}}