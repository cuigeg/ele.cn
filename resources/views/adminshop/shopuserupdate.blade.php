@extends('adminshop.layout.index')
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
        <form role="form" method='post' action="/adminshop/shopuserupdate?id={{ Session::get('id')}}" enctype='multipart/form-data'>
            <div class="form-group">
                <label>店主名称</label>
                <input name='nikename' class="form-control" value="{{$res->nikename}}">
            </div>
            <div class="form-group">
                <label>邮箱</label>
                <input name='email' class="form-control" value="{{$res->email}}">
            </div>
            <div class="form-group">
                <label>手机号</label>
                <input name='phone' class="form-control" value="{{$res->phone}}">
            </div>
            <div class="form-group">
                <label>个人头像<img src="{{$res->pic}}" alt="" width="100px" ></label>
               
                <input type="file" name="pic">
            </div> 
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">提交</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
    </div>
@stop()