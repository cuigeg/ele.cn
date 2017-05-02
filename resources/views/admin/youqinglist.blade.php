@extends('admin.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
<div class="row">
    <div class='col-md-2'></div>
    <div class='col-md-10'>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                   <form action="/admin/youqinglist"> 
                    <div class="row">
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
                    <div class="col-sm-4 col-sm-offset-2">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>看 <select name="num" aria-controls="dataTables-example" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>条</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>名称:<input name='keyword' class="form-control input-sm" placeholder="" aria-controls="dataTables-example" type="search"></label>
                        <button  class="btn btn-primary">搜索</button>
                    </div>
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                    <thead>
                        <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 205.2px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">id</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 248.2px;" aria-label="Browser: activate to sort column ascending">链接名称</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 248.2px;" aria-label="Browser: activate to sort column ascending">链接地址</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 248.2px;" aria-label="Browser: activate to sort column ascending">链接所属公司</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($res as $k=>$v)
                    <tr class="gradeA odd" role="row">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td>{{$v->yname}}</td>
                            <td>{{$v->content}}</td>
                            <td>{{$v->company}}</td>
                            <td class="center">
                            <a href="/admin/youqingdel?id={{$v->id}}">删除</a> | <a href="/admin/youqingup?id={{$v->id}}">修改</a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                </div>
                   <div class="row">
                     <div class="col-md-3 col-md-offset-4"></div>
                   
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