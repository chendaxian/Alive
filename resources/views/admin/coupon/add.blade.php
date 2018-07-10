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
                        <h4>新增优惠券</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ route('couponStore') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">优惠券说明:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="description">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">优惠券类别:</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="type">
                                        <option>请选择优惠券类型</option>
                                        <option value="1">消费金额满减型</option>
                                        <option value="2">无门槛使用型</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">满减限制金额:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="limit_money">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">优惠金额:</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="preferential_amount">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-15">
                            <div class="form-group">
                                <label for="wechat_name" class="control-label col-lg-2 alignRight">截止时间:</label>
                                <div class="col-lg-4">
                                    <input type="text" id="dead_line" name="dead_line" class="form-control"/>
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
<script src="{{ asset('js/wangEditor.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.zh-CN.min.js')}}"></script>
<script type="text/javascript">
    $("#dead_line").datepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        autoclose : true,
    });
</script>
@endsection