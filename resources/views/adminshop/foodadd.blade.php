@extends('adminshop.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
    <div class=" col-sm-6 col-lg-offset-3">
        <form role="form" method='post' enctype='multipart/form-data' action='/adminshop/foodinsert'>      
            <div class="form-group">
                <label>选择分类</label>
                <select class="form-control" name="lei">
                @if($res)
                @foreach($res as $k=>$v)
                    <option value="{{$v->id}}" required>{{$v->title}}</option>
                @endforeach
                @else
                    <option>暂无分类</option>
                @endif
                </select>
            </div>
            <div class="form-group">
                <label>菜品名称</label>
                <input class="form-control" name='foodname' required>
            </div>
            <div class="form-group">
                <label>菜品价格</label>
                <input class="form-control" placeholder="" name='price' required>
            </div>
            <div class="form-group">
                <label>菜品信息</label>
                <textarea class="form-control" rows="3" name="info" required></textarea>
            </div>
            <div class="form-group">
                <label>菜品图片</label>
                <input type="file" name='pic'>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">提交</button>
            <button type="reset" class="btn btn-default">重置</button>
        </form>
    </div>
@stop()