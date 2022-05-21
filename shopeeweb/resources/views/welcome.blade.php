{{View::make('pages.header')}}
<?php
use Illuminate\Support\Facades\Session;
?>
	{{View::make('pages.navbar')}}
	{{View::make('pages.navbar_bottom')}}
	{{View::make('pages.slider')}}

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<!-- /Category-products -->
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian">
							@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/' .$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div>
						<!--/category-products-->

						<div class="brands_products">
							<!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								@foreach($brand as $key => $brand)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/thuong-hieu-san-pham/' .$brand->brand_product_id)}}"> <span class="pull-right">(50)</span>{{$brand->brand_product_name}}</a></li>
								</ul>
								@endforeach
							</div>
						</div>
						<!--/brands_products-->
					</div>
				</div>

				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>

	

	<script type="text/javascript">
		$(document).ready(function() {
			$('.add-to-cart').click(function() {
				var id = $(this).data('id');
				var getqty = document.querySelectorAll(".cart_product_qty");
				var qty = 0;

				getqty.forEach(function(element, index) {
					if (id === $(element).data('id')) {
						qty = $(element).val();
					}
				});

				var data_url = $(this).data('url');
				var url = data_url + '\/' + id + '\/' + qty;
				// alert(qty);
				add_product(id,qty,url);
			});
		});

		function add_product(id,qty,url){
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
						if(!data.status) {
							url_user_login = '{{URL::to("user-login")}}';
							window.location.href = url_user_login;
						}
					}
				});
		}
	</script>

{{View::make('pages.footer')}}