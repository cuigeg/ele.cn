<!DOCTYPE html>
<html >
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>chinaz</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="/mod/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/mod/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->


</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="/mod/img/logo-invoice.png" />
            </div>
        </div>
         <div class="row ">
               
                <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           @if(count($errors)>0)
                               <div class='alert alert-danger'>
                                   <ul>
                                       @foreach($errors->all() as $v)
                                           <li>{{$v}}</li>
                                       @endforeach
                                   </ul>
                               </div>
                           @endif
                           <div class="col-lg-6 col-lg-offset-1">
                               <form role="form" method='post' action="/adminshop/shopest" enctype='multipart/form-data'>
                                    
                                    <input type="hidden" name="uid" value="{{ Session::get('sid')}}">    
                                <div class="form-group">
                                       <label>店铺名称</label>
                                       <input name='shopname' class="form-control" >
                                   </div>
                                   <div class="form-group">
                                       <label>店铺地址</label>
                                       <input name='address' class="form-control" >
                                   </div>
                                   <div class="form-group">
                                       <label>起送价</label>
                                       <input name='send' class="form-control" >
                                   </div>
                                   <div class="form-group">
                                       <label>配送费</label>
                                       <input name='give' class="form-control" >
                                   </div>
                                   <div class="form-group">
                                       <label>店铺公告</label>
                                       <textarea name='info' class="form-control" rows="3" ></textarea>
                                   </div>
                                   <div class="form-group">
                                       <label>商店图片 <img src="" alt="" width="100px" ></label>
                                      
                                       <input type="file" name='pic'>
                                   </div>
                                   {{csrf_field()}}
                                   <button type="submit" class="btn btn-default">提交</button>
                                   <button type="reset" class="btn btn-default">重置</button>
                               </form>
                           </div>
                
        </div>
    </div>

</body>
</html>
