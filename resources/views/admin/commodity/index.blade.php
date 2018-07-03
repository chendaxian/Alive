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
                        <h4>商品列表</h4>
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
                                                    <button class="btn btn-info" onclick="editCommodity('{{$v->id}}', '{{$v->name}}', '{{$v->price}}', '{{$v->express_price}}', '{{$v->sale_amounts}}', '{{$v->location}}', '{{$v->is_shelves}}', '{{$v->img}}')">编辑</button>
                                                    {{-- <a href="{{ route('commodityDelete', ['id' => $v->id]) }}"> --}}
                                                        <button class="btn btn-danger" onclick="deleteCommodity('{{ route('commodityDelete', ['id' => $v->id]) }}')">删除</button>
                                                    {{-- </a> --}}
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
@endsection
@section('bottom_script')
<script type="text/javascript">
    // 展开modal
    function editCommodity(id, name, price, express_price, sale_amounts, location, is_shelves, img) {
        $('#hiddenId').val(id);
        var array = ['name', 'price', 'express_price', 'sale_amounts', 'location', 'is_shelves'];
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
</script>
@endsection