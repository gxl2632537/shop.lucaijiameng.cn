<!-- header start -->
<header class="header-area gray-bg clearfix">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="logo">
                        <a href="/">
                            <img alt="{{env('APP_NAME')}}" src="/assets/img/logo/logo.png" style="width: 152px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-6">
                    <div class="header-bottom-right">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                  <li class="top-hover"><a href="/">首页</a>

                                    </li>
                                    <li><a href="">公司简介</a></li>
                                    <li class="mega-menu-position top-hover"><a href="#">在线购物</a>
                                    </li>
                                    <li class="top-hover"><a href="">新闻中心</a>
                                        <ul class="submenu">
                                            <li><a href="#">公司新闻</a></li>
                                            <li><a href="#">行业动态 <span><i class="ion-ios-arrow-right"></i></span></a></li>

                                        </ul>
                                    </li>
                                    <li class="top-hover"><a href="#">店铺展示</a>
                                    </li>
                                    <li><a href="#">联系我们</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-cart">
                            <a href="#">
                                <div class="cart-icon">
                                    <i class="ti-shopping-cart"></i><sup style="color: red;position: relative;top: -1rem;padding: 4px;">1</sup>
                                </div>
                            </a>

                        </div>
                        <div style="padding: 37px 0 0 20px;line-height: 1.5rem;">
                            <ul style="list-style: none;">
                                @guest
                                <li style="float: left;"><a href="{{route('login')}}" style="font-size: 12px;font-weight: 600;font-family: &quot;Montserrat&quot;,sans-serif;">登录</a></li>
                                <li style="float: right; margin-left: 1.2rem;"><a href="{{route('register')}}" style="font-size: 12px;font-weight: 600;font-family: &quot;Montserrat&quot;,sans-serif;">注册</a></li>
                                @else
                                    <li class="dropdown">
                                        <a href="#" class="" data-toggle="dropdown" role="button" aria-expanded="true">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="/uploads/images/dd6719bd4287d9efd49434c43563a032_v2_.jpg" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                                    退出登录
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>

                                            <li>
                                                <a href="{{ route('user_addresses.index') }}">收货地址</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('products.favorites') }}">我的收藏</a>
                                            </li>
                                        </ul>
                                    </li>
                                  @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="#">首页</a>

                            </li>
                            <li><a href="#">公司简介</a>

                            </li>
                            <li><a href="#">在线购物</a></li>
                            <li><a href="#">新闻中心</a>
                                <ul>
                                    <li><a href="#">公司新闻</a></li>
                                    <li><a href="#">行业动态</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">店铺展示</a></li>
                            <li><a href="#">联系我们</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
