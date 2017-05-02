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
        <form role="form" method='post' action="/admin/entsec" enctype='multipart/form-data'>
            <div class="form-group">
                <label>网站名称</label>
                @if(isset($res->title))
                <input name='title' class="form-control" value="{{$res->title}}">
                @else
                <input name='title' class="form-control" value="">
                @endif
            </div>
            <div class="form-group">
                @if(isset($res->pic))
                <label>网站图标<img src="{{$res->pic}}" alt="" width="100px" ></label>
                @else
                <label>网站图标<img src="" alt="网站图标" width="100px" ></label>
                @endif
                <input type="file" name="pic">
            </div> 
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">提交</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
    </div>
@stop()