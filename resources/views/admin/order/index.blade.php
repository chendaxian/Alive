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
                        <h4>订单列表</h4>
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
                                            <th>订单编号</th>
                                            <th>收货信息</th>
                                            <th>商品支付信息</th>
                                            <th>订单状态</th>
                                            <th>支付状态</th>
                                            <th>下单时间</th>
                                            <th>操作员工</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($data->count())
                                        @foreach($data as $index=>$v)
                                            <tr>
                                                <td>{{$v->index+1}}</td>
                                                <td>{{$v->order_number}}</td>
                                                <td>
                                                    <span style="color:#1ca8dd;cursor: pointer;" onclick="showReceiverInfo('{{$v->id}}', '{{$v->express_number}}', '{{$v->reveiver_name}}', '{{$v->reveiver_number}}', '{{$v->reveiver_address}}')">收货信息</span>
                                                </td>
                                                <td>
                                                    <span style="color:#1ca8dd;cursor: pointer;" onclick="showCommodityInfo('{{$v->total_price}}', '{{$v->commodity_price}}', '{{$v->express_price}}', '{{$v->preferential_price}}', '{{$v->pay_amount}}','{{$v->payed_at}}', '{{$v->pay_status}}', '{{$v->remark}}', 
                                                        '{{$v->commodities}}')">商品信息</span>
                                                </td>
                                                <td>
                                                    @if($v->order_status == 0)
                                                    已取消
                                                    @elseif($v->order_status == 1)
                                                    待发货
                                                    @elseif($v->order_status == 4)
                                                    客户待收货
                                                    @else
                                                    已完成
                                                    @endif()
                                                </td>
                                                <td>
                                                    @if($v->pay_status == 1)
                                                    未支付
                                                    @else
                                                    已支付
                                                    @endif()
                                                </td>
                                                <td>{{$v->created_at}}</td>
                                                <td>{{$v->staff->name}}</td>
                                                <td>
                                                      <button class="btn btn-info" onclick="setDelivery({{$v->id}})">设置发货</button>
                                                </td>
                                            </tr>
                                        @endforeach()
                                    @else
                                        <td colspan="9" style="text-align: center;">@暂无数据</td>
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

    {{-- 收货信息模态框 --}}
    <div class="modal fade" id="receiverInfo" commdityId="" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">收货信息预览编辑</h4>
                </div>
                <div class="modal-body">
                    <form id="updateReceiverInfo" method="post" action="{{ route('updateReceiverInfo') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3 text-right m-t-5">
                                <span>物流单号:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" name="hiddenId" id="receiverHiddenId">
                                <input class="form-control" id="express_number" name="express_number">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <span>收货人姓名:</span>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" id="reveiver_name" name="reveiver_name">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <span>收货人电话:</span>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" id="reveiver_number" name="reveiver_number">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3 text-right m-t-5">
                                <span>收货地址:</span>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" id="reveiver_address" name="reveiver_address">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info" onclick="submitForm('updateReceiverInfo')">保存</button>
                </div>
            </div>
        </div>
    </div>

    {{-- 商品信息模态框 --}}
    <div class="modal fade" id="commodityInfo" commdityId="" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">商品信息预览</h4>
                </div>
                <div class="modal-body">
                    <div class="commoditiesDetail" style="border-bottom:2px solid #e5e5e5;">
                    </div>

                    <div class="row m-t-10">
                        <div class="col-md-2">
                            <label>运费</label>
                        </div>

                        <div class="col-md-offset-1 col-md-3">
                            <label id="express_price"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label>商品总价</label>
                        </div>

                        <div class="col-md-offset-1 col-md-3">
                            <label id="commodity_price"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label>订单总价</label>
                        </div>

                        <div class="col-md-offset-1 col-md-3">
                            <label id="total_price"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label>优惠减免</label>
                        </div>

                        <div class="col-md-offset-1 col-md-3">
                            <label id="preferential_price"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label>实际支付</label>
                        </div>

                        <div class="col-md-offset-1 col-md-3">
                            <label style="color:red;font-size: 18px;" id="pay_amount">暂未支付</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label>支付时间</label>
                        </div>

                        <div class="col-md-9">
                            <label id="payed_at">暂无</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label>客户备注</label>
                        </div>

                        <div class="col-md-9">
                            <label id="remark"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">关闭</button>
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

    function showReceiverInfo(id, express_number, reveiver_name, reveiver_number, reveiver_address) {
        $('#receiverHiddenId').val(id);
        var array = ['express_number', 'reveiver_name', 'reveiver_number', 'reveiver_address'];
        for(var i = 0; i < array.length; i++) {
            $('#'+array[i]).val(eval(array[i]));
        }
        $('#receiverInfo').modal('show');
    }

    function showCommodityInfo(total_price, commodity_price, express_price, preferential_price, pay_amount, payed_at, pay_status, remark, commodities) {
        var array = ['total_price', 'commodity_price', 'express_price'];
        if (pay_amount) {
            array.push('pay_amount');
        }
        for(var i = 0; i < array.length; i++) {
            $('#'+array[i]).html('￥'+eval(array[i]));
        }
        $('#payed_at').html(payed_at);
        $('#remark').html(remark);
        $('#preferential_price').html('-￥'+preferential_price);

        //遍历商品信息
        var commodities = JSON.parse(commodities);
        var html = '';
        for (var i = 0; i < commodities.length; i++) {
            html += '<div class="row" style="padding-bottom: 10px;">'+
                            '<div class="col-md-3">'+
                                '<img src="'+commodities[i].img+'" width="90px" height="80px">'+
                            '</div>'+

                            '<div class="col-md-9">'+
                                '<div class="row">'+
                                    '<div class="col-md-3">'+
                                        '<label>商品名称</label>'+
                                    '</div>'+

                                    '<div class="col-md-9">'+
                                        '<label>'+commodities[i].name+'</label>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-md-3">'+
                                        '<label>商品价格</label>'+
                                    '</div>'+

                                    '<div class="col-md-9">'+
                                        '<label>￥'+commodities[i].price+'</label>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-md-3">'+
                                        '<label>购买数量</label>'+
                                    '</div>'+

                                    '<div class="col-md-9">'+
                                        '<label>x '+commodities[i].buy_amount+'</label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
        }
        $('.commoditiesDetail').html('');
        $('.commoditiesDetail').append(html);
        $('#commodityInfo').modal('show');
    }

    function submitForm(type) {
        $.confirm({
            title: '提示',
            content: '是否确定修改收件人信息？',
            buttons: {   
                ok: {
                    text: "确定",
                    btnClass: 'btn-primary',
                    action: function(){
                        $('#'+type).submit();
                    }
                },
                cancel: {
                    text: "取消", 
                } 
            }
        });
    }

    function setDelivery(id) {
        $.confirm({
            title: '设置发货',
            content: '' +
                '<div class="form-group">' +
                '<input type="text" placeholder="请输入该订单的物流单号" class="express_number form-control" required />' +
                '</div>' ,
            buttons: {
                formSubmit: {
                    text: '提交',
                    btnClass: 'btn-blue',
                    action: function () {
                        var express_number = this.$content.find('.express_number').val();
                        if(!express_number){
                            $.alert('请填写该订单的物流单号，否则无法设置发货！');
                            return false;
                        }

                        $.ajax({
                            url: "{{ route('setDelivery') }}",
                            type:"post",  
                            dataType:"json",
                            data: {
                                id: id,
                                express_number: express_number,
                            },
                            success: function(data){
                                $.confirm({
                                    title: '提示',
                                    content: '发货成功！',
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