<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Requests\PermissionForm;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "权限管理";
        $page_description = "管理权限的新增、编辑、删除";
        $permissions = Permission::getAllPermissions();

        return view('admin.permission.index', compact('page_title', 'page_description', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "新增权限";
        $page_description = "新增权限的页面";

        return view('admin.permission.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionForm $request)
    {
        try {
            if (Permission::create($request->all())) {
                return redirect()->back()->withSuccess('新增权限成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::getPermissionById($id);
        $page_title = "编辑权限";
        $page_description = "编辑权限的页面";

        return view('admin.permission.edit', compact('page_title', 'page_description', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        try {
            if (Permission::where('id', $id)->update($data)) {
                return redirect()->back()->withSuccess('编辑权限成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
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
        try {
            if (Permission::destroy($id)) {
                return redirect()->back()->withSuccess('删除菜单成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
