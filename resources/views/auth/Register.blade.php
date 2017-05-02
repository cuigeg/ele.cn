<!DOCTYPE html>
<html>
<head>
<title>饿啦么注册页面</title>
<meta name="keywords" content="饿啦么,订餐,外卖" />
<meta name="description" content="全职订餐就选饿啦么" />
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<link href="/css/home.css?v=2" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.7.2.js"></script>
</head>
<body>
<div class="wrap" >
  <div class="banner-show" id="js_ban_content" >
    <div class="cell bns-01">
      <div class="con" style='height:1500px'> </div>
    </div>
    <div class="cell bns-02" style="display:none;">
      <div class="con" style='height:1500px'> <a href="#" target="_blank" class="banner-link"> <i>圈子</i></a> </div>
    </div>
    <div class="cell bns-03" style="display:none;">
      <div class="con" style='height:1500px'> <a href="#" target="_blank" class="banner-link"> <i>企业云</i></a> </div>
    </div>
  </div>
  <div class="banner-control" id="js_ban_button_bo  x"> <a href="javascript:;" class="left">左</a> <a href="javascript:;" class="right">右</a> </div>
  <script type="text/javascript">
                (function(){
                    
                    var defaultInd = 0;
                    var list = $('#js_ban_content').children();
                    var count = 0;
                    var change = function(newInd, callback){
                        if(count) return;
                        count = 2;
                        $(list[defaultInd]).fadeOut(400, function(){
                            count--;
                            if(count <= 0){
                                if(start.timer) window.clearTimeout(start.timer);
                                callback && callback();
                            }
                        });
                        $(list[newInd]).fadeIn(400, function(){
                            defaultInd = newInd;
                            count--;
                            if(count <= 0){
                                if(start.timer) window.clearTimeout(start.timer);
                                callback && callback();
                            }
                        });
                    }
                    
                    var next = function(callback){
                        var newInd = defaultInd + 1;
                        if(newInd >= list.length){
                            newInd = 0;
                        }
                        change(newInd, callback);
                    }
                    
                    var start = function(){
                        if(start.timer) window.clearTimeout(start.timer);
                        start.timer = window.setTimeout(function(){
                            next(function(){
                                start();
                            });
                        }, 8000);
                    }
                    
                    start();

                    $('#js_ban_button_box').on('click', 'a', function(){
                        var btn = $(this);
                        if(btn.hasClass('right')){
                            //next
                            next(function(){
                                start();
                            });
                        }
                        else{
                            //prev
                            var newInd = defaultInd - 1;
                            if(newInd < 0){
                                newInd = list.length - 1;
                            }
                            change(newInd, function(){
                                start();
                            });
                        }
                        return false;
                    }); 
             })();
             
     
            </script>
  <div class="container">
  <form id="form" action="/auth/reg" method="post">
    <div class="register-box" style='margin-top:170px;'>
      <div class="reg-slogan"> 新用户注册</div>
      @if(session('error'))
                <div id='success' align='center' style="color:red" class='alert alert-success alert-dismissable'>
                    {{session('error')}}

                </div>
        @endif
      <div class="reg-form" id="js-form-mobile"> <br>
        <br>
        <div class="cell">
          <label for="js-mobile_ipt"></label>
          <input type="text" name="phone" id="phone" class="text" maxlength="11" placeholder="填写手机号" value="{{old('phone')}}" />
        </div>
        <div class="cell">
          <label for="js-mobile_pwd_ipt"></label>
          <input type="password" name="password" id="js-mobile_pwd_ipt" class="text" placeholder="设置密码" value="{{old('password')}}"/>
          <b class="icon-form ifm-view js-view-pwd" title="查看密码" style="display: none"> 查看密码</b> </div>
        <!-- !短信验证码 -->
        <div class="cell vcode">
          <label for="js-mobile_vcode_ipt"></label>
        <input class="form-control" type="text" id='code' name="code" placeholder="验证码" required="" value="{{old('code')}}"> 
        <button class="button" id="submit" type='button'>免费获取验证码</button></div><input id='yzm' style="display:none" value='验证码不正确'>
       
        <center><button id='btn' class="button">立即注册</button></center><br><br><br><br>
         <div class="bottom"> <a href='/auth/login' class="button " style="background-color: pink;" id="js-mobile_btn" ><div class='fa-long-arrow-right'></div> 去登录</a></div>
      </div>
      {{csrf_field()}}
    </div>
  </form>
  </div>
</div>
</body>
</html>
<script type="text/javascript">


        $(function () {               
            $("#submit").click(function () {
              var phone = $("#phone").val();
               $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              $.post("/auth/log",{id:phone},function(data){
                  });
                settime(this);
            });
            $('#btn').click(function(){
              var code = $('#code').val();
              alert(data);
              if(code!=data){
                      $('#yzm').show(1000);
                      return false;
                }
            })

            var countdown = 60;


            function settime(obj) {
                if (countdown == 0) {
                    obj.removeAttribute("disabled");
                    obj.innerHTML = "获取验证码";
                    countdown = 60;
                    return;
                } else {
                    obj.setAttribute("disabled", true);
                    obj.innerHTML = " " + countdown + "秒后再获取";
                    countdown--;
                }
                setTimeout(function () {
                    settime(obj)
                }, 1000)
            }
        });
        $(function(){
        
         // $('#success').text('删除成功').show(1000);
           setTimeout(function(){
            $('#success').slideUp();
             },1000)
         })
    </script> 