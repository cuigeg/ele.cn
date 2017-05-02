@extends('admin.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
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
        <form role="form" method='post' action='/admin/shopedit?id={{$res->id}}' enctype='multipart/form-data'>
            <div class="form-group">
                <label>商店名称</label>
                <input name='shopname' class="form-control" value="{{$res->shopname}}">
            </div>
            <div class="form-group">
                <label>商店地址</label>
                <input name='address' class="form-control" value="{{$res->address}}">
            </div>

            <div class="form-group">
                <label>商店介绍</label>
                <textarea name='info' class="form-control" rows="3">{{$res->info}}</textarea>
            </div>
            <div class="form-group">
                <label>商店图片</label>
                <input type="file" name='pic'>
                <div><img src="{{$res->pic}}" width="100px"></div>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">提交</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
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