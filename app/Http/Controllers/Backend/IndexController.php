<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
        $route = $request->route();
        $parent_id = $route->getParameter('parent_id');
        view()->share('parent_id', $parent_id ? $parent_id : 1);
    }

    public function index()
    {
        return view('backend.index.index');
    }
}
