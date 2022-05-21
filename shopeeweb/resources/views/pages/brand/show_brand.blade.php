@extends('welcome')
@section('content')


<div class="features_items">
    @foreach($brand_name as $key => $name)
    <h2 class="title text-center">{{$name->brand_product_name}}</h2>
    @endforeach
    @foreach($brand_by_id as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
                        <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" style="height: 256px;object-fit: contain;" />
                        <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                        <p>{{$product->product_name}}</p>
						<input type="hidden" class="cart_product_qty" data-id="{{$product->product_id}}" value="1">
                    </a>
                    <button data-url="add-cart-ajax" type="button" class="btn btn-default add-to-cart" style="margin:10px 0" id="add-to-cart-category" data-id="{{$product->product_id}}">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm giỏ hàng
                    </button>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    @endforeach
</div>
@endsection