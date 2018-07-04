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
                                            {{-- <th>类别图片</th> --}}
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
                                                {{-- <td></td> --}}
                                                <td>{{$v->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editCommodity('{{$v->id}}', '{{$v->name}}', '{{$v->price}}', '{{$v->express_price}}', '{{$v->sale_amounts}}', '{{$v->location}}', '{{$v->is_shelves}}', '{{$v->img}}')">编辑</button>
                                                    <button class="btn btn-danger" onclick="deleteCommodity('{{ route('commodityDelete', ['id' => $v->id]) }}')">删除</button>
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