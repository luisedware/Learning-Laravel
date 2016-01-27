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
     * 指定模型数据表
     * @var string
     */
    protected $table = 'la_menu';

    /**
     * 支持批量赋值
     * @var array
     */
    protected $fillable = ['url', 'name', 'parent_id'];

    /**
     * 新增成功提示消息
     * @var string
     */
    public static $storeSuccessMessage = "新增菜单成功";

    /**
     * 编辑成功提示消息
     * @var string
     */
    public static $updateSuccessMessage = "编辑菜单成功";


    /**
     * 删除成功提示消息
     * @var string
     */
    public static $deleteSuccessMessage = "删除菜单成功";

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
