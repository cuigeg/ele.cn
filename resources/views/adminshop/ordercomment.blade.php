@extends('adminshop.layout.index')
@section('title','饿啦么商户后台管理')
@section('tit','饿啦么商户后台管理系统')
@section('con')
<div class="col-lg-9 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            查看所有订单评价
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length">
                <form action="/adminshop/orders" method='get' >
                <label>看 <select name="num" aria-controls="dataTables-example" class="form-control input-sm">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                </select> 条</label>
                </div>
                </div><div class="col-sm-6">
                <div id="dataTables-example_filter" class="dataTables_filter">
                <label>订单号:<input name="keyword" class="form-control input-sm" placeholder="" aria-controls="dataTables-example" type="search">
                    <button class="btn btn-primary">
                        搜索
                    </button>
                </label>
                </div>
                </div>
                
                </form>
                </div>
                <div class="row">
                <div class="col-sm-12">
                @foreach($res as $k=>$v)
                <table id="table" class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                    <thead>
                        <tr role="row">
                        <th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 175px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">订单号</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 203px;" aria-label="Browser: activate to sort column ascending">商家名称</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 150px;" aria-label="Engine version: activate to sort column ascending">数量</th>
                        <th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 108px;" aria-label="CSS grade: activate to sort column ascending">价格</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 108px;" aria-label="CSS grade: activate to sort column ascending">下单时间</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 108px;" aria-label="CSS grade: activate to sort column ascending">订单备注</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 108px;" aria-label="CSS grade: activate to sort column ascending">收货人</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 108px;" aria-label="CSS grade: activate to sort column ascending">收货号码</th>
                        <th tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 108px;" aria-label="CSS grade: activate to sort column ascending">收货地址</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($aa[$k] as $kk=>$vv)
                    <tr class="gradeA odd" role="row">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td>{{$vv->foodname}}</td>
                            <td class="center">{{$vv->counts}}</td>
                            <td class="center">{{$vv->price*$vv->counts}}</td>
                            <td class="center">{{date('Y-m-d H:i:s',$v->date)}}</td>
                            <td class="center">{{$v->comment}}</td>
                            <td class="center">{{$v->shname}}</td>
                            <td class="center">{{$v->shphone}}</td>
                            <td class="center">{{$v->shaddress}}</td>
                        </tr>
                        @endforeach
                    <tr>
                        <td colspan='9'><div style="color:blue;"><img src="{{$data[$k]->pic}}" width="20px">  {{$data[$k]->nikename ? $data[$k]->nikename : $data[$k]->phone}}的评论</div></td>                  
                    </tr>
                     
                    <tr>
                        <td colspan='2'><div>{{date('Y-m-d H:i:s',$data[$k]->date)}}</div></td>
                        <td colspan='7'><div>{{$data[$k]->comment}}</div></td>
                    </tr>
                    @if($v->state == 4)
                        @foreach($ff[$k] as $a=>$b)
                        <tr>
                            <td colspan='9'><div style="color:blue;"><img src="{{$b->pic}}" width="20px">  {{$b->nikename ? $b->nikename : $b->phone}}的回复</div></td>                  
                        </tr>
                         
                        <tr>
                            <td colspan='2'><div>{{date('Y-m-d H:i:s',$b->date)}}</div></td>
                            <td colspan='7'><div>{{$b->reply}}</div></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
                @endforeach
                  <div class="row">
                      <div class="col-sm-5"></div>
                      <div class="col-sm-4">
                            {!! $res->appends($all)->render() !!}
                      </div>
                  </div>    
                        </div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
@stop()
@section('js')
<script type="text/javascript">
    $('.pl').click(function(){

      $(this).parents('tr').siblings('.comment').show();
    })
</script>
@endsection

