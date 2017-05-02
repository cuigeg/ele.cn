@extends('adminshop.layout.index')
@section('title','饿啦么后台管理')
@section('tit','饿啦么后台管理系统')
@section('tits','饿啦么后台管中心')
@section('con')
<div class="row">
    <div class='col-md-2'></div>
    <div class='col-md-10'>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 205.2px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 248.2px;" aria-label="Browser: activate to sort column ascending">商店名称</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227.2px;" aria-label="Platform(s): activate to sort column ascending">商店地址</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 178.2px;" aria-label="Engine version: activate to sort column ascending">商店订单量</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">商店介绍</th>
                            <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">商店图片</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($res)
                    @foreach($res as $k=>$v)
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td class="sorting_1">{{$v->shopname}}</td>
                            <td>{{$v->address}}</td>
                            <td>{{$v->count}}</td>
                            <td class="center">{{$v->info}}</td>
                            <td class="center"><img width="130px" src="{{$v->pic}}" alt=""></td>
                        </tr>
                    @endforeach
                    @else
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1">暂时没有商铺信息</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
                </div>
            </div>

        </div>
            </div>
            <!-- /.table-responsive -->
            
        </div>
    </div>
</div>
@stop