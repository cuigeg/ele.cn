@extends('home.layout.index')
@section('title','饿了么官网')
@section('search')
	<div class="container">
		<h2>请您挥手敲下<br> <span>您尊贵的订餐地址</span></h2>
			<div class="agileits_search">
				<form action="{{url('/shop/menu')}}" method="get"  >
					<input name="Search" class="seach_input"  style="width:535px" type="text" placeholder="在这里输入您的地址" value="" required="">
					{{ csrf_field() }}
					<!-- <input type="submit"  style="width:200px" value="搜索" class='search'> -->
					<button style="width:200px;height:52px;background:#ff0000;">搜索</button>
				</form>
			</div> 
	</div>
@stop
@section('js')
	<script type="text/javascript">
		$("input[type='text']").on("keyup",function(){
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    var res = $('.seach_input').val();

		    if(res != ''){
			    $.post('/home/seach',{res:res},function(data){
			    		for (var i = 0; i < data.length; i++) {
			    		var div = $('<input name="Search'+i+'" class="seach_input"  onclick="clickMe(this)"  style="width:535px; cursor:pointer;" type="text" placeholder="在这里输入您的地址" value="'+data[i]+'" required="">');              // 以 HTML 创建新元素
						div.insertAfter('input[name="Search"]');
			    		};
			    	});		
		    	}
		    });
		$("input[type='text']").keydown(function(){

			$(this).siblings('input').remove();

		})
	 

		function clickMe(object){

	 	  $(object).siblings('input').remove();
	 	  $(object).attr("name","Search");
	 	  $(object).removeAttr("onclick");

	 	}

	</script>
@endsection