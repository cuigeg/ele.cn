@extends('adminshop.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
<div class="row">
    <div class='col-xs-3'></div>
    <div class='col-xs-9 '>
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
                    <form action="/adminshop/foodrecyle" method='get' >
                    <input type="hidden" name="id" value="{{Session::get('foodid')}}"> 
                    <div class="row"><div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length">
                        <label>看 <select name="num" aria-controls="dataTables-example" class="form-control input-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        </select>条</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>菜名:<input name='keyword' value="{{ isset($keyword)?$keyword:'' }}" class="form-control input-sm" placeholder="" aria-controls="dataTables-example" type="search"></label>
                        <button class="btn btn-primary">
                            搜索
                        </button>
                    </div>
                </div>
                </form>
            </div>
             <table class="table table-border table-bordered table-bg">
         <thead>
            <tr>
                <th colspan="7" scope="col">信息统计</th>
            </tr>
            <tr class="text-c">
                <th>菜品名称</th>
                <th>菜品价格</th>
                <th>菜品销售</th>
                <th>菜品信息</th>
                <th>菜品图片</th>
                <th>所属类别</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @if($res)
                    @foreach($res as $k=>$v)
                    <tr class="gradeA odd" role="row">
                            <td class="sorting_1">{{$v->foodname}}</td>
                            <td>{{$v->price}}</td>
                            <td>{{$v->count}}</td>
                            <td class="center">{{$v->info}}</td>
                            <td class="center"><img src="{{$v->pic}}" height="50px" alt='用户未提交图片'/></td>
                            <td class="center">{{$v->title}}</td>
                            <td class="center">
                                <a href='/adminshop/shopdel?id={{$v->id}}'>删除</a> |
                            @if($v->sta==0)
                                <a href="/adminshop/shopxia?id={{$v->id}}" >菜品充足</a>
                            @else
                                <a href="/adminshop/shopshang?id={{$v->id}}" >缺货</a>
                            @endif
                            </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">暂时没有数据</td>
                    </tr>
                    @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-4">
            {!!$res->appends($all)->render()!!}
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $(function(){
         setTimeout(function(){
            $('#success').slideUp();
        },2000)
    })
    </script>

@endsection
@stop


