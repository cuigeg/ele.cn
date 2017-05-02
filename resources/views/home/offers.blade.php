@extends('home.layout.index')
@section('title','饿了么产品')
@section('con')
	<div class="offers about"> 
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1">今日推荐</h3>  
			<div class="offers-wthreerow">  
				<div class="offers-right"> 
					<h5>全场九折</h5>
					<p class="w3ls-offertext">跳楼价，一流的服务</p>
					<br>
					<h5>份份八五折</h5>
					<p>以便宜的价格，最优质的质量，你值得拥有</p>
				</div>   
			</div>
			<div class="offers-wthreerow2">
				<div class="add-products-row">
					<div class="w3ls-add-grids">
						<a href="/home/menu"> 
							<h4>下单立减 <span>10元<br>优惠</span></h4>
							<h5>便宜，美味，快速优质服务</h5>
							<h6>赶快点击这里 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>
						</a>
					</div>
					<div class="w3ls-add-grids w3ls-add-grids-right">
						<a href="/home/menu"> 
							<h4>下单立减<span><br>15元</span></h4>
							<h5>仅此一天，路过不要错过</h5>
							<h6>赶快点击这里 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h6>
						</a>
					</div> 
					<div class="clearfix"> </div> 
				</div>  
			</div>
		</div>
	</div> 
 
@stop