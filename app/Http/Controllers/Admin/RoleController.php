<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RoleForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::getAllRoles();
        $page_title = "角色管理";
        $page_description = "管理角色的新增、编辑、删除";

        return view('admin.role.index', compact('page_title', 'page_description', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "新增角色";
        $page_description = "新增角色的页面";

        return view('admin.role.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleForm $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleForm $request)
    {
        try {
            if (Role::create($request->all())) {
                return Redirect::back()->withSuccess('新增角色成功');
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
        $role = Role::getRoleById($id);
        $page_title = "编辑角色";
        $page_description = "编辑角色的页面";

        return view('admin.role.edit', compact('page_title', 'page_description', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleForm $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        try {
            if (Role::where('id', $id)->update($data)) {
                return Redirect::back()->withSuccess('编辑角色成功');
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
        try {
            if (Role::destroy($id)) {
                return Redirect::back()->withSuccess('删除角色成功');
            }
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
