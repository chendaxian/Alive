<style type="text/css">
    .ulShow {
        display: block;
    }
    .ulHide {
        display: none;
    }
</style>
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="#" class="logo-expanded">
            {{-- <img src="{{asset('/img/eyee.jpeg')}}" alt="" style="width: 150px;"> --}}
            <br>
            <span class="nav-label">悦享工作台</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="has-submenu">
                <a href="#"><i class="fa fa-reorder"></i> <span
                            class="nav-label">秒杀商品管理</span></a>
                <ul class="list-unstyled {{ in_array(Request::path(), ['admin/commodities'])?
                'ulShow': '' }}">
                    <li><a href="{{ route('commodities') }}">商品列表</a></li>
                    <li><a href="">新增商品</a></li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="has-submenu">
                <a href="#"><i class="fa fa-reorder"></i> <span
                            class="nav-label">秒杀参与者管理</span></a>
                <ul class="list-unstyled">
                    <li><a href="">秒杀参与列表</a></li>
                </ul>
            </li>
        </ul>
    </nav>

</aside>
