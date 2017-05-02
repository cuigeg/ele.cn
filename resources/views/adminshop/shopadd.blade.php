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
        <form role="form" method='post' action="/adminshop/shopupdate" enctype='multipart/form-data'>
            <input type="hidden" name="pic" value="{{$res->pic}}"> 
            <div class="form-group">
                <label>店铺名称</label>
                <input name='shopname' class="form-control" value="{{$res->shopname}}">
            </div>
            <div class="form-group">
                <label>店铺地址</label>
                <input name='address' class="form-control" value="{{$res->address}}">
            </div>
            <div class="form-group">
                <label>起送价</label>
                <input name='send' class="form-control" value="{{$res->send}}">
            </div>
            <div class="form-group">
                <label>配送费</label>
                <input name='give' class="form-control" value="{{$res->give}}">
            </div>
            <div class="form-group">
                <label>店铺公告</label>
                <textarea name='info' class="form-control" rows="3">{{$res->info}}</textarea>
            </div>
            <div class="form-group">
                <label>商店图片 <img src="{{$res->pic}}" alt="" width="100px" ></label>
               
                <input type="file" name="pic">
            </div> 
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">提交</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
    </div>
@stop()