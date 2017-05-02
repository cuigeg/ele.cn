@extends('/home/person')
@section('tou','头像修改')
@section('cc')
	<center>
		<form action="/personal/photo" method="post" enctype='multipart/form-data'>
			<img src="{{$photo}}"  width='300px'>
			<input type="file" name="pic">
			{{ csrf_field() }}
			<button>提交</button>
		</form>
	</center>
@endsection
