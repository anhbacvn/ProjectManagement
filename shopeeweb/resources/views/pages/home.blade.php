@extends('welcome')
@section('content')

<div class="features_items">
	<!--features_items-->
	<h2 class="title text-center">Sản phẩm mới nhất</h2>
	@foreach($all_product as $key => $product)
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
						<input type="hidden" class="cart_product_qty" data-id="{{$product->product_id}}" value="1">
						<img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" style="height: 256px;object-fit: contain;width:90%;" />
						<h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
						<p>{{$product->product_name}}</p>
					</a>
					<button data-url="add-cart-ajax" type="button" class="btn btn-default add-to-cart" style="z-index:1000;" name="add-to-cart" data-id="{{$product->product_id}}">Thêm giỏ hàng</button>
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
	@endforeach
</div>
<!--features_items-->
@endsection