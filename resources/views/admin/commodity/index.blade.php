@extends('layouts.admin.base')
@section('content')
<style type="text/css">
    .overHidden {
        word-break:keep-all;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading row">
                    <div class="col-sm-6">
                        <h4>秒杀商品列表</h4>
                    </div>
                </div>
                <div class="panel-body">
                    {{-- <div class="row">
                        <form id="search_form" method="get" action="{{ route('admin.system.counsel_list.searchCounsel') }}">
                                {{Form::token()}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">咨询标题:</span>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="title" class="form-control" value="{{$selOption['title']}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">咨询内容:</span>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="description" class="form-control" value="{{$selOption['description']}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">咨询人姓名:</span>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="user_name" class="form-control"
                                            value="{{$selOption['user_name']}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">处理人姓名:</span>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="admin_name" class="form-control"
                                            value="{{$selOption['user_name']}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-15">


                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">咨询时间:</span>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" id="datepicker1" name="form_time" class="form-control"
                                            value="{{$selOption['form_time']}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">至</span>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" id="datepicker2" name="to_time" class="form-control"
                                            value="{{$selOption['to_time']}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="col-md-4 m-t-5">
                                            <span style="font-weight:bold;font-size:16px;">分页条目:</span>
                                        </div>
                                        <div class="col-md-7">
                                            <select name="number" class="form-control">
                                                <option value="10" {{$selOption['number'] == '10'?'selected':''}}>10</option>
                                                <option value="50" {{$selOption['number'] == '50'?'selected':''}}>50</option>
                                                <option value="100" {{$selOption['number'] == '100'?'selected':''}}>100</option>
                                                <option value="150" {{$selOption['number'] == '150'?'selected':''}}>150</option>
                                                <option value="200" {{$selOption['number'] == '200'?'selected':''}}>200</option>
                                                <option value="500" {{$selOption['number'] == '500'?'selected':''}}>500</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 p-l-20 m-top-bottom-5">
                                        <button type="button" class="btn btn-info w-lg" onclick="searchForm()">搜索</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered m-t-15">
                                    <thead>
                                        <tr>
                                            <th>序</th>
                                            <th>商品标题</th>
                                            <th>商品原价(￥)</th>
                                            <th>商品秒杀价(￥)</th>
                                            <th>物流费(￥)</th> 
                                            <th>商品销量</th>
                                            <th>商品始发地</th>
                                            <th>上架情况</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($data->count())
                                        @foreach($data as $v)
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td style="max-width: 200px;" class="overHidden">{{$v->title}}</td>
                                                <td>{{$v->original_price}}</td>
                                                <td>{{$v->present_price}}</td>
                                                <td>{{$v->express_price}}</td>
                                                <td>{{$v->sale_amounts}}</td>
                                                <td>{{$v->location}}</td>
                                                <td>
                                                    @if($v->is_shelves == 1)
                                                    <span style="color:#5bc0de;">上架中</span>
                                                    @else
                                                    未上架
                                                    @endif
                                                </td>
                                                <td>{{$v->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editCommodity()">编辑</button>
                                                </td>
                                            </tr>
                                        @endforeach()
                                    @else
                                        <td colspan="8" style="text-align: center;">@暂无数据</td>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="datatable_info" role="status"
                                         aria-live="polite">显示 {{ $data->firstItem() }} 到 {{ $data->lastItem() }} 共 {{ $data->total() }} 条
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                        {!! $data->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 编辑模态框 --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">商品编辑预览</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <span>商品标题：</span>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" style="min-height:70px !important;"></textarea>
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <span>商品原价：</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="original_price" class="form-control">
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <span>秒杀价：</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="present_price" class="form-control">
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <span>物流费：</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="express_price" class="form-control">
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <span>商品销量：</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="sale_amounts" class="form-control">
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <span>始发地：</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="location" class="form-control">
                        </div>
                    </div>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <span>上架情况：</span>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="is_shelves">
                                <option value="">请选择上架情况</option>
                                <option value="0">未上架</option>
                                <option value="1">上架中</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info">保存</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
<script type="text/javascript">
    function editCommodity() {
        $('#editModal').modal('show');
    }
</script>
@endsection