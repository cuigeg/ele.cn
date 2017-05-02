@extends('admin.layout.index')
@section('title','饿啦么用户管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台用户修改')
@section('con')
<div class='row'>
	<div class='col-lg-6 col-lg-offset-3'> 
	<div class="panel-body">
        <form role="form"  action="/admin/useredit?id={{$users->id}}"  method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>昵称</label>
                        <input class="form-control" name='nikename' type="text" value="{{$users->nikename}}">
                    </div>
                    <div class="form-group">
                        <label>地址</label>
                        <input class="form-control" name='position'  type="text" value="{{$users->position}}">
                    </div>
                    <div class="form-group">
                        <label>邮箱</label>
                        <input class="form-control" name='email'  type="email" value="{{$users->email}}">
                    </div>
                    <div class="form-group">
                        <label>头像<img src="{{$users->pic}}" width="100px"></label>
                        <input name='pic'  type="file" value="">
                        
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info">修改</button>
                </form>
        </div>
     </div>
 </div>
@stop()