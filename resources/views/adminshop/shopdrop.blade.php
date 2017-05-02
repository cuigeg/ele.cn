@extends('adminshop.layout.index')
@section('title','饿啦么商户后台管理')
@section('tit','饿啦么后台管理系统')
@section('con')
<div class="row">
    <div class='col-md-2'></div>
    <div class='col-md-10'>
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row"><div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length">
                        <label>看 <select name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>条</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="dataTables-example_filter" class="dataTables_filter">
                        <label>名字:<input class="form-control input-sm" placeholder="" aria-controls="dataTables-example" type="search"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
                    <thead>
                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 205.2px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 248.2px;" aria-label="Browser: activate to sort column ascending">Browser</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 227.2px;" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 178.2px;" aria-label="Engine version: activate to sort column ascending">Engine version</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134px;" aria-label="CSS grade: activate to sort column ascending">CSS grade</th></tr>
                    </thead>
                    <tbody>
                    <tr class="gradeA odd" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 1.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td class="center">1.7</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 1.5</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td class="center">1.8</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA odd" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 2.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td class="center">1.8</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Firefox 3.0</td>
                            <td>Win 2k+ / OSX.3+</td>
                            <td class="center">1.9</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA odd" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Camino 1.0</td>
                            <td>OSX.2+</td>
                            <td class="center">1.8</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Camino 1.5</td>
                            <td>OSX.3+</td>
                            <td class="center">1.8</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA odd" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Netscape 7.2</td>
                            <td>Win 95+ / Mac OS 8.6-9.2</td>
                            <td class="center">1.7</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Netscape Browser 8</td>
                            <td>Win 98SE+</td>
                            <td class="center">1.7</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA odd" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Netscape Navigator 9</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td class="center">1.8</td>
                            <td class="center">A</td>
                        </tr><tr class="gradeA even" role="row">
                            <td class="sorting_1">Gecko</td>
                            <td>Mozilla 1.0</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td class="center">1</td>
                            <td class="center">A</td>
                        </tr></tbody>
                </table></div></div><div class="row"><div class="col-sm-6"><div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li><li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">3</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">4</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">5</a></li><li class="paginate_button " aria-controls="dataTables-example" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li></ul></div></div></div></div>
            </div>
            <!-- /.table-responsive -->
            
        </div>
    </div>
</div>

@stop()