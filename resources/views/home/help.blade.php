@extends('home.layout.index')
@section('title','饿了么帮助')
@section('con')
  

<div class="container">	
		<ol class="breadcrumb w3l-crumbs">
			<li><a href="/home/menu"><i class="fa fa-home"></i> 主页</a></li> 
			<li class="active">帮助</li>
		</ol>
	</div>
	<!-- //breadcrumb -->
	<!-- help-page -->
	<div class="help about">
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1">常见问题</h3>  
			<div class="faq-w3agile"> 
				<h5>在线支付问题</h5> 
				<ul class="faq">
					<li class="item1"><a href="#" title="click here">：在线支付取消订单后钱怎么返还？</a>
						<ul>
							<li class="subitem1"><p>订单取消后，款项会在一个工作日内，直接返还到您的美团账户余额。 </p></li>										
						</ul>
					</li>
					<li class="item2"><a href="#" title="click here">：美团账户里的余额怎么提现？</a>
						<ul>
							<li class="subitem1"><p>余额可到美团网（meituan.com）——“我的美团→美团余额”里提取到您的银行卡或者支付宝账号，另外，余额也可直接用于支付外卖订单（限支持在线支付的商家）。</p></li>										
						</ul>
					</li>
					<li class="item3"><a href="#" title="click here">：怎么查看退款是否成功？</a>
						<ul>
							<li class="subitem1"><p>退款会在一个工作日之内到美团账户余额，可在“账号管理——我的账号”中查看是否到账.</p></li>										
						</ul>
					</li>
					<li class="item4"><a href="#" title="click here">：余额提现到账时间是多久？</a>
						<ul>
							<li class="subitem1"><p>1-7个工作日内可退回您的支付账户。由于银行处理可能有延迟，具体以账户的到账时间为准。</p></li>										
						</ul>
					</li> 
					<li class="item5"><a href="#" title="click here">：申请退款后，商家拒绝了怎么办？</a>
						<ul>
							<li class="subitem1"><p>申请退款后，如果商家拒绝，此时回到订单页面点击“退款申诉”，美团客服介入处理。 </p></li>										
						</ul>
					</li>
					<li class="item6"><a href="#" title="click here">：怎么取消退款呢？</a>
						<ul>
							<li class="subitem1"><p>请在订单页点击“不退款了”，商家还会正常送餐的。 </p></li>										
						</ul>
					</li>
					<li class="item7"><a href="#" title="click here">：前面下了一个在线支付的单子，由于未付款，订单自动取消了，这单会计算我的参与活动次数吗？</a>
						<ul>
							<li class="subitem1"><p>不会。如果是未支付的在线支付订单，可以先将订单取消（如果不取消需要15分钟后系统自动取消），订单无效后，此时您再下单仍会享受活动的优惠。 </p></li>										
						</ul>
					</li>
					<li class="item8"><a href="#" title="click here">：为什么我用微信订餐，却无法使用在线支付？</a>
						<ul>
							<li class="subitem1"><p>目前只有网页版和美团外卖手机App(非美团手机客户端)订餐，才能使用在线支付，请更换到网页版和美团外卖手机App下单。 </p></li>										
						</ul>
					</li>
					<li class="item9"><a href="#" title="click here">：如何进行付款？</a>
						<ul>
							<li class="subitem1"><p>美团外卖现在支持货到付款与在线支付，其中微信版与手机触屏版暂不支持在线支付。 </p></li>										
						</ul>
					</li>
					<li class="item10"><a href="#" title="click here">：如何查看可以在线支付的商家？</a>
						<ul>
							<li class="subitem1"><p>你可以在商家列表页寻找带有“付”标识的商家，提交订单时可以选择支付方式。 </p></li>										
						</ul>
					</li> 
				</ul>
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
			<div class="help-search">
				<h5>你可以在这里留下你的联系方式，我们会联系你</h5>
				<form action="#" method="post">
					<input type="search" name="Search" placeholder="请留下你的联系方式" required="">
					<button type="submit" class="btn btn-default" aria-label="Left Align">
						提交
					</button>
				</form>
			</div> 
		</div>
	</div>
	<!-- //help-page -->  

@stop  