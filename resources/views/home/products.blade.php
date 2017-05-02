<!--
实物列表
-->
@extends('home.layout.index')
@section('title','饿了么菜品')
<style type="text/css">
	li{list-style-type: none;}
</style>
@section('con')
<!-- //products --> 
	<div class="container" style='margin-top:20px';> 
		<div class="w3agile-deals prds-w3text"> 
			<h5>欢迎光临{{$shopname}}</h5>
		</div>
	</div>
<div class="products">	 
		<div class="container">
			<div class="col-md-9 product-w3ls-right"> 
				<div class="product-top">
					<h4>本店列表</h4>
					<ul> 
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Low price</a></li> 
								<li><a href="#">High price</a></li>
								<li><a href="#">Latest</a></li>  
							</ul> 
						</li>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Food Type<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Breakfast</a></li> 
								<li><a href="#">Lunch</a></li>
								<li><a href="#">Dinner</a></li>  
							</ul> 
						</li>
					</ul> 
					<div class="clearfix"> </div>
				</div>
				<div class="products-row">
				@foreach($dd as $k=>$v)
					<div class="col-xs-6 col-sm-6 product-grids">
						<div class="flip-container flip-container1">
							<div class="flipper agile-products">
								<div class="front"> 
									<div class="agile-product-text agile-product-text2">              
										<h5>{{$v->foodname}}</h5>  
									</div> 
									<img src="{{$v->pic}}" class="img-responsive" alt="img"> 
								</div>
								<div class="back">
									<h4>{{$v->foodname}}</h4>
									<p>{{$v->info}}</p>
									<h6>{{$v->price}}<sup>￥</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="id" id="id" value="{{$v->id}}">
										<input type="hidden" name="w3ls_item" value="{{$v->foodname}}"> 
										<input type="hidden" name="amount" value="{{$v->price}}"> 
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i>加入购物车</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal"  onclick="func(this)" data-target="#myModal1">菜品详情</a>
									</form>
								</div>
							</div>
						</div> 
					</div>

				@endforeach
					<div class="clearfix">
						
					 </div>
				</div>
				{!! $dd->appends($all)->render() !!}
			</div>

			<div class="col-md-3 rsidebar">
				<div class="rsidebar-top">
					<div class="sidebar-row" style='margin-top:60px'>
						<h4>菜品列表</h4>
							
						@if($arr)
						<li class="subitem1"><a href="/shop/products?sid={{$sid}}">全部菜品</a></li>
						
						@foreach($arr as $k=>$v)
							<li class="subitem1"><a href="/shop/products?sid={{$sid}}&title={{$v}}">{{$v}}</a></li>
						@endforeach
						@else
						<li class="subitem1"><a href="/shop/products?sid={{$sid}}">全部菜品</a></li>
						@endif
						<div class="clearfix"> </div> 
						<!-- script for tabs -->
						<script type="text/javascript">
							$(function() {
							
								var menu_ul = $('.faq > li > ul'),
									   menu_a  = $('.faq > li > a');
								
								menu_ul.hide();
							
								menu_a.click(function(e) {
									e.preventDefault();
									if(!$(this).hasClass('active')) {
										menu_a.removeClass('active');
										menu_ul.filter(':visible').slideUp('normal');
										$(this).addClass('active').next().stop(true,true).slideDown('normal');
									} else {
										$(this).removeClass('active');
										$(this).next().stop(true,true).slideUp('normal');
									}
								});
							
							});
						</script>
						<!-- script for tabs -->
					</div>
					
			</div>
				<div class="related-row">
					<h4>YOU MAY ALSO LIKE</h4>
					<div class="galry-like">  
						<a href="#" data-toggle="modal" data-target="#myModal1"><img src="../images/s1.jpg" class="img-responsive" alt="img"></a>         
					</div>
				</div>
			</div>
			<div class="clearfix"> </div> 
		</div>
