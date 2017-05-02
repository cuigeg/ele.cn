@extends('home.layout.index')
@section('title','饿了么个人中心')
@section('con')
	<div class="products">	 
		<div class="container">
			<div class="col-md-9 product-w3ls-right"> 
				<div class="product-top">
					<h4>@yield('tou')</h4>
					<ul> 
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">分类<span class="caret"></span></a>
						</li>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">时间<span class="caret"></span></a> 
						</li>
					</ul> 
					<div class="clearfix"> </div>
				</div>
			
				<div class="products-row">
				
				@section('cc')
					<center>
					<form action="" method="post">
						<img src="/images/2.jpg"  width='300px'>
						<input type="file" name="pic">
						<button>提交</button>
					</form>
					</center>
				@show
				
				</div>
			</div>
			<div class="col-md-3 rsidebar">
				<div class="rsidebar-top">
					
					<div class="sidebar-row">
						<h4>个人中心</h4>
						<ul class="faq">
							<li class="item1"><a href="#">个人资料<span class="glyphicon glyphicon-menu-down"></span></a>
								<ul>
										<li class="subitem1"><a href="/personal/person3">完善个人资料</a></li>										
										<li class="subitem1"><a href="/personal/person4">个人资料</a></li>										
								</ul>
							</li>
							<li class="item1"><a href="#">修改密码<span class="glyphicon glyphicon-menu-down"></span></a>
								<ul>
									<li class="subitem1"><a href="/personal/person2">修改密码</a></li>	
								</ul>
							</li>
							<li class="item2"><a href="#">我的订单<span class="glyphicon glyphicon-menu-down"></span></a>
								<ul>
									<li class="subitem1"><a href="/personal/person6">未完成 </a></li>
									<li class="subitem1"><a href="/personal/person5">待评价</a></li>										
									<li class="subitem1"><a href="/personal/person8">已完成</a></li>
									<li class="subitem1"><a href="/personal/person7">历史订单</a></li>											
								</ul>
							</li>
						<!-- 	<li class="item3"><a href="#">我的钱包<span class="glyphicon glyphicon-menu-down"></span></a>
								<ul>
									<li class="subitem1"><a href="/personal/person">充值中心</a></li>										
									<li class="subitem1"><a href="/home/person">消费记录</a></li>										
									<li class="subitem1"><a href="/home/person">我的余额</a></li>										
								</ul>
							</li> -->
						</ul>
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
					
					<div class="sidebar-row">
						 
					</div>			 
				</div>
				<div class="related-row">
					<h4>猜你喜欢的食物</h4>
					<div class="galry-like">  
						<a href="#" data-toggle="modal" data-target="#myModal1"><img src="/images/s1.jpg" class="img-responsive" alt="img"></a>         
					</div>
				</div>
			</div>
			<div class="clearfix"> </div> 
		</div>
	</div>
@endsection