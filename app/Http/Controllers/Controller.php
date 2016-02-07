<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

    public function __construct()
    {
        $sidebar_menus = Menu::getSiderbarMenuDataModel();
        view()->share('user_info', Auth::user()->toArray());
        view()->share('sidebar_menus', $sidebar_menus);
    }
}
