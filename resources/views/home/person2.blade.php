@extends('/home/person')
@section('tou','密码修改')
@section('cc')
	<div class='col-lg-8'>
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
        <form role="form" method="post" action="/personal/password">
            <div class="form-group" style="margin-top:20px;">
                <label>账号</label>
                <input name='phone' class="form-control" value="{{old('phone')}}"><span style="display:none"></span>  
            </div>
            <div class="form-group">
                <label>原密码</label>
                <input name='oldpassword' type="password" class="form-control" value="{{old('oldpassword')}}" placeholder="请输入原密码"><span style="display:none"></span>  
            </div>
            <div class="form-group">
                <label>新密码</label>
                <input name='newpassword' type="password" class="form-control" value="{{old('newpassword')}}" placeholder="请输入新密码"><span style="display:none"></span>  
            </div>
            <div class="form-group">
                <label>确认密码</label>
                <input name="truepassword" type="password" class="form-control" value="{{old('truepassword')}}" placeholder="请确认密码"><span style="display:none"></span>  
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn">提交</button>
            <button type="reset" class="btn">重置</button>
        </form>
       </div>
       <!--  -->
@endsection
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