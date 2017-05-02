@extends('admin.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">店铺管理</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <!-- 点击 -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">配送中</a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">已送达</a>
                    </li>
                    <li><a href="#messages" data-toggle="tab">未配送</a>
                    </li>
                    <li><a href="#settings" data-toggle="tab">未接单</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                    <div class="panel-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>订单号</th>
                                    <th>商家名称</th>
                                    <th>商品名称</th>
                                    <th>收货人</th>
                                    <th>收货号码</th>
                                    <th>收货地址</th>
                                    <th>下单时间</th>>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $k=>$v)
                                    <tr>
                                        <td>{{$v->id}}</td>
                                        <td>{{$v->shopname}}</td>
                                        <td>{{$v->foodname}} x {{$v->count}} | ${{$v->pic}}</td>
                                        <td>{{$v->nikename}}</td>
                                        <td>{{$v->phone}}</td>
                                        <td>{{$v->position}}</td>
                                        <td>{{$v->date}}</td>
                                        <td><a href="">删除</a></td>
                                    </tr>
                             @endforeach   
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>


                    </div>
                    <!--  -->
                    <div class="tab-pane fade" id="profile">
                        <div class="panel-body">
                             <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>收货人</th>
                                        <th>收货地址</th>
                                        <th>商家名称</th>
                                        <th>价格</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        </div>


                    </div>
                    <!--  -->

                </div>
@stop()

