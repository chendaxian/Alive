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
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading row">
                    <div class="col-sm-6">
                        <h4>商品类别列表</h4>
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
                                            <th>类别名称</th>
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
                                                <td>{{$v->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editCommodity('{{$v->id}}', '{{$v->name}}','{{$v->img}}')">编辑</button>
                                                    <button class="btn btn-danger" onclick="deleteCommodity('{{ route('commodityTypesDelete', ['id' => $v->id]) }}')">删除</button>
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
                    <h4 class="modal-title">商品类别编辑预览</h4>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post" action="{{ route('commodityTypesUpdate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <span>类别名称:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" id="hiddenId" name="hiddenId">
                                <input class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right">
                                <span>类别图片:</span>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="display: none;" id="uploadImg" name="img" onchange="contentChange()">
                                <button type="button" class="btn btn-info w-lg" onclick="uploadFile()">点击上传</button>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right">
                                <span>图片预览:</span>
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
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
    function editCommodity(id, name, img) {
        $('#hiddenId').val(id);
        $('#name').val(name);
        var defaultImg = "{{URL::asset('img/nothing.png')}}";

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

    function uploadFile() {
        $('#uploadImg').click();
    }

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
            $('#priviewImg').html('');
            $('#priviewImg').append(image);

            image.onload = function () {
                var width = image.width, height = image.height;
                image.width = 150;
                image.height = 150*(height/width);
                image.hidden = null;
            };
        }
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

    // 修改表单提交
    function submitForm() {
        $('#updateForm').submit();
    }
</script>
@endsection