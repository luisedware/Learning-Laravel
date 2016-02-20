<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 菜单模型
 * @package App\Models
 */
class Menu extends Model
{
    /**
     * 支持批量赋值
     * @var array
     */
    protected $fillable = ['url', 'name', 'description', 'parent_id', 'sort', 'is_hide','is_group'];


    /**
     * 获取所有菜单
     */
    public static function getAllMenusDataModel()
    {
        return self::all();
    }

    /**
     * 获取一维菜单列表
     * @return mixed
     */
    public static function getMenuDataModel()
    {
        $menu = self::getAllMenusDataModel();
        $tree = tree($menu);

        return $tree;
    }

    /**
     * 获取左侧菜单列表
     * @return mixed
     */
    public static function getSiderbarMenuDataModel()
    {
        $menu = self::getAllMenusDataModel();
        $tree = node_tree($menu);

        return $tree;
    }

    /**
     * 获取面包屑导航
     * @param $id
     * @return array
     */
    public static function getBreadcrumbNavigationDataModel($id)
    {
        $menus = self::getAllMenusDataModel()->toArray();
        $nav = breadcrumb_navigation($menus, $id);

        return $nav;
    }
}
