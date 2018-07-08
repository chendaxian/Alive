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
    .w-e-text-container{height: 180px!important;}
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading row">
                    <div class="col-sm-6">
                        <h4>{{$activity->name}}活动参与商品列表</h4>
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
                                            <th>商品名称</th>
                                            <th>商品价格(￥)</th>
                                            <th>物流费用(￥)</th>
                                            <th>销量</th>
                                            <th>发货地点</th>
                                            <th>图片</th>
                                            <th>排名</th>
                                            <th>加入时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($commodities->count())
                                        @foreach($commodities as $index=>$v)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td style="max-width: 150px;" class="overHidden">{{$v->commodityDetail->name}}</td>
                                                <td>{{$v->commodityDetail->price}}</td>
                                                <td>{{$v->commodityDetail->express_price}}</td>
                                                <td>{{$v->commodityDetail->sale_amounts}}</td>
                                                <td>{{$v->commodityDetail->location}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="showImg('{{$v->commodityDetail->img}}')">查看</button>
                                                </td>
                                                <td>{{$v->rank}}</td>
                                                <td>{{$v->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editRank({{$v->id}}, {{$v->rank}})">修改排名</button>
                                                    <button class="btn btn-danger" onclick="deleteCommodity('{{ route('deleteActivityCommodities', ['id' => $v->id]) }}')">移除商品</button>
                                                </td>
                                            </tr>
                                        @endforeach()
                                    @else
                                        <td colspan="5" style="text-align: center;">@暂无数据</td>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="datatable_info" role="status"
                                         aria-live="polite">显示 {{ $commodities->firstItem() }} 到 {{ $commodities->lastItem() }} 共 {{ $commodities->total() }} 条
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                        {!! $commodities->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/wangEditor.min.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function showImg(url) {
        var html = "<img src='"+url+"'>";;
        $.confirm({
            title: '商品图片预览',
            theme: 'supervan',
            content: html,
            buttons: {
                OK: {
                    btnClass: 'btn-primary',
                },
            }
        });
    }

    function deleteCommodity(url) {
        $.confirm({
            title: '提示',
            content: '确定从该活动中移除此商品吗？',
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

    function editRank(id, oldRank) {
        $.confirm({
            title: '商品排名',
            content: '' +
                '<div class="form-group">' +
                '<input type="text" value="'+oldRank+'" placeholder="请输入该商品在活动中的排名" class="rank form-control" required />' +
                '</div>' ,
            buttons: {
                formSubmit: {
                    text: '提交',
                    btnClass: 'btn-blue',
                    action: function () {
                        var newRank = this.$content.find('.rank').val();

                        $.ajax({
                            url: "{{ route('updateActivityCommodities') }}",
                            type:"post",  
                            dataType:"json",
                            data: {
                                id: id,
                                oldRank: oldRank,
                                rank: newRank,
                            },
                            success: function(data){
                                $.confirm({
                                    title: '提示',
                                    content: '排名修改成功！',
                                    buttons: {
                                        OK: {
                                            btnClass: 'btn-primary',
                                            action: function () {
                                                window.location.reload();
                                            }
                                        },
                                    }
                                });
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
                },
                cancel: {
                    text: '取消',
                },
            },
            onContentReady: function () {
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click');
                });
            }
        });
    }
</script>
@endsection