@extends('home.layout.index')
@section('title','饿了么店铺')
@section('con')	
<div style=""></div>		
  <div class="wthree-menu"  style="height:auto">
		<div class="container" style=" background: url(/images/i2.jpg) 0px 20px  no-repeat">
			<h3 class="w3ls-title">附近店鋪</h3>
			<p class="w3lsorder-text">Near the shop</p>
			<div class="menu-agileinfo">  
			@foreach($datas as $k=>$v)
				<div class="col-md-4 col-sm-4 col-xs-6 menu-w3lsgrids"> 
					<a href="/shop/products?sid={{$v->id}}"  style='background: rgb(255, 233, 232);'>
					<img src="{{$v->pic}}" class="w3order-img" alt="{{$v->shopname}}" height="70px" />
						<div class="rstblock-content">
							<div class="rstblock-title" style='font-size:15px'>{{$v->shopname}}</div>
							<div class="starrating icon-star">
								<span class="icon-star" style="width:88%;"></span>
							</div>
							<span class="rstblock-monthsales" style='font-size:10px'>月售{{$v->count}}份</span>
							<div class="rstblock-activity">
								<i style="background:red;">首</i>
								<i style="background:red;">免</i>
								<i style="background:red;">准</i>
							</div>
						</div>
					</a>
				</div> 
			@endforeach 
				<div class="clearfix">
				</div>
				{!! $datas->appends($all)->render() !!}
			</div> 
			
		</div>
	</div>
@endsection