<aside class="left-panel">

    <div class="logo">
        <a href="#" class="logo-expanded">
            <br>
            <span class="nav-label">悦享工作台</span>
        </a>
    </div>

    <nav class="navigation">
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
    </nav>

</aside>