<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $route = Route::currentRouteName();
        $nav = $this->getBreadcrumbNavigation($route);
        view()->share('nav_count', count($nav));
        view()->share('user_info', Auth::user()->toArray());
        view()->share('sidebar_menus', Menu::getSiderbarMenuDataModel());
        view()->share('breadcrumb_navigation', $nav);
    }

    public function getBreadcrumbNavigation($route_name)
    {
        $menu = Menu::where('url', '=', $route_name)->orderBy('id', 'desc')->first();

        if (!$menu) {
            return false;
        } else {
            $nav = Menu::getBreadcrumbNavigationDataModel($menu->id);
            sort($nav);

            return $nav;
        }


    }
}
