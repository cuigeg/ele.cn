﻿@extends('home.layout.index')
@section('title','饿了么菜品')
@section('con')
		<link rel="stylesheet" type="text/css" href="/shopcart/css/style.css">
		<link rel="stylesheet" type="text/css" href="/shopcart/css/css.css" >

		<!--
        	作者：z@163.com
        	时间：2016-03-04
        	描述：商品内容
        -->
		<div class="shopping_content" style='margin-top:20px'>
			<div class="shopping_table">
				<table border="1" bordercolor="#cccccc" cellspacing="0" cellpadding="0" style="width: 100%; text-align: center;">
					<tr text-align='center'>
						<th>商品图片</th>
						<th>商品名称</th>
						<th>商品属性</th>
						<th>商品价格</th>
						<th>商品数量</th>
						<th>商品操作</th>
					</tr>
					@foreach($res as $k=>$v)
					<tr>
						@foreach($aa[$k] as $vv)
						<td>
							<a><img style="width: 100px;" src="{{$vv->pic}}" /></a>
							<span style='display:none'>{{$vv->id}}</span>
							<span id='shopsid' style='display:none'>{{$vv->sid}}</span>
						</td>
						@endforeach
						<td><span>{{$v[1]}}</span></td>
						@foreach($aa[$k] as $vv)
						<td>
							<span>{{$vv->info}}</span>
						</td>
						@endforeach
						<td>
							<span class="span_momey">{{$v[2]}}</span>
						</td>
						<td>
							<button class="btn_reduce" onclick="javascript:onclick_reduce(this);">-</button>
							<input class="momey_input"  type="text" name="number" id="number" value="{{$v[0]}}" disabled="disabled" />
							<button class="btn_add" onclick="javascript:onclick_btnAdd(this);">+</button>
						</td>
						<td>
							<button class="btn_r" onclick="javascript:onclick_remove(this);">删除</button>
						</td>
					</tr>
					@endforeach
				</table>
				<div class="" style="width: 100%; text-align: right; margin-top: 10px;">
					<div class="div_outMumey" style="float: left;">
						总价：<span class="out_momey">11</span>
					</div>
					<!-- <button class="btn_closing">支付</button> -->
					<button class="open_btn" onclick="javascript:onclick_pay();">支付</button>
				</div>
			</div>
		</div>
		<div class="Caddress" style='margin-top:20px'>
			<div class="open_new">
				<button class="open_btn" onclick="javascript:onclick_open();">使用新地址</button>
			</div>



                <div id='success' style='display:none' align='center' style="color:red" class='alert alert-success alert-dismissable'>
                </div>
			@if($position)
			@foreach($position as $k=>$v)
			<div class="add_mi">
				<div style="height:10px" class="shade_colse">
					<button onclick="onclick_delect(this)">x</button>
				</div>
				<p style="border-bottom:1px dashed #ccc;line-height:28px;">{{$v->shname}}</p>
				<p id='id' style="display:none">{{$v->id}}</p>
				<p>{{$v->shaddress}}<br>{{$v->shphone}}</p>
			</div>
			@endforeach
			@else
			<div class="add_mi">
				<p style="border-bottom:1px dashed #ccc;line-height:28px;">暂无收货地址，请添加</p>
				<p></p>
			</div>
			@endif
		</div>
		<!--
        	作者：z@163.com
        	时间：2016-03-01
        	描述：shade 遮罩层
        -->
		<div class="shade">
		</div>
		<!--
        	作者：z@163.com
        	时间：2016-03-02
        	描述：shade_content
        -->
		<div class="shade_content">
			<div class="col-xs-12 shade_colse">
				<button onclick="javascript:onclick_close();">x</button>
			</div>
			<div class="nav shade_content_div">
				<div class="col-xs-12 shade_title">
					新增收货地址
				</div>
				<div class="col-xs-12 shade_from">
					<form action="/order/address" method="post">
						<div class="col-xs-12">
							<span class="span_style span_sty" id="">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span>
							<input class="input_style input_btn" type="text" name="shname" id="name_" value="" placeholder="&nbsp;&nbsp;请输入您的姓名" />
						</div>
						<div class="col-xs-12">
							<span class="span_style" id="">手机号码</span>
							<input class="input_style input_btn" type="text" name="shphone" id="phone" value="" placeholder="&nbsp;&nbsp;请输入您的手机号码" />
						</div>
						<div class="col-xs-12">
							<span class="span_style" id="">详细地址</span>
							<input class="input_style input_btn" type="text" name="shaddress" id="address" value="" placeholder="&nbsp;&nbsp;请输入您的详细地址" />
						</div>
						{{ csrf_field() }}
						<div class="col-xs-12">
							<input class="btn_remove" type="button" id="" onclick="javascript:onclick_close();" value="取消" />
							<input type="submit" class="sub_set" id="sub_setID" value="提交" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--
        	作者：z@163.com
        	时间：2016-03-01
        	描述：shade 遮罩层
        -->
		<div class="pay">
		</div>
		<!--
        	作者：z@163.com
        	时间：2016-03-02
        	描述：shade_content
        -->
		<div class="pay_content">
			<div class="col-xs-12 shade_colse">
				<button onclick="javascript:onclick_close1();">x</button>
			</div>
			<div class="nav shade_content_div">
				<div class="col-xs-12 shade_title">
					确认支付
				</div>
				<div class="col-xs-12 shade_from">
					<form action="/order/oriders" method="post">
						<div class="col-xs-12">
							<div class="col-xs-12"><span class="span_style" id="">优惠方式</span></div>
							<div class="col-xs-12"><span class="span_style" id="">使用红包&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><input class="input_zf input_style" type="" name="" disabled=true id="address" value="" placeholder="&nbsp;&nbsp;暂无红包可用&nbsp;&nbsp;" /></div>
							<div class="col-xs-12"><span class="span_style" id="">使用优惠券</span><input class="input_zf input_style" type="" name="" id="address" value="" disabled=true placeholder="&nbsp;&nbsp;网页端不支持(仅手机用户使用)&nbsp;&nbsp;" /></div>
						</div>
						<div class="col-xs-12">
							<div class="col-xs-12"><span class="span_style" id="">其他信息</span></div>
							<div class="col-xs-12"><span class="span_style" id="">配送方式&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 本订单由 <a href="">[崔崔快送]</a> 提供配送</span></div>
							<div class="col-xs-12"><span class="span_style" id="">发票信息&nbsp;&nbsp;&nbsp;&nbsp;</span><input class="input_zf input_style" type="" name="" id="address" value="" disabled=true placeholder="&nbsp;&nbsp;&nbsp;&nbsp;未满20元，不能开发票&nbsp;&nbsp;" /></div>
							<div class="col-xs-12"><span class="span_style" id="">订单备注&nbsp;&nbsp;&nbsp;&nbsp;</span><input class="input_zf input_style" type="" name="comment" id="address" value="" placeholder="" /></div>
						</div>
						<div class="col-xs-12">
						<span class="span_style" id="" >支付方式</span>
						<input type="radio" name='zf' value="1" checked>
						<a href="#"><img src="{{asset('/shopcart/images/zhifubao.jpg')}}" height='50px'></a>
						<input type="radio" name='zf' value="2">
						<a href="#"><img src="{{asset('/shopcart/images/weixin.jpg')}}" height='100px'></a>
						</div>
						{{csrf_field()}}
						@foreach($res as $k=>$v)
						<input type="hidden" name="count{{$k}}" value="{{$v[0]}}" />
						@foreach($aa[$k] as $kk=>$vv)
						<input type="hidden" name="cid{{$k}}" value="{{$vv->id}}" />
						@endforeach
						@endforeach
						<input type="hidden" name="sid" id="sid" value="{{$vv->sid}}" />
						<input type="hidden" name="pid" class="pid" value="" />
						<input type="hidden" name="price" class="price" value="" />
						<div class="col-xs-12">
							<input class="btn_remove" type="button" id="" onclick="javascript:onclick_close1();" value="取消" />
							<input type="submit" class="sub_set" id="sub_setID1" value="提交" />
						</div>
					</form>
				</div>
			</div>
		</div>
