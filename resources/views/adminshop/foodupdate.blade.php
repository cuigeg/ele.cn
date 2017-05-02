@extends('adminshop.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
    <div class="col-lg-6 col-lg-offset-3">
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
        <form role="form" method='post' enctype='multipart/form-data' 
        action='/adminshop/foodupdate'>     
             <div class="form-group">
                <label>选择分类</label>
                <select class="form-control" name='lei'>
                @if($cate)
                @foreach($cate as $k=>$v)
                        <option value="{{$v->id}}" >{{$v->title}}</option>
                @endforeach
                @else
                     <option>暂无分类</option>
                @endif
                 </select>
             </div>           
            <div class="form-group">
                <label>菜品名称</label>
                <input class="form-control" name='foodname' value="{{$res->foodname}}">
            </div>
            <div class="form-group">
                <label>菜品价格</label>
                <input class="form-control" placeholder="" name='price' value="{{$res->price}}">
            </div>
            <div class="form-group">
                <label>菜品信息</label>
                <textarea class="form-control" rows="3" name='info'>{{$res->info}}</textarea>
            </div>
            <img src="{{ $res->pic }}" width="300px" alt='用户未提交图片'/>
            <input type='hidden' name='pic' value='{{$res->pic}}'/>
            <input type='hidden' name='id' value='{{$res->id}}'/>
            <div class="form-group">
                <label>菜品图片</label>
                <input type="file" name='pic' class="pic">
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">修改</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
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
@stop()