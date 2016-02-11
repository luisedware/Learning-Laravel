<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Role;
use App\Models\User;

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
        $this->call("RolesTableSeeder");
        $this->call("UsersTableSeeder");
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(['name' => 'Ann', 'email' => 'ann@qq.com', 'password' => bcrypt(123456)]);
        User::create(['name' => 'Luis', 'email' => 'luis@qq.com', 'password' => bcrypt(123456)]);
        User::create(['name' => 'admin', 'email' => 'admin@qq.com', 'password' => bcrypt(123456)]);
    }
}


class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        Role::create(['name' => 'admin', 'display_name' => 'User Administrator', 'description' => 'User is allowed to manage and edit other users']);
        Role::create(['name' => 'owner', 'display_name' => 'Project Owner', 'description' => 'User is the owner of a given project']);
    }
}

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->delete();
        Menu::create(["parent_id" => "0", "name" => "首页管理", "url" => "index.index"]);
        Menu::create(["parent_id" => "0", "name" => "菜单管理", "url" => "menu.index"]);
        Menu::create(["parent_id" => "2", "name" => "菜单列表", "url" => "menu.index"]);
        Menu::create(["parent_id" => "2", "name" => "新增菜单", "url" => "menu.create"]);
        Menu::create(["parent_id" => "2", "name" => "编辑菜单", "url" => "menu.edit", 'display' => 0]);
        Menu::create(["parent_id" => "0", "name" => "角色管理", "url" => "role.index"]);
        Menu::create(["parent_id" => "6", "name" => "角色列表", "url" => "role.index"]);
        Menu::create(["parent_id" => "6", "name" => "新增角色", "url" => "role.create"]);
        Menu::create(["parent_id" => "6", "name" => "新增角色", "url" => "role.edit", 'display' => 0]);
        Menu::create(["parent_id" => "0", "name" => "权限管理", "url" => "permission.index"]);
        Menu::create(["parent_id" => "10", "name" => "权限列表", "url" => "permission.index"]);
        Menu::create(["parent_id" => "10", "name" => "新增权限", "url" => "permission.create"]);
        Menu::create(["parent_id" => "10", "name" => "新增权限", "url" => "permission.edit", 'display' => 0]);
        Menu::create(["parent_id" => "0", "name" => "用户管理", "url" => "user.index"]);
        Menu::create(["parent_id" => "14", "name" => "用户列表", "url" => "user.index"]);
        Menu::create(["parent_id" => "14", "name" => "新增用户", "url" => "user.create"]);
        Menu::create(["parent_id" => "14", "name" => "新增用户", "url" => "user.edit", 'display' => 0]);
    }
}