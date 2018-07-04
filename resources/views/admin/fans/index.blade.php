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
                        <h4>微信粉丝列表</h4>
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
                                            <th>微信昵称</th>
                                            <th>微信头像</th>
                                            <th>国家</th> 
                                            <th>省份</th>
                                            <th>城市</th>
                                            <th>授权时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($data->count())
                                        @foreach($data as $v)
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td style="max-width: 200px;" class="overHidden">{{$v->nick_name}}</td>
                                                <td>
                                                    <img src="{{$v->avatar_url}}" width="35px" height="35px">
                                                </td>
                                                <td>{{$v->country}}</td>
                                                <td>{{$v->province}}</td>
                                                <td>{{$v->city}}</td>
                                                <td>{{$v->created_at}}</td>
                                                <td>
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
@endsection
@section('bottom_script')
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
</script>
@endsection