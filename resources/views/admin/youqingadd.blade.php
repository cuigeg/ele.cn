@extends('admin.layout.index')
@section('title','饿啦么商户后台管理')
@section('tit','饿啦么后台管理系统')
@section('con')
    <!-- 定义错误信息 -->
    @if(count($errors)>0)
        <div class='alert alert-danger'>
            <ul>
                @foreach($errors->all() as $v)
                    <li>{{$v}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-6 col-lg-offset-3">
        <form role="form" method='post' action="/admin/youqingadd" enctype='multipart/form-data'>
            <div class="form-group">
                <label>友情链接名称</label>
                <input name='yname' class="form-control" value="">
            </div>
            <div class="form-group">
                <label>友情链接的链接</label>
               
                <input name='content' class="form-control" value="">
            </div> 
            <div class="form-group">
                <label>友情链接所属公司</label>
               
                <input name='company' class="form-control" value="">
            </div> 
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">提交</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
    </div>
@stop()