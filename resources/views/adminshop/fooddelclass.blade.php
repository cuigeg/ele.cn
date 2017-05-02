@extends('adminshop.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
<div class="row">
<div class="col-lg-2"></div>

<div class="col-lg-10">
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
  <div class="panel panel-default">
        <div class="panel-heading">
            所有菜品分类
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>分类ID</th>
                            <th>菜品分类</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    @foreach($res as $k=>$v)
                    <tbody>
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->title}}</td>
                            <td><a href="/adminshop/foodclassdelete?id={{$v->id}}">删除</a> | <a href="/adminshop/foodclassupdate?id={{$v->id}}">修改</a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>
</div>
@endsection
@section('jd')
<script type="text/javascript">
    $(function(){
         setTimeout(function(){
            $('#success').slideUp();
        },2000)
    })
    </script>

@endsection