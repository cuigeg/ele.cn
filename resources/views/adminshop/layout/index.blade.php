
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="../admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../admin/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="index.html">@yield('tit')</a>



            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa  fa-fw">{{ Session::get('name') }}</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/adminshop/shopuser?id={{Session::get('id')}}"><i class="fa fa-user fa-fw"></i>修改信息</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/adminshop/out?id={{Session::get('id')}}"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <img src="/upload/1.png" width="230px" height="50px" alt="" >
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/adminshop/index"><i class="fa fa-dashboard fa-fw"></i>首页</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>订单管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/adminshop/today">配送中</a>
                                </li>
                                <li>
                                    <a href="/adminshop/orders">已送达</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                         <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>菜品管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/adminshop/foodadd">菜品添加</a>
                                </li>
                                <li>
                                    <a href="/adminshop/foodclass">添加分类</a>
                                </li>
                                <li>
                                    <a href="/adminshop/foodclassdel">删除分类</a>
                                </li>            
                                <li>
                                    <a href="/adminshop/foodlist">菜品列表</a>
                                </li>
                                <li>
                                    <a href="/adminshop/foodrecyle">回收站</a>
                                </li>
                            </ul>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>商家管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/adminshop/shopadd">店铺修改</a>
                                </li>   
                                <li>
                                    <a href="/adminshop/shoplist">信息</a>
                                </li>   

                            </ul>

                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>订单评价<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/adminshop/ordercomment">查看评价</a>
                                </li>   
                                <li>
                                    <a href="/adminshop/orderreply">回复评价</a>
                                </li>   

                            </ul>

                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        @section('con')
		<!-- 点击 -->
        @show()            
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../admin/bower_components/raphael/raphael-min.js"></script>
	 <script src="../admin/bower_components/morrisjs/morris.min.js"></script>
   	<!-- // <script src="../admin/js/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
   

    <script src="../admin/dist/js/sb-admin-2.js"></script>
    
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });</script>
    @section('js')
    @show()
    @section('jd')
    @show()
</body>
</html>