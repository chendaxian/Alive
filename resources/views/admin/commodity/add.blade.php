@extends('layouts.admin.base')
@section('content')
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
                        <h4>新增商品</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ route('commodityStore') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">商品名称:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="name">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">商品类别:</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="commodity_types">
                                        <option value="">请选择商品类别</option>
                                        @foreach($type as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                        @endforeach()
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">商品售价(￥):</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="price">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">物流费用(￥):</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="express_price">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">商品销量:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="sale_amounts">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">发货地址:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="location">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">上架情况:</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="is_shelves">
                                        <option value="">请选择上架情况</option>
                                        <option value="1">上架</option>
                                        <option value="0">下架</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">商品图片:</label>
                                <div class="col-lg-4">
                                    <input type="file" style="display: none;" id="uploadImg" name="img" onchange="contentChange()">
                                    <button type="button" class="btn btn-info" onclick="uploadFile()">点击上传图片</button>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">商品预览:</label>
                                <div class="col-lg-4" id="priviewImg">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight"></label>
                                <div class="col-lg-4">
                                    <button class="btn btn-info w-lg">提交</button>
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
<script type="text/javascript">
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
</script>
@endsection