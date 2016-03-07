<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Form\RoleForm;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(25);

        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleForm $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleForm $request)
    {
        try {
            if (Role::create($request->all())) {
                return redirect()->route('role.index')->withSuccess('新增角色成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $checked_permissions = array_map(function ($value) {
            return $value['id'];
        }, $role->perms->toArray());

        return view('backend.role.show', compact('id', 'permissions', 'checked_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('backend.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoleForm $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        try {
            if (Role::where('id', $id)->update($data)) {
                return redirect()->route('role.index')->withSuccess('编辑角色成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Role::destroy($id)) {
                return redirect()->back()->withSuccess('删除角色成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }


    /**
     * 更新角色权限
     *
     * @param Request $request
     *
     * @return $this
     */
    public function updatePermission(Request $request)
    {
        $role = Role::find($request->get('role_id'));
        if (! $role) {
            return redirect()->route('role.index')->withErrors("角色不存在");
        } else {
            PermissionRole::where('role_id', '=', $role->id)->delete();
            if ($request->permission_id) {
                foreach ($request->permission_id as $item) {
                    PermissionRole::create(['permission_id' => $item, 'role_id' => $role->id]);
                }
            } else {
                return redirect("errors/denied");
            }

            return redirect()->back()->withSuccess("更新角色权限成功");
        }
    }
}