@endsection
@section('js')
<script type="text/javascript">
			$(function() {
				var sid = $('#shopsid').html();
				$('#sid').val(sid);
				var region = $("#region");
				var address = $("#address");
				var number_this = $("#number_this");
				var name = $("#name_");
				var phone = $("#phone");
				$("#sub_setID1").click(function() {
					$('input').die();
					for (var i = 0; i <= input_out.length; i++) {
						if ($(input_out[i]).val() == "") {
							$(input_out[i]).css("border", "1px solid red");
							
							return false;
						} else {
							$(input_out[i]).css("border", "1px solid #cccccc");
						}
					}
				});
				$("#sub_setID").click(function() {
					var input_out = $(".input_btn");
					for (var i = 0; i <= input_out.length; i++) {
						if ($(input_out[i]).val() == "") {
							$(input_out[i]).css("border", "1px solid red");
							
							return false;
						} else {
							$(input_out[i]).css("border", "1px solid #cccccc");
						}
					}
				});
				var span_momey = $(".span_momey");
				var momey_input = $(".momey_input");
				var b = 0;
				for (var i = 0; i < span_momey.length; i++) {
					b += parseFloat($(span_momey[i]).html()*$(momey_input[i]).val());
				}
				var out_momey = $(".out_momey");
				out_momey.html(b);
				$('.price').val(b);
				$(".shade_content").hide();
				$(".shade").hide();
				$(".pay_content").hide();
				$(".pay").hide();
				$('.nav_mini ul li').hover(function() {
					$(this).find('.two_nav').show(100);
				}, function() {
					$(this).find('.two_nav').hide(100);
				})
				$('.left_nav').hover(function() {
					$(this).find('.nav_mini').show(100);
				}, function() {
					$(this).find('.nav_mini').hide(100);
				})
				$('#jia').click(function() {
					$('input[name=num]').val(parseInt($('input[name=num]').val()) + 1);
				})
				$('#jian').click(function() {
					$('input[name=num]').val(parseInt($('input[name=num]').val()) - 1);
				})
				$('.Caddress .add_mi').click(function() {
					$(this).css('background', 'url("/shopcart/images/mail_1.jpg") no-repeat').siblings('.add_mi').css('background', 'url("/shopcart/images/mail.jpg") no-repeat')
					var id = $(this).find('#id').html();
					$('.pid').val(id);
				})
			})
			var x = Array();

			function func(a, b) {
				x[b] = a.html();
				alert(x)
				a.css('border', '2px solid #f00').siblings('.min_mx').css('border', '2px solid #ccc');
			}

			function onclick_close() {
				var shade_content = $(".shade_content");
				var shade = $(".shade");
				if (confirm("确认删除么！此操作不可恢复")) {
					shade_content.hide();
					shade.hide();
				}
			}



			function onclick_delect(obj){
				var id = $(obj).parents('.add_mi').find('#id').html();
				var add_mi = $(obj).parents('.add_mi');
				add_mi.remove();
				$.get('/order/delete',{id:id},function(data){
					if(data==1){
						$('#success').show();
						setTimeout(function(){
							$('#success').hide(2000);
						},1000)
						$('#success').html('恭喜删除成功');
					}
				})

			}

			function onclick_close1() {
				var pay_content = $(".pay_content");
				var pay = $(".pay");
				if (confirm("确认要停止支付吗。。。。。。")) {
					pay_content.hide();
					pay.hide();
				}
			}	

			function onclick_open() {
				$(".shade_content").show();
				$(".shade").show();
				var input_out = $(".input_style");
				for (var i = 0; i <= input_out.length; i++) {
					if ($(input_out[i]).val() != "") {
						$(input_out[i]).val("");
					}
				}
			}
			function onclick_pay() {
				$(".pay_content").show();
				$(".pay").show();
				var input_out = $(".input_style");
				for (var i = 0; i <= input_out.length; i++) {
					if ($(input_out[i]).val() != "") {
						$(input_out[i]).val("");
					}
				}
			}

			function onclick_remove(r) {
				if (confirm("确认删除么！此操作不可恢复")) {
					var out_momey = $(".out_momey");
					var input_val = $(r).parent().prev().children().eq(1).val();
					var span_html = $(r).parent().prev().prev().children().html();
					var out_add = parseFloat(input_val).toFixed(2) * parseFloat(span_html).toFixed(2);
					var reduce = parseFloat(out_momey.html()).toFixed(2)- parseFloat(out_add).toFixed(2);
					out_momey.text(parseFloat(reduce).toFixed(2));
					$(r).parent().parent().remove();
				}
			}

			function onclick_remove(r) {
				if (confirm("确认要停止支付吗。。。。。。")) {
					var out_momey = $(".out_momey");
					var input_val = $(r).parent().prev().children().eq(1).val();
					var span_html = $(r).parent().prev().prev().children().html();
					var out_add = parseFloat(input_val).toFixed(2) * parseFloat(span_html).toFixed(2);
					var reduce = parseFloat(out_momey.html()).toFixed(2)- parseFloat(out_add).toFixed(2);
					out_momey.text(parseFloat(reduce).toFixed(2));
					$(r).parent().parent().remove();
				}
			}

			function onclick_btnAdd(a) {
				var out_momey = $(".out_momey");
				var input_ = $(a).prev();
				var input_val = $(a).prev().val();
				var input_add = parseInt(input_val) + 1;
				input_.val(input_add);
				var btn_momey = parseFloat($(a).parent().prev().children().html());
				var out_momey_float = parseFloat(out_momey.html()) + btn_momey;
				out_momey.text(out_momey_float.toFixed(2));
			}

			function onclick_reduce(b) {
				var out_momey = $(".out_momey");
				var input_ = $(b).next();
				var input_val = $(b).next().val();
				if (input_val <= 1) {
					alert("商品个数不能小于1！")
				} else {
					var input_add = parseInt(input_val) - 1;
					input_.val(input_add);
					var btn_momey = parseFloat($(b).parent().prev().children().html());
					var out_momey_float = parseFloat(out_momey.html()) - btn_momey;
					out_momey.text(out_momey_float.toFixed(2));
				}
			}
		</script>
	@endsection