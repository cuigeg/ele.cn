@extends('/home/person')
@section('tou','未完成订单')
@section('cc')
<div class="panel-body">
        <div class="dataTable_wrapper">
            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
             <form action="/personal/person6" method='get' >
              <div class="row">
                <div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length">
                  <label>查看 
                    <select name="num" aria-controls="dataTables-example" class="form-control input-sm">
                      <option value="10">5</option>
                      <option value="25">10</option>
                      <option value="50">15</option>
                      <option value="100">20</option>
                      </select> 条
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="dataTables-example_filter" class="dataTables_filter">
                    <label>订单号:<input class="form-control input-sm" name="keyword" placeholder="" aria-controls="dataTables-example" type="search">
                      <button class="btn btn-primary" type="submit">搜索</button>
                    </label>
                  </div>
                </div>
              </div>
              </form>
            <div class="row">
                <div class="col-sm-12">
            @if($res)
             @foreach($res as $k=>$v) 
            <table style="margin-top:20px" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                 <thead>
                 	<tr	role="row">
                 		<td>下单时间：</td>
                    <td colspan="2">{{date('Y-m-d H:i:s',$v->date)}}</td>
                    <td>订单号：</td>
                    <td colspan="3">{{$v->id}}</td>
                 	</tr>
                    <tr role="row">
                    	<th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 292px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">菜品图片</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 335px;" aria-label="Browser: activate to sort column ascending">菜品名称</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 335px;" aria-label="Browser: activate to sort column ascending">菜品份数</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 306px;" aria-label="Platform(s): activate to sort column ascending">订单备注</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 188px;" aria-label="CSS grade: activate to sort column ascending">菜品价格</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 188px;" aria-label="CSS grade: activate to sort column ascending">支付方式</th>
                    	<th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 188px;" aria-label="CSS grade: activate to sort column ascending">订单状态</th>
                    </tr>
				</thead>
                @foreach($aa[$k] as $kk=>$vv)  
                <tr class="gradeA odd" role="row">
                        <td class="sorting_1"><img src="{{$vv->pic}}" width="100px"></td>
                        <td>{{$vv->foodname}}</td>
                        <td>{{$vv->counts}}</td>
                        <td>{{$v->comment}}</td>
                        <td id="vvid" style="display:none">{{$v->id}}</td>
                        <td class="center">{{$vv->price*$vv->counts}}</td>
                        <td class="center">{{$v->zf==1?'支付宝':'微信'}}</td>
                        <td class="center">{{$v->state==0?'已完成':($v->state==1?'派送中':'未接单')}}</td>
                    </tr>
                 @endforeach
                 @if($v->state==1)
                 <tr>
                   <td colspan='7'><button style='float:right' class="btn ore btn-primary">确认收货</button></td>
                 </tr>
                 @endif
                 @if($v->state ==2)
                 <tr>
                   <td colspan='7'><button style='float:right' class="btn btn-primary">催单</button></td>
                 </tr>
                 @endif
            </table><br>
              @endforeach
              @else
               <table style="margin-top:20px" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
	               <tr role="row">
	               		<td colspan="8" align="center">暂无订单信息</td>
	               </tr>
               </table><br>
			 @endif
            </div>
            	</div>
            		<div class="row">
            			<div class="col-sm-6">
            				<div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite"></div>
            			</div>
            			<div class="col-sm-6">
            				<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
            					{!!$res->appends($all)->render()!!}
            				</div>
            			</div>
            		</div>
            	</div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    $('.ore').click(function(){
     var id = $(this).parents('tr').siblings('.gradeA').find('#vvid').html();
     var a = $(this); 

     $.get('/personal/jorder',{id:id},function(data){
        if(data==1){
           // a.parents('#table').remove();
           location = location;
        }
               
     })
    })
</script>

@endsection