<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
            </div>
        </form>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">系统配置</li>
            @foreach($sidebar_menus as $menu)
                <li class="treeview @if($menu->url == $breadcrumb_navigation[0]['url']) active @endif">
                    <a href="@if(empty($menu->child)) {{route($menu->url)}} @endif">
                        <i class="fa fa-dashboard"></i> <span>{{$menu->name}}</span>
                        @if(!empty($menu->child)) <i class="fa fa-angle-left pull-right"></i> @endif
                    </a>
                    @if(!empty($menu->child))
                        <ul class="treeview-menu">
                            @foreach($menu->child as $child)
                                <li class="@if($child->url == $breadcrumb_navigation[$nav_count-1]['url']) active @endif">
                                    <a href="{{route($child->url)}}"><i class="fa fa-circle-o"></i>{{$child->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
</aside>