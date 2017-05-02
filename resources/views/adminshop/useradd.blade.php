@extends('adminshop.layout.index')
@section('title','饿啦么用户管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')

<div class='row'>
	<div class='col-lg-6 col-lg-offset-3'> 
	<div class="panel-body">
        <form role="form">
                    <div class="form-group">
                        <label>账号</label>
                        <input class="form-control" name='name' type="text" value="">
                    </div>
            		<div class="form-group">
                        <label>密码</label>
                        <input class="form-control" name='password'  type="password" value="">
                    </div>
            		<div class="form-group">
                        <label>邮箱</label>
                        <input class="form-control" name='email'  type="email" value="">
                    </div>
            		<div class="form-group">
                        <label>手机</label>
                        <input class="form-control" name='phone'  type="number" value="">
                    </div>
                    <button type="submit" class="btn btn-info">添加</button>

                </form>
        </div>
     </div>
 </div>
@stop()