</div>

					
		<!-- modal --> 
	
	<div class="modal video-modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModal1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>						
				</div>
				<section>
					<div class="modal-body">
						<div class="col-md-5 modal_body_left">
							<img src="" alt=" " id="pic" class="img-responsive">
						</div>
						<div class="col-md-7 modal_body_right single-top-right"> 
							<h3 class="item_name">菜品名称</h3>
							<p class="item_info">菜品介绍</p>
							<div class="single-rating">
								<ul>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li class="w3act"><i class="fa fa-star-o" aria-hidden="true"></i></li>
									<li class="rating"><h2 class="item_price">18</h2><h3>元</h3></li>
									<li><a href="#">进行评价->-></a></li>
								</ul> 
							</div>
							<form action="#" method="post">
								<input type="hidden" name="cmd" value="_cart" />
								<input type="hidden" name="add" value="1" /> 
								<input type="hidden" name="w3ls_item" id="w3ls_item" value="菜品名称" /> 
								<input type="hidden" name="amount" id='amount' value="菜品价格" /> 
								
								<button type="submit" class="w3ls-cart" ><i class="fa fa-cart-plus" aria-hidden="true"></i>加入购物车</button>
							</form>
							<a href="#" class="w3ls-cart w3ls-cart-like"><i class="fa fa-heart-o" aria-hidden="true"></i>加入收藏</a>
							<div class="single-page-icons social-icons"> 
								<ul>
									<li><h4>分享到</h4></li>
									<li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
									<li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
									<li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
									<li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
									<li><a href="#" class="fa fa-rss icon rss"> </a></li> 
								</ul>
							</div> 
						</div> 
						<div class="clearfix"> </div>
					</div>
				</section>
			</div>
		</div>
	</div> 

	<!-- //modal -->
	<!-- dishes -->
	<div class="w3agile-spldishes">
		<div class="container">
			<h3 class="w3ls-title">本店推荐</h3>
			<div class="spldishes-agileinfo">
				<div class="col-md-3 spldishes-w3left">
					<h5 class="w3ltitle">Staple Specials</h5>
					<p>Vero vulputate enim non justo posuere placerat Phasellus mauris vulputate enim non justo enim .</p>
				</div> 
				<div class="col-md-9 spldishes-grids">
					<!-- Owl-Carousel -->
					<div id="owl-demo" class="owl-carousel text-center agileinfo-gallery-row">
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g1.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g2.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g3.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g4.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g5.jpg" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a> 
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g1.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g2.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
						<a href="products.html" class="item g1">
							<img class="lazyOwl" src="../images/g3.jpg" title="Our latest gallery" alt=""/>
							<div class="agile-dish-caption">
								<h4>Duis congue</h4>
								<span>Neque porro quisquam est qui dolorem </span>
							</div>
						</a>
					</div> 
				</div>  
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //dishes --> 

	<!-- subscribe -->
	<div class="subscribe agileits-w3layouts"> 
		<div class="container">
			<div class="col-md-6 social-icons w3-agile-icons">
				<h4>Keep in touch</h4>  
				<ul>
					<li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
					<li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
					<li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
					<li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
					<li><a href="#" class="fa fa-rss icon rss"> </a></li> 
				</ul> 
				<ul class="apps"> 
					<li><h4>Download Our app : </h4> </li>
					<li><a href="#" class="fa fa-apple"></a></li>
					<li><a href="#" class="fa fa-windows"></a></li>
					<li><a href="#" class="fa fa-android"></a></li>
				</ul> 
			</div> 
			<div class="col-md-6 subscribe-right">
				<h3 class="w3ls-title">Subscribe to Our <br><span>中国</span></h3>  
				<form action="#" method="post"> 
					<input type="email" name="email" placeholder="Enter your Email..." required="">
					<input type="submit" value="Subscribe">
					<div class="clearfix"> </div> 
				</form> 
				<img src="../images/i1.png" class="sub-w3lsimg" alt=""/>
			</div>
			<div class="clearfix"> </div> 
		</div>
	</div>	
@stop
@section('js')
<script type="text/javascript">

		var id; 
function func(obj){
	id = $(obj).siblings('#id').val();
	$.get('/shop/model',{id:id},function(data){
		$('#pic').attr('src',data[0]['pic']);
		$('.item_name').html(data[0]['foodname']);
		$('.item_info').html(data[0]['info']);
		$('.item_price').html(data[0]['price']);
		$('#w3ls_item').val(data[0]['foodname']);
		$('#amount').val(data[0]['price']);
	});
}
	
</script>
@endsection
	
	