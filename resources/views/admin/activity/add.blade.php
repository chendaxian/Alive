@extends('layouts.admin.base')
@section('content')
<style type="text/css">
    .alignRight {
        text-align: right;
    }
    .panel-body label {
        padding-top: 5px;
    }
    .w-e-text-container{height: 180px!important;}
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading row">
                    <div class="col-sm-6">
                        <h4>新增活动</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="post" id="activityAdd" action="{{ route('activitiesStore') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">活动名称:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="name">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">活动描述:</label>
                                <div class="col-lg-4">
                                    <input type="hidden" id="hiddenInput" name="description">
                                    <div id="description"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">活动首页图片:</label>
                                <div class="col-lg-4">
                                    <input type="file" style="display: none;" id="uploadImg1" name="img_index" onchange="contentChange(1)">
                                    <button type="button" class="btn btn-info" onclick="uploadFile(1)">点击上传图片</button>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">活动详情图片:</label>
                                <div class="col-lg-4">
                                    <input type="file" style="display: none;" id="uploadImg2" name="img_detail" onchange="contentChange(2)">
                                    <button type="button" class="btn btn-info" onclick="uploadFile(2)">点击上传图片</button>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">活动首页图片预览:</label>
                                <div class="col-lg-4" id="priviewImg1">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">活动详情图片预览:</label>
                                <div class="col-lg-4" id="priviewImg2">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight"></label>
                                <div class="col-lg-4">
                                    <button onclick="submitFrom()" type="button" class="btn btn-info w-lg">提交</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
<script src="{{ asset('js/wangEditor.min.js') }}"></script>
<script type="text/javascript">
    var E = window.wangEditor;
    var editorA = new E('#description');
    editorA.customConfig.uploadImgShowBase64 = true ;
    editorA.create();

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

    function submitFrom() {
        $('#hiddenInput').val(editorA.txt.html());
        $('#activityAdd').submit();
    }
</script>
@endsection