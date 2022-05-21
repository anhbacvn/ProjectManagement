{{View::make('pages.header')}}

{{View::make('pages.navbar')}}
</header>
<div class="content">
    <div class="container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmL1Uk_8SnQW5VJQssf689fNbmbeqkwyKwR-VfWxJLVoQRqW1foitnAh53TwHwu-L_714&usqp=CAU" alt="" class="img_success">
        <h1 class="title">Đặt hàng thành công</h1>
        <h3 class="transaction__id">Mã giao dịch:{{$order_id}}</h3>

        <table class="table__product">
            <thead>
                <tr>
                    <th style="text-align:center;">Thời gian</th>
                    <th col="3" style="text-align:center;">Tên Sản phẩm</th>
                    <th style="text-align:center;">Số lượng</th>
                    <th style="text-align:center;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($new_order as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->order_detail_quantity}}</td>

                    <td style="color:red;font-weight: bold;">{{number_format($item->order_detail_price)}}<sup>đ</sup></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>Chúng tôi sẽ liên hệ với bạn ngay sau khi nhận được đơn đặt hàng này</div>
        <div>Mọi thắc mắc xin vui lòng liên hệ hotline: 0917 616 633</div>

        <div class="btn__success">
            <button class="btn__home-back" onclick="location.href='http://shopeeweb.test/home';">Trở về trang chủ</button>
            <button class="btn__show-order"onclick="location.href='http://shopeeweb.test/my-purchase-status/-1';">Xem đơn hàng</button>
        </div>
    </div>
</div>
{{View::make('pages.footer')}}