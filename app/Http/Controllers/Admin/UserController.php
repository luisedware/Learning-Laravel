<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UserForm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "用户管理";
        $page_description = "管理用户的新增、编辑、删除";
        $users = User::getAllUsers();

        return view('admin.user.index', compact('page_title', 'page_description', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::getAllRolesDataModel();
        $page_title = "新增用户";
        $page_description = "新增用户的页面";

        return view('admin.user.create', compact('roles', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request)
    {
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
            'role_id'  => $request['role_id']
        ];

        try {
            $user = User::create($data);
            if ($user) {

                if (!empty($data['role_id'])) {
                    $role = Role::find($data['role_id']);

                    if ($role) {
                        $user->attachRole($role);
                    } else {
                        $user->delete();

                        return redirect()->back()->withErrors("用户角色不存在")->withInput();
                    }
                }

                return redirect()->back()->withSuccess('新增用户成功');
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
        $user = User::getUserById($id);
        $page_title = "编辑用户";
        $page_description = "编辑用户的页面";

        return view('admin.user.edit', compact('page_title', 'page_description', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserForm $request, $id)
    {
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
        ];

        try {
            if (User::where('id', $id)->update($data)) {
                return redirect()->back()->withSuccess('编辑用户成功');
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
            if (User::destroy($id)) {
                return redirect()->back()->withSuccess('删除用户成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
