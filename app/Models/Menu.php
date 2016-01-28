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
    protected $fillable = ['url', 'name', 'parent_id'];

    /**
     * 获取一维菜单列表
     * @return mixed
     */
    public static function getMenuDataModel()
    {
        $menu = self::all();
        $tree = tree($menu);
        return $tree;
    }

    /**
     * 获取左侧菜单列表
     * @return mixed
     */
    public static function getSiderbarMenuDataModel()
    {
        $menu = self::all();
        $tree = node_tree($menu);
        return $tree;
    }
}
