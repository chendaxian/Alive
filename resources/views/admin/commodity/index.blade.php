@extends('layouts.admin.base')
@section('content')
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
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
                        <h4>商品列表</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="search_form" method="get" action="{{ route('commoditySearch') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">商品名称:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="name" class="form-control" value="{{$selOption['name']?$selOption['name']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">商品始发地:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="location" class="form-control" value="{{$selOption['location']?$selOption['location']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">物流价格:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="form_express_price" class="form-control"
                                        value="{{$selOption['form_express_price']?$selOption['form_express_price']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">至</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="to_express_price" class="form-control"
                                        value="{{$selOption['to_express_price']?$selOption['to_express_price']:''}}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-t-15">
                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">商品售价:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="form_price" class="form-control"
                                        value="{{$selOption['form_price']?$selOption['form_price']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">至</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="to_price" class="form-control"
                                        value="{{$selOption['to_price']?$selOption['to_price']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">分页条目:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="number" class="form-control">
                                            <option value="10" {{$selOption['number'] == 10 ?'selected':''}}>10</option>
                                            <option value="50" {{$selOption['number'] == 50 ?'selected':''}}>50</option>
                                            <option value="100" {{$selOption['number'] == 100 ?'selected':''}}>100</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">上架情况:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="is_shelves" class="form-control">
                                            <option value="2" {{$selOption['is_shelves'] == 2 ?'selected':''}}>请选择上架情况</option>
                                            <option value="1" {{$selOption['is_shelves'] == 1 ?'selected':''}}>已上架</option>
                                            <option value="0" {{$selOption['is_shelves'] == 0 ?'selected':''}}>未上架</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-t-15">
                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">创建时间:</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" id="datepicker1" name="form_time" class="form-control"
                                        value="{{$selOption['form_time']?$selOption['form_time']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="col-md-4 m-t-5">
                                        <span style="font-weight:bold;font-size:16px;">至</span>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" id="datepicker2" name="to_time" class="form-control"
                                        value="{{$selOption['to_time']?$selOption['to_time']:''}}"/>
                                    </div>
                                </div>

                                <div class="col-md-3 p-l-20 m-top-bottom-5">
                                    <button class="btn btn-info w-lg">搜索</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered m-t-15">
                                    <thead>
                                        <tr>
                                            <th>序</th>
                                            <th>商品名称</th>
                                            <th>商品售价(￥)</th>
                                            <th>物流费用(￥)</th> 
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
                                                <td style="max-width: 200px;" class="overHidden">{{$v->name}}</td>
                                                <td>{{$v->price}}</td>
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
                                                    <button class="btn btn-info" onclick="editCommodity('{{$v->id}}', '{{$v->name}}', '{{$v->price}}', '{{$v->express_price}}', '{{$v->sale_amounts}}', '{{$v->location}}', '{{$v->is_shelves}}', '{{$v->img}}', '{{$v->commodity_types}}')">编辑</button>
                                                    <button class="btn btn-success" onclick="showEnterActivity({{$v->id}})">加入活动</button>
                                                    <button class="btn btn-danger" onclick="deleteCommodity('{{ route('commodityDelete', ['id' => $v->id]) }}')">删除</button>
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

    {{-- 编辑模态框 --}}
    <div class="modal fade" id="editModal" commdityId="" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">商品编辑预览</h4>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post" action="{{ route('commodityUpdate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <span>商品名称:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" id="hiddenId" name="hiddenId">
                                <input class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>商品类别:</span>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="commodity_types" name="commodity_types">
                                    <option value="">请选择商品类别</option>
                                    <option value="1">水果大王</option>
                                    <option value="2">蔬菜大王</option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>商品售价(￥):</span>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="price" name="price" class="form-control">
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>物流费用(￥):</span>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="express_price" name="express_price" class="form-control">
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>商品销量:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="sale_amounts" name="sale_amounts" class="form-control">
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>始发地:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="location" name="location" class="form-control">
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>上架情况:</span>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="is_shelves" name="is_shelves">
                                    <option value="">请选择上架情况</option>
                                    <option value="0">下架</option>
                                    <option value="1">上架</option>
                                </select>
                            </div>
                        </div>

                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>商品图片:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="display: none;" id="uploadImg" name="img" onchange="contentChange()">
                                <button type="button" class="btn btn-info w-lg" onclick="uploadFile()">点击上传</button>
                            </div>
                        </div>

                        <div class="row m-t-5">
                            <div class="col-md-3 text-right">
                                <span>商品预览:</span>
                            </div>
                            <div class="col-md-9" id="priviewImg">
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

    {{-- 假如活动模态框 --}}
    <div class="modal fade" id="activityModal" commdityId="" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">商品加入活动</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2 m-t-5 text-right">
                            <span>商品名称:</span>
                        </div>
                        <div class="col-md-9">
                            <input id="commodity_id" type="hidden" name="commodity_id">
                            <select id="activity_id" name="activity_id" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info" onclick="sureAdd()">保存</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.zh-CN.min.js')}}"></script>
