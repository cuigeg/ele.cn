@extends('adminshop.layout.index')
@section('title','饿啦么商户后台管理')
@section('tit','饿啦么商户后台管理系统')
@section('con')
<div class="col-lg-3"></div>
<div class="col-lg-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            回复订单评论
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
                    @if($v->state == 3)
                    <tr>
                        <td colspan='9'><div style="color:blue;">{{$data[$k]->nikename ? $data[$k]->nikename : $data[$k]->phone}}的评论</div></td> 
                    </tr>
                     
                    <tr>
                        <td colspan='2'><div>{{date('Y-m-d H:i:s',$data[$k]->date)}}</div></td>
                        <td colspan='7'><div>{{$data[$k]->comment}}</div></td>
                    </tr>
                      <!-- 评论  1为未点开 2为展开 -->
                      <tr>
                          <td colspan='9'><button style='float:right;background-color: blue;width:100px;height:40px;border-radius:8px;' class="pl" class="btn btn-primary">评论</button></td>
                     </tr>
                     <tr class='comment' style="display:none;">
                          <td colspan='9'>
                            <form action="/adminshop/reply" method="post">
                              <div class="row" style="margin-top:15px;">
                                <div class='reply'  style="background-color: #f6f6f6;margin:10px,10px;border-radius:8px;">
                                  <div style="float:left" class="col-md-10">
                                    <textarea  class="SFLogin form-control mono reply_commit" name="reply" rows="1" cols="105" ></textarea>
                                  </div>
                                  <div style="float:left" class="col-md-2">
                                    <input type="hidden" name="rid" value="{{$v->id}}">
                                    @foreach($aa[$k] as $kk=>$vv)  
                                    <input type="hidden" name="sid" value="{{$vv->sid}}">
                                    <input type="hidden" name="cid" value="{{$vv->cid}}">
                                    @endforeach
                                    {{csrf_field()}}
                                    <button class="btn btn-default postComment commit_reply"  style="margin-top:8px;margin-bottom:12px;color: #333;background-color: green;border-color: #adadad;">
                                    回复</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </td>
                        </tr>
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

