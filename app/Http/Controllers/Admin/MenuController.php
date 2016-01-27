<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MenuForm;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(25);
        $page_title = "菜单管理";
        $page_description = "管理菜单的新增、编辑、删除";
        return view('admin.menu.index',compact('menus','page_title','page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tree = Menu::getMenuDataModel();
        $page_title = "新增菜单";
        $page_description = "";
        return view('admin.menu.create', compact('tree','page_title','page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuForm $request)
    {
        try {
            if (Menu::create($request->all())) {
                return Redirect::back()->withSuccess(Menu::$storeSuccessMessage);
            }
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        $tree = Menu::getMenuDataModel();
        return view('admin.menu.edit', compact('menu', 'tree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuForm $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        try {
            if (Menu::where('id', $id)->update($data)) {
                return Redirect::back()->withSuccess(Menu::$updateSuccessMessage);
            }
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $child_menus = Menu::Where('parent_id','=',$id)->get()->toArray();

        if(!empty($child_menus)){
            return Redirect::back()->withErrors(array('error'=>'请先删除其下级分类'));
        }

        try{
            if(Menu::destroy($id)){
                return Redirect::back()->withSuccess(Menu::$deleteSuccessMessage);
            }
        }catch(\Exception $e){
            return Redirect::back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
