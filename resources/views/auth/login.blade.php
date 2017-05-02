﻿<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>饿了么</title>
		    <meta name="keywords" content="饿啦么" />
		    <meta name="description" content="世界一流订餐" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/css/reset.css">
        <link rel="stylesheet" href="../assets/css/supersized.css">
        <link rel="stylesheet" href="../assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>
        <div class="page-container">        
            <h1>登录</h1>       
            <form action="/auth/dologin" method="post">
             <div style="padding-right:20px;background: rgba(0, 0, 0, 0.5)">
                <input type="text" name="username" class="username" placeholder="手机号码">
                <input type="password" name="password" class="password" placeholder="密码">
                <button type="submit">提交</button>
                <div class="error"><span>+</span></div>
                {{csrf_field()}}
            </form>
            <div class="connect">
                <p>第三方登录：</p><a href="/auth/register"><div style="width:200px;margin-left:-80px;">还没账号？——>注册</div></a>
                <p>
                    <a class="facebook" href="" style="background: url(../assets/img/facebook.png) center center no-repeat"></a>
                    <a class="twitter" href="" style="background: url(../assets/img/twitter.png) center center no-repeat"></a>
                </p>
            </div>
            </div>
        </div>
		
        <!-- Javascript -->
        <script src="../assets/js/jquery-1.8.2.min.js"></script>
        <script src="../assets/js/supersized.3.2.7.min.js"></script>
        <script src="../assets/js/supersized-init.js"></script>
        <script src="../assets/js/scripts.js"></script>

    </body>

</html>