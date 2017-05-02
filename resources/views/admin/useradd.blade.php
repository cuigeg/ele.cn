@extends('admin.layout.index')
@section('title','饿啦么用户管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')

<div class='row'>
	<div class='col-lg-6 col-lg-offset-3'> 
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
        <form role="form" method="post" action="/admin/userinsert">
                    <div class="form-group">
                        <label>手机</label>
                        <input class="form-control" name='phone' type="number" value="{{old('name')}}">
                    </div>
            		<div class="form-group">
                        <label>密码</label>
                        <input class="form-control" name='password'  type="password" value="{{old('password')}}">
                    </div>
            		<div class="form-group">
                        <label>权限</label>
                         <select class="form-control" name="author">
                           <option value="3">管理员</option>
                           <option value="2">商家</option>
                           <option value="1">用户</option>
                       </select>
                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-info">添加</button>

                </form>
        </div>
     </div>
 </div>
@stop()
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