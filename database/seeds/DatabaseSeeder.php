<?php

use App\Models\Menu;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call("MenusTableSeeder");
        $this->call("UsersTableSeeder");
        $this->call("RolesTableSeeder");
        $this->call("RoleUserTableSeeder");
        $this->call("PermissionTableSeeder");
        $this->call("PermissionRoleTableSeeder");
    }
}

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permission_role')->delete();
        for ($i = 1; $i < 3; $i++) {
            for ($j = 1; $j < 24; $j++) {
                PermissionRole::create(['permission_id' => $j, 'role_id' => $i]);
            }
        }

    }
}


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(['name' => 'AAA', 'email' => '56696384@qq.com', 'password' => bcrypt(123456)]);
        User::create(['name' => 'BBB', 'email' => '568319617@qq.com', 'password' => bcrypt(123456)]);
        User::create(['name' => 'CCC', 'email' => '623578202@qq.com', 'password' => bcrypt(123456)]);
        User::create(['name' => 'DDD', 'email' => '2794408425@qq.com', 'password' => bcrypt(123456)]);
        User::create(['name' => 'EEE', 'email' => '345868674@qq.com', 'password' => bcrypt(123456)]);
    }
}


class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        Role::create(['name' => 'admin', 'display_name' => '超级管理员', 'description' => '拥有系统所有的查看与操作权限']);
        Role::create(['name' => 'user', 'display_name' => '普通用户', 'description' => '拥有系统所有的查看权限']);
    }
}

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_user')->delete();
        RoleUser::create(['user_id' => 1, 'role_id' => 1]);
        RoleUser::create(['user_id' => 2, 'role_id' => 1]);
        RoleUser::create(['user_id' => 3, 'role_id' => 1]);
        RoleUser::create(['user_id' => 4, 'role_id' => 1]);
        RoleUser::create(['user_id' => 5, 'role_id' => 2]);
    }
}

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->delete();
        Permission::create(["display_name" => "配置模块", "name" => "index.index", 'description' => '管理系统的功能与配置']);
        Permission::create(["display_name" => "菜单列表", "name" => "menu.index", 'description' => '管理菜单的新增、编辑、删除']);
        Permission::create(["display_name" => "新增菜单", "name" => "menu.create", 'description' => '新增菜单的页面']);
        Permission::create(["display_name" => "编辑菜单", "name" => "menu.edit", 'description' => '编辑菜单的页面']);
        Permission::create(["display_name" => "保存菜单", "name" => "menu.store", 'description' => '保存菜单的操作']);
        Permission::create(["display_name" => "更新菜单", "name" => "menu.update", 'description' => '更新菜单的操作']);
        Permission::create(["display_name" => "角色列表", "name" => "role.index", 'description' => '管理角色的新增、编辑、删除']);
        Permission::create(["display_name" => "新增角色", "name" => "role.create", 'description' => '新增角色的页面']);
        Permission::create(["display_name" => "编辑角色", "name" => "role.edit", 'description' => '编辑角色的页面']);
        Permission::create(["display_name" => "保存角色", "name" => "role.store", 'description' => '保存角色的操作']);
        Permission::create(["display_name" => "更新角色", "name" => "role.update", 'description' => '更新角色的操作']);
        Permission::create(["display_name" => "角色赋权", "name" => "role.show", 'description' => '角色赋权的页面']);
        Permission::create(["display_name" => "角色赋权", "name" => "role.update.permission", 'description' => '角色赋权的操作']);
        Permission::create(["display_name" => "权限列表", "name" => "permission.index", 'description' => '管理权限的新增、编辑、删除']);
        Permission::create(["display_name" => "新增权限", "name" => "permission.create", 'description' => '新增权限的页面']);
        Permission::create(["display_name" => "编辑权限", "name" => "permission.edit", 'description' => '编辑权限的页面']);
        Permission::create(["display_name" => "保存权限", "name" => "permission.store", 'description' => '保存权限的操作']);
        Permission::create(["display_name" => "更新权限", "name" => "permission.update", 'description' => '更新权限的操作']);
        Permission::create(["display_name" => "用户列表", "name" => "user.index", 'description' => '管理用户的新增、编辑、删除']);
        Permission::create(["display_name" => "新增用户", "name" => "user.create", 'description' => '新增用户的页面']);
        Permission::create(["display_name" => "编辑用户", "name" => "user.edit", 'description' => '编辑用户的页面']);
        Permission::create(["display_name" => "保存用户", "name" => "user.store", 'description' => '保存用户的操作']);
        Permission::create(["display_name" => "更新用户", "name" => "user.update", 'description' => '更新用户的操作']);
    }
}

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->delete();
        Menu::create([
            "parent_id"   => "0",
            "name"        => "配置模块",
            "url"         => "index.index",
            'description' => '管理系统的功能与配置',
            'ico'         => 'fa fa-cog'
        ]);

        Menu::create([
            "parent_id"   => "1",
            "name"        => "菜单管理",
            "url"         => "menu.index",
            'description' => '管理菜单的新增、编辑、删除',
            'ico'         => 'fa fa-bars'
        ]);
        Menu::create([
            "parent_id"   => "2",
            "name"        => "菜单列表",
            "url"         => "menu.index",
            'description' => '管理菜单的新增、编辑、删除',
            'ico'         => 'fa fa-list'
        ]);
        Menu::create([
            "parent_id"   => "2",
            "name"        => "新增菜单",
            "url"         => "menu.create",
            'description' => '新增菜单的页面',
            'ico'         => 'fa fa-plus'
        ]);
        Menu::create([
            "parent_id"   => "2",
            "name"        => "编辑菜单",
            "url"         => "menu.edit",
            'description' => '编辑菜单的页面',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "2",
            "name"        => "保存菜单",
            "url"         => "menu.store",
            'description' => '保存菜单的操作',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "2",
            "name"        => "更新菜单",
            "url"         => "menu.update",
            'description' => '更新菜单的操作',
            'is_hide'     => 1
        ]);

        Menu::create([
            "parent_id"   => "1",
            "name"        => "角色管理",
            "url"         => "role.index",
            'description' => '管理角色的新增、编辑、删除',
            'ico'         => 'fa fa-user-plus'
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "角色列表",
            "url"         => "role.index",
            'description' => '管理角色的新增、编辑、删除',
            'ico'         => 'fa fa-list'
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "新增角色",
            "url"         => "role.create",
            'description' => '新增角色的页面',
            'ico'         => 'fa fa-plus'
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "编辑角色",
            "url"         => "role.edit",
            'description' => '编辑角色的页面',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "保存角色",
            "url"         => "role.store",
            'description' => '保存角色的操作',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "更新角色",
            "url"         => "role.update",
            'description' => '更新角色的操作',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "角色赋权",
            "url"         => "role.show",
            'description' => '角色赋权的页面',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "8",
            "name"        => "角色赋权",
            "url"         => "role.update.permission",
            'description' => '角色赋权的操作',
            'is_hide'     => 1
        ]);

        Menu::create([
            "parent_id"   => "1",
            "name"        => "权限管理",
            "url"         => "permission.index",
            'description' => '管理权限的新增、编辑、删除',
            'ico'         => 'fa fa fa-exclamation-triangle'
        ]);
        Menu::create([
            "parent_id"   => "16",
            "name"        => "权限列表",
            "url"         => "permission.index",
            'description' => '管理权限的新增、编辑、删除',
            'ico'         => 'fa fa-list'
        ]);
        Menu::create([
            "parent_id"   => "16",
            "name"        => "新增权限",
            "url"         => "permission.create",
            'description' => '新增权限的页面',
            'ico'         => 'fa fa-plus'
        ]);
        Menu::create([
            "parent_id"   => "16",
            "name"        => "编辑权限",
            "url"         => "permission.edit",
            'description' => '编辑权限的页面',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "16",
            "name"        => "保存权限",
            "url"         => "permission.store",
            'description' => '保存权限的操作',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "16",
            "name"        => "更新权限",
            "url"         => "permission.update",
            'description' => '更新权限的操作',
            'is_hide'     => 1
        ]);

        Menu::create([
            "parent_id"   => "1",
            "name"        => "用户管理",
            "url"         => "user.index",
            'description' => '管理用户的新增、编辑、删除',
            'ico'         => 'fa fa-user'
        ]);
        Menu::create([
            "parent_id"   => "22",
            "name"        => "用户列表",
            "url"         => "user.index",
            'description' => '管理用户的新增、编辑、删除',
            'ico'         => 'fa fa-list'
        ]);
        Menu::create([
            "parent_id"   => "22",
            "name"        => "新增用户",
            "url"         => "user.create",
            'description' => '新增用户的页面',
            'ico'         => 'fa fa-plus'
        ]);
        Menu::create([
            "parent_id"   => "22",
            "name"        => "编辑用户",
            "url"         => "user.edit",
            'description' => '编辑用户的页面',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "22",
            "name"        => "保存用户",
            "url"         => "user.store",
            'description' => '保存用户的操作',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "22",
            "name"        => "更新用户",
            "url"         => "user.update",
            'description' => '更新用户的操作',
            'is_hide'     => 1
        ]);
        Menu::create([
            "parent_id"   => "0",
            "name"        => "仓储管理",
            "url"         => "index.index",
            'description' => '仓储管理模块',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "28",
            "name"        => "采购管理",
            "url"         => "purchasein.index",
            'description' => '管理采购的录入,核对,流水与统计',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "29",
            "name"        => "采购录入",
            "url"         => "purchasein.create",
            'description' => '采购录入',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "29",
            "name"        => "采购核对",
            "url"         => "purchasein.index",
            'description' => '采购核对',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "29",
            "name"        => "采购流水",
            "url"         => "purchasein.index",
            'description' => '采购流水',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "29",
            "name"        => "采购统计",
            "url"         => "purchasein.index",
            'description' => '采购统计',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "28",
            "name"        => "数据字典",
            "url"         => "dictionary.index",
            'description' => '采购统计',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "34",
            "name"        => "字典列表",
            "url"         => "dictionary.index",
            'description' => '采购统计',
            'is_hide'     => 0
        ]);
        Menu::create([
            "parent_id"   => "34",
            "name"        => "新增字典",
            "url"         => "dictionary.create",
            'description' => '采购统计',
            'is_hide'     => 0
        ]);
    }
}