<script type="text/javascript">
    $("#datepicker1").datepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        autoclose : true,
    });
    $("#datepicker2").datepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        autoclose : true,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // 展开modal
    function editCommodity(id, name, price, express_price, sale_amounts, location, is_shelves, img, commodity_types) {
        $('#hiddenId').val(id);
        var array = ['name', 'price', 'express_price', 'sale_amounts', 'location', 'is_shelves', 'commodity_types'];
        var defaultImg = "{{URL::asset('img/nothing.png')}}";
        for(var i = 0; i < array.length; i++) {
            $('#'+array[i]).val(eval(array[i]));
        }
        if (!img) {
            var image = "<img width='150px' height='112px' src='"+defaultImg+"'>";
        } else {
            var image = new Image();
            image.src = img;
            image.hidden = 'hidden';

            image.onload = function () {
                var width = image.width, height = image.height;
                image.width = 150;
                image.height = 150*(height/width);
                image.hidden = null;
            };
        }
        $('#priviewImg').html('');
        $('#priviewImg').append(image);
        $('#editModal').modal('show');
    }
    // 上传
    function uploadFile() {
        $('#uploadImg').click();
    }

    // 渲染
    function contentChange() {
        var file = $('#uploadImg').prop('files');
        if (file[0].type.indexOf('image') == -1) {
            alert('您上传的文件不是图片，请核对后再试！');
        }

        if (typeof (FileReader) === 'undefined') {
            alert('您的浏览器不支持FileReader，请使用最新的chrome');
            return false;
        }
        if(!/image/.test(file[0].type)){
            return false;
        };
        var reader = new FileReader();
        reader.readAsDataURL(file[0]);
        reader.onload = function(){
            var data = this.result;
            var image = new Image();
            image.src = data;
            image.hidden = 'hidden';

            image.onload = function () {
                var width = image.width, height = image.height;
                image.width = 150;
                image.height = 150*(height/width);
                image.hidden = null;
            };

            $('#priviewImg').html('');
            $('#priviewImg').append(image);
        }
    }

    // 图片渲染公共函数
    function imgMake(src, priviewDiv) {
        var image = new Image();
        image.src = src;
        image.hidden = 'hidden';
        $('#'+priviewDiv).html('');
        $('#'+priviewDiv).append(image);

        image.onload = function () {
            var width = image.width, height = image.height;
            image.width = 150;
            image.height = 150*(height/width);
            image.hidden = null;
        };
    }

    // 修改表单提交
    function submitForm() {
        $('#updateForm').submit();
    }

    // 删除
    function deleteCommodity(url) {
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

    function showEnterActivity(id) {
        $.ajax({
            url: "{{ route('getActivities') }}",
            type:"get",  
            dataType:"json",  
            success: function(data){
                if (data.length != 0) {
                    $('#commodity_id').val(id);
                    var html = '<option value="">请选择活动</option>';
                    $.each(data, function(index, item) {
                        html += "<option value='"+item.id+"'>"+item.name+"</option>";
                    });
                    $('#activity_id').html('');
                    $('#activity_id').append(html);
                    $('#activityModal').modal('show');
                } else {
                    $.confirm({
                        title: '提示',
                        content: '您暂未添加任何活动，请及时添加！',
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

    function sureAdd() {
        $.ajax({
            url: "{{ route('addCommodityToActivity') }}",
            type:"post",  
            dataType:"json",
            data: {
                activity_id: $('#activity_id').val(),
                commodity_id: $('#commodity_id').val(),
            },
            success: function(data){
                $.confirm({
                    title: '提示',
                    content: '您已添加成功，请在活动管理页面查看！',
                    buttons: {
                        OK: {
                            btnClass: 'btn-primary',
                            action: function () {
                                $('#activityModal').modal('hide');
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
</script>
@endsection