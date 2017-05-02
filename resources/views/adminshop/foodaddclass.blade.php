@extends('adminshop.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
	<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">                 	
                <div class="col-lg-6 col-lg-offset-3">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form role="form" method="post" action="/adminshop/addclass">
                        <div class="form-group">
                            <label>查看分类</label>
                            <select class="form-control" name="pid">
                                <option value="0">菜品分类</option>
                                @foreach($res as $k => $v)
                                <option value="{{$v->id}}">{{$v->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>分类名</label>
                            <input class="form-control" type="text" name="title" value="" required>
                        </div>
                        {{ csrf_field() }}
                        <button class="btn btn-default" type="submit">添加</button>
                        <button class="btn btn-default" type="reset">重置</button>
                    </form>
                </div>
             
            </div>
            <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
@endsection
@section('js')
    <script type="text/javascript">
    $(function(){       
        // $('#success').text('删除成功').show(1000);
         setTimeout(function(){
            $('.alert-danger').slideUp();
        },1000)
    })
    </script>
 @endsection