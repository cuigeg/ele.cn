@extends('/home/person')
@section('tou','头像修改')
@section('cc')
	<div class="widget-box"><br><br>
	<center>
			@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
		<div class="widget-header">
			<h4>完善个人信息</h4>
		</div><br><br>
		
		<div class="widget-body">
			<div class="widget-main no-padding">
				<form action="/personal/addperson3" method="post" enctype='multipart/form-data'>
					<!-- <legend>Form</legend> -->
					<fieldset>
						<label>姓名</label>
						<input name='nikename' style='width:300px' type="text" value=" {{@$res->nikename}}"><br><br>
					</fieldset>
					<fieldset>
						<label>手机</label>
						<input name="phone" style='width:300px' type="text" value=" {{@$res->phone}}"><br><br>
					</fieldset>
					<fieldset>
						<label>地址</label>
						<input name="position" style='width:300px' type="text" value=" {{@$res->position}}"><br><br>
					</fieldset>
					<fieldset>
						<label>email</label>
						<input name='email' style='width:300px' type="text" value=" {{@$res->email}}"><br><br>
					</fieldset>
					<fieldset>
						<img src="{{@$res->pic}}" width="100px" alt="头像"><br><br>
						<input  type="file" name="pic">
					</fieldset>
					{{ csrf_field() }}
					<div class="form-actions center">
						<button class="btn btn-sm btn-success">
							提交
							<i class="icon-arrow-right icon-on-right bigger-110"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
		</center>
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