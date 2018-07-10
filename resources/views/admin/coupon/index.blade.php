@extends('layouts.admin.base')
@section('content')
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
<style type="text/css">
    .alignRight {
        text-align: right;
    }
    .panel-body label {
        padding-top: 5px;
    }
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
                        <h4>优惠券列表</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered m-t-15">
                                    <thead>
                                        <tr>
                                            <th>序</th>
                                            <th>优惠券介绍</th>
                                            <th>优惠券类型</th>
                                            <th>满减限制金额(￥)</th>
                                            <th>优惠额度(￥)</th>
                                            <th>截止时间</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($data->count())
                                        @foreach($data as $v)
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td style="max-width: 200px;" class="overHidden">{{$v->description}}</td>
                                                <td>
                                                    @if($v->type == 1)
                                                    满减类型
                                                    @else
                                                    无门槛使用类型
                                                    @endif
                                                </td>
                                                <td>{{$v->limit_money}}</td>
                                                <td>{{$v->preferential_amount}}</td>
                                                <td>{{$v->dead_line}}</td>
                                                <td>{{$v->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editCoupon('{{$v->id}}', '{{$v->description}}', '{{$v->type}}', '{{$v->limit_money}}', '{{$v->preferential_amount}}', '{{$v->dead_line}}')">编辑</button>
                                                    <button class="btn btn-danger" onclick="deleteCoupon('{{ route('couponDelete', ['id' => $v->id]) }}')">删除</button>
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
                    <h4 class="modal-title">优惠券信息预览修改</h4>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post" action="{{ route('couponUpdate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3 text-right m-t-5">
                                <label>优惠券信息:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" id="hiddenId" name="hiddenId">
                                <input class="form-control" id="description" name="description">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <label>优惠券类型:</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="type" name="type">
                                    <option value="1">满减类型</option>
                                    <option value="2">无门槛使用类型</option>
                                </select>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <label>满减限制金额(￥):</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" id="limit_money" name="limit_money">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <label>优惠额度(￥):</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" id="preferential_amount" name="preferential_amount">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <label>截止日期:</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" id="dead_line" name="dead_line">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info" onclick="submitForm()">保存</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteCoupon(url) {
        $.confirm({
            title: '提示',
            content: '确定删除该条数据吗？',
            buttons: {   
                ok: {
                    text: "确定",
                    btnClass: 'btn-primary',
                    action: function(){
                         location.href = url;
                    }
                },
                cancel: {
                    text: "取消", 
                } 
            }
        });
    }

    function editCoupon(id, description, type, limit_money, preferential_amount, dead_line) {
        $('#hiddenId').val(id);
        var array = ['description', 'type', 'limit_money', 'preferential_amount', 'dead_line'];
        for(var i = 0; i < array.length; i++) {
            $('#'+array[i]).val(eval(array[i]));
        }
        $('#editModal').modal('show');
    }

    function submitForm() {
        $.ajax({
            url: "{{ route('couponCheck') }}",
            type:"post",  
            dataType:"json",
            data: {
                id: $('#hiddenId').val()
            },  
            success: function(data){
                if (data.res) {
                    $('#updateForm').submit();
                } else {
                    $.confirm({
                        title: '提示',
                        content: '该优惠券已经发放，无法改动！',
                        buttons: {
                            OK: {
                                btnClass: 'btn-primary',
                            },
                        }
                    });
                }
            },
            error: function(msg) {
                $.confirm({
                    title: '提示',
                    content: '服务器错误请稍后再试！',
                    buttons: {
                        OK: {
                            btnClass: 'btn-primary',
                        },
                    }
                });
            },

        })
    }
</script>
@endsection