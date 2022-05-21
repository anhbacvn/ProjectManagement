{{View::make('pages.header')}}

<?php

use Illuminate\Support\Facades\Session;
?>
{{View::make('pages.navbar')}}
{{View::make('pages.navbar_bottom')}}
<section>
	<div class="container">
		<div class="row">
			@foreach($product_details as $key => $value)
			<div class="product-details">
				<!--product-details-->
				<div class="col-sm-4">
					<div class="view-product">
						<img src="{{asset('/public/upload/product/' .$value->product_image)}}" alt="" />
						<h3>ZOOM</h3>
					</div>
					<div id="similar-product" class="carousel slide" data-ride="carousel">

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<div class="item active">
								<a href=""><img src="{{asset('fontend/images/product-details/similar1.jpg')}}" alt=""></a>
								<a href=""><img src="{{asset('fontend/images/product-details/similar2.jpg')}}" alt=""></a>
								<a href=""><img src="{{asset('fontend/images/product-details/similar3.jpg')}}" alt=""></a>
							</div>

						</div>

						<!-- Controls -->
						<a class="left item-control" href="#similar-product" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a class="right item-control" href="#similar-product" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
				<div class="col-sm-8">
					<div class="product-information">
						<!--/product-information-->
						<img src="{{asset('fontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
						<h2>{{$value->product_name}}</h2>
						<p>Mã sản phẩm: {{$value->product_id}}</p>
						<img src="{{asset('fontend/images/product-details/rating.png')}}" alt="" />


						<span style="display: flex;flex-direction: column;">
							<span>{{number_format($value->product_price).' '.'VNĐ'}}</span>

							<div class="Quantity-item">
								<label>Số lượng:</label>
								<input id="qty-product" type="number" min="1" value="1" />
							</div>

							<button type="submit" class="btn btn-fefault cart btn-cart add-to-cart-detail" style="margin:10px 0" id="add-to-cart-detail" data-id="{{$value->product_id}}">
								<i class="fa fa-shopping-cart"></i>
								Thêm giỏ hàng
							</button>
						</span>

						<p><b>Tình trạng:</b> Còn hàng</p>
						<p><b>Điều kiện:</b> 100%</p>
						<p><b>Thương hiệu:</b> {{$value->brand_product_name}}</p>
						<p><b>Danh mục:</b> {{$value->category_name}}</p>
						<a href=""><img src="{{asset('fontend/images/product-details/share.png')}}" class="share img-responsive" alt="" /></a>
					</div>
					<!--/product-information-->
				</div>
			</div>
			<!--/product-details-->


			<div class="category-tab shop-details-tab" style="padding:0;">
				<!--category-tab-->
				<div class="col-sm-12">
					<ul class="nav nav-tabs" style="margin-bottom:10px;">
						<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
						<li><a href="#companyprofile" data-toggle="tab">Chi tiết</a></li>
						<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="details">
						<textarea name="" id="" cols="30" rows="4">{{$value->product_desc}}</textarea>
					</div>

					<div class="tab-pane fade" id="companyprofile">
						<textarea name="" id="" cols="30" rows="4">{{$value->product_content}}</textarea>
					</div>

					<div class="tab-pane fade" id="reviews">
						<div class="col-sm-12">
							<ul>
								<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
								<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
								<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
							<p><b>Write Your Review</b></p>
							<div>
								<form action="#">
									<span>
										<input type="text" placeholder="Your Name" />
										<input type="email" placeholder="Email Address" />
									</span>
									<textarea name=""></textarea>
									<b>Rating: </b> <img src="{{asset('images/product-details/rating.png')}}" alt="" />
									<button type="button" class="btn btn-default pull-right" style="margin-bottom:10px;">
										Submit
									</button>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
			@endforeach
			<!--/category-tab-->

			<div class="recommended_items">
				<!--recommended_items-->
				<h2 class="title text-center">Sản phẩm liên quan</h2>

				<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="item active">
							@foreach($related as $key => $lienquan)
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
										<a href="{{URL::to('chi-tiet-san-pham/'.$lienquan->product_id)}}">
											<img src="{{URL::to('public/upload/product/'.$lienquan->product_image)}}" alt="" style="height: 256px;object-fit: contain;" />
											<h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
											<p>{{$lienquan->product_name}}</p>
										</a>
											<button type="submit" class="btn btn-fefault cart btn-cart add-to-cart-detail" style="margin:10px 0" id="add-to-cart-detail" data-id="{{$lienquan->product_id}}">
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
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<!--/recommended_items-->
		</div>
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function() {
		$('.add-to-cart-detail').click(function() {
			var id = $(this).data('id');
			var qty = $('#qty-product').val();

			var url = '/add-cart-ajax\/' + id + '\/' + qty;
			// alert(qty);
			add_product(id, qty, url);
		});

		function add_product(id, qty, url) {
			$.ajax({
				url: url,
				method: 'GET',
				success: function(data) {
					if (data.status === 403) {
						swal("Thông báo", data.msg, "error");
					}
					if (data.status === 402) {
						swal("Thông báo", data.msg, "error");
					}
					if (data.status === 200) {
						toastr['success'](data.msg);
						$('#qty-cart').html(data.qty_cart);
					}
					if (!data.status) {
						url_user_login = '{{URL::to("user-login")}}';
						window.location.href = url_user_login;
					}
				}
			});
		}
	});
</script>
{{View::make('pages.footer')}}