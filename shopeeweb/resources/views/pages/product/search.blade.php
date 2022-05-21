@extends('welcome')
@section('content')


<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($search_product as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" style="height: 256px;object-fit: contain;" />
                        <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                        <p>{{$product->product_name}}</p>
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id="{{$product->product_id}}">Thêm giỏ hàng</button>
                    </div>
                </div>
        </div>
        </a>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
<!--features_items-->
@endsection