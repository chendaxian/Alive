<aside class="left-panel">

    <div class="logo">
        <a href="#" class="logo-expanded">
            {{-- <img src="{{URL::asset('img/logo.jpg')}}" style="width: 60px;"> --}}
            <br>
            <span class="nav-label">悦享小程序工作台</span>
        </a>
    </div>

    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), ['admin/fans', 'admin/fansReportForm'])?
                'active': '' }}">
                <a href="#"><i class="fa fa-users"></i>
                    <span class="nav-label">客户管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == 'admin/fans'? 'active': '' }}">
                        <a href="{{ route('fans') }}">客户列表</a>
                    </li>
                    <li class="{{ Request::path() == 'admin/fansReportForm'? 'active': '' }}">
                        <a href="{{ route('fansReportForm') }}">客户分析</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), ['admin/commodities', 'admin/commodityAdd'])?
                'active': '' }}">
                <a href="#"><i class="fa fa-reorder"></i>
                    <span class="nav-label">商品管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == 'admin/commodities'? 'active': '' }}">
                        <a href="{{ route('commodities') }}">商品列表</a>
                    </li>
                    <li class="{{ Request::path() == 'admin/commodityAdd'? 'active': '' }}">
                        <a href="{{ route('commodityAdd') }}">新增商品</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), ['admin/commodityTypes', 'admin/commodityTypesAdd'])?
                'active': '' }}">
                <a href="#"><i class="fa fa-sliders"></i>
                    <span class="nav-label">类别管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == 'admin/commodityTypes'? 'active': '' }}">
                        <a href="{{ route('commodityTypes') }}">类别列表</a>
                    </li>
                    <li class="{{ Request::path() == 'admin/commodityTypesAdd'? 'active': '' }}">
                        <a href="{{ route('commodityTypesAdd') }}">新增类别</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), ['admin/orders'])?
                'active': '' }}">
                <a href="#"><i class="fa fa-copy"></i>
                    <span class="nav-label">订单管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == 'admin/orders'? 'active': '' }}">
                        <a href="{{ route('orders') }}">订单列表</a>
                    </li>
                    <li class="{{ Request::path() == ''? 'active': '' }}">
                        <a href="{{ route('commodities') }}">下单分析</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), ['admin/activities', 'admin/activitiesAdd'])?
                'active': '' }}">
                <a href="#"><i class="fa fa-institution"></i>
                    <span class="nav-label">活动管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == 'admin/activities'? 'active': '' }}">
                        <a href="{{ route('activities') }}">活动列表</a>
                    </li>
                    <li class="{{ Request::path() == 'admin/activitiesAdd'? 'active': '' }}">
                        <a href="{{ route('activitiesAdd') }}">新增活动</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), [])?
                'active': '' }}">
                <a href="#"><i class="fa fa-stack-exchange"></i>
                    <span class="nav-label">轮播图管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == ''? 'active': '' }}">
                        <a href="{{ route('commodities') }}">轮播图列表</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), [])?
                'active': '' }}">
                <a href="#"><i class="fa fa-server"></i>
                    <span class="nav-label">优惠券管理</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == ''? 'active': '' }}">
                        <a href="{{ route('commodities') }}">优惠券列表</a>
                    </li>
                    <li class="{{ Request::path() == ''? 'active': '' }}">
                        <a href="{{ route('commodities') }}">新增优惠券</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu {{ in_array(Request::path(), [])?
                'active': '' }}">
                <a href="#"><i class="fa fa-gear"></i>
                    <span class="nav-label">系统设置</span>
                </a>
                <ul class="list-unstyled">
                    <li class="{{ Request::path() == ''? 'active': '' }}">
                        <a href="{{ route('commodities') }}">权限管理</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

</aside>
