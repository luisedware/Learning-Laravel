<header class="main-header">
    <a href="{{route('index.index')}}" class="logo"><b>Admin</b>LTE</a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu pull-left">
            <ul class="nav navbar-nav">
                @inject('menu','App\Models\Menu')
                @foreach($menu->getMenuNavigation() as $item)
                    <li>
                        <a class="" href="{{route($item->url).'/'.$item->id}}">
                            <i class="{{$item->ico}}"></i> <span>{{$item->name}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="navbar-custom-menu pull-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset("/assets/img/user2-160x160.jpg") }}" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset("/assets/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image"/>
                            <p>
                                {{Auth::user()->name}} - PHP工程师
                                <small>Happy Coding</small>
                            </p>
                        </li>
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">订单</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">用户</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">销量</a>
                            </div>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人信息</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{URL::to('auth/logout')}}" class="btn btn-default btn-flat">退出登录</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>