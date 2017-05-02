@extends('admin.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
<div class="row">
    <div class='col-md-2'></div>
    <div class='col-md-10'>
        <div class="panel-body">
            @if(session('success'))
                <div id='success' class='alert alert-success alert-dismissable'>
                    {{session('success')}}               
                </div>
             @endif
            @if(session('error'))
                <div id='success' class='alert alert-success alert-dismissable'>
                    {{session('error')}}

                </div>
             @endif
            <div class="dataTable_wrapper">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <form action="/admin/shoplist" method='get' >
                    <div class="row"><div class="col-sm-6">
                        <div class="dataTables_length" id="dataTables-example_length">
                            <label>显示 <select name="num" aria-controls="dataTables-example" class="form-control input-sm"><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option></select>条</label>
                        </div>
                </div>
                {{ csrf_field() }}
                <div class="col-sm-6">
                    <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>商铺名称:<input name='keyword' class="form-control input-sm" placeholder="" aria-controls="dataTables-example" type="search"> <button class="btn btn-primary">搜索</button></label>
                    </div>
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 205.2px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 248.2px;" aria-label="Browser: activate to sort column ascending">商店名称</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227.2px;" aria-label="Platform(s): activate to sort column ascending">商店地址</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">商店介绍</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">商店图片</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($res)
                    @foreach($res as $k=>$v)
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1" >{{$v->id}}</td>
                            <td class="sorting_1">{{$v->shopname}}</td>
                            <td>{{$v->address}}</td>
                            <td class="center">{{$v->info}}</td>
                            <td class="center"><img src="{{$v->pic}}" width="100px" height="100px"></td>
                            <td class="center">
                                <a  href='/admin/shopdel?id={{$v->id}}'>下线 </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='/admin/shopupdate?id={{$v->id}}'>修改</a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='/admin/shopfood?id={{$v->id}}'>查看菜品</a> 
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1">暂时没有商铺信息</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-4">
                     {!!$res->appends($all)->render()!!}
                </div>
            </div>
        </div>
            </div>
            <!-- /.table-responsive -->
            
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="text/javascript">
    $(function(){
        
        // $('#success').text('删除成功').show(1000);
         setTimeout(function(){
            $('#success').slideUp();
        },1000)
    })
    </script>
 @endsection