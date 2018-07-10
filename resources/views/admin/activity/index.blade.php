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
                        <h4>活动列表</h4>
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
                                            <th>活动名称</th>
                                            <th>活动介绍</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($data->count())
                                        @foreach($data as $v)
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td style="max-width: 100px;" class="overHidden">{{$v->name}}</td>
                                                <td style="max-width: 500px;" class="overHidden">
                                                    {!! html_entity_decode($v->description) !!}
                                                </td>
                                                <td>{{$v->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editCommodity('{{$v->id}}', '{{$v->name}}',
                                                    '{{$v->description}}','{{$v->img_index}}', '{{$v->img_detail}}')">编辑</button>
                                                    <a href="{{ route('getActivityCommodities', ['id' => $v->id]) }}">
                                                        <button class="btn btn-success">查看商品</button>
                                                    </a>
                                                    <button class="btn btn-danger" onclick="deleteCommodity('{{ route('activitiesDelete', ['id' => $v->id]) }}')">删除</button>
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
                    <form id="updateForm" method="post" action="{{ route('activitiesUpdate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2 text-right m-t-5">
                                <label>活动名称:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" id="hiddenId" name="hiddenId">
                                <input class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right m-t-5">
                                <label>活动介绍:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="hidden" id="hiddenInput" name="description">
                                <div id="description"></div>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right m-t-5">
                                <label>首页图片:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="display: none;" id="uploadImg1" name="img_index" onchange="contentChange(1)">
                                <button type="button" class="btn btn-info w-lg" onclick="uploadFile(1)">点击上传</button>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right m-t-5">
                                <label>详情图片:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" style="display: none;" id="uploadImg2" name="img_detail" onchange="contentChange(2)">
                                <button type="button" class="btn btn-info w-lg" onclick="uploadFile(2)">点击上传</button>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right m-t-5">
                                <label>首页预览:</label>
                            </div>
                            <div class="col-md-9" id="priviewImg1">
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-2 text-right m-t-5">
                                <label>详情预览:</label>
                            </div>
                            <div class="col-md-9" id="priviewImg2">
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
<script src="{{ asset('js/wangEditor.min.js') }}"></script>
<script type="text/javascript">
    var E = window.wangEditor;
    var editorA = new E('#description');
    editorA.customConfig.uploadImgShowBase64 = true ;
    editorA.create();

    function editCommodity(id, name, description, img1, img2) {
        $('#hiddenId').val(id);
        $('#name').val(name);
        editorA.txt.html(description)
        var defaultImg = "{{URL::asset('img/nothing.png')}}";
        var publicImg = "<img width='150px' height='112px' src='"+defaultImg+"'>";

        if (!img1) {
            var image = publicImg;
        } else {
            var image = new Image();
            image.src = img1;
            image.hidden = 'hidden';

            image.onload = function () {
                var width = image.width, height = image.height;
                image.width = 150;
                image.height = 150*(height/width);
                image.hidden = null;
            };
        }
        $('#priviewImg1').html('');
        $('#priviewImg1').append(image);

        if (!img2) {
            var image1 = publicImg;
        } else {
            var image1 = new Image();
            image1.src = img2;
            image1.hidden = 'hidden';

            image1.onload = function () {
                var width = image1.width, height = image1.height;
                image1.width = 150;
                image1.height = 150*(height/width);
                image1.hidden = null;
            };
        }
        $('#priviewImg2').html('');
        $('#priviewImg2').append(image1);

        // var markers = [];
        // for (var i = 1; i <= imgs.length; ++i) {
        //     markers[i] = "image"+i;
        // }

        // for (var i = 1; i <= imgs.length; i++) {
        //     if (!imgs[i]) {
        //         var markers[i] = "<img width='150px' height='112px' src='"+defaultImg+"'>";
        //     } else {
        //         var markers[i] = new Image();
        //         markers[i].src = imgs[i];
        //         markers[i].hidden = 'hidden';

        //         markers[i].onload = function () {
        //             var width = markers[i].width, height = markers[i].height;
        //             markers[i].width = 150;
        //             markers[i].height = 150*(height/width);
        //             markers[i].hidden = null;
        //         };
        //     }
        //     $('#priviewImg'+eval(i)).html('');
        //     $('#priviewImg'+eval(i)).append(markers[i]);
        // }
        
        $('#editModal').modal('show');
    }

    function uploadFile(type) {
        $('#uploadImg'+type).click();
    }

    function contentChange(type) {
        var file = $('#uploadImg'+type).prop('files');
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
            $('#priviewImg'+type).html('');
            $('#priviewImg'+type).append(image);

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
        $('#hiddenInput').val(editorA.txt.html());
        $('#updateForm').submit();
    }
</script>
@endsection