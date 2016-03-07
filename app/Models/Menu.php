<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    /**
     * 获取顶部导航条菜单
     *
     * @return model
     */
    public static function getMenuNavigation()
    {
        return self::where('parent_id', '=', 0)->get();
    }

    /**
     * 获取侧边栏菜单
     *
     * @return string
     */
    public static function getSidebar($parent_id = 0)
    {
        $tree = Tree::createNodeTree(Menu::all(), $parent_id);
        $sidebar = self::setSidebar($tree);

        return $sidebar;
    }


    /**
     * 设置侧边栏菜单
     *
     * @param $tree
     *
     * @return string
     */
    public static function setSidebar($tree)
    {
        $html = "";
        foreach ($tree as $menu) {
            if ($menu->is_hide == 0) {
                if ($menu->child) {
                    $html .= '<li class="treeview">'
                        . '<a><i class="' . $menu->ico . '"></i> <span>' . $menu->name . '</span><i class="fa fa-angle-left pull-right"></i></a>'
                        . '<ul class="treeview-menu">'
                        . self::setSidebar($menu->child)
                        . '</ul>'
                        . '</li>';
                } else {
                    $html .= '<li><a href="javascript:;" data-url="' . route($menu->url) . '"><i class="' . $menu->ico . '"></i><span> ' . $menu->name . '</span></a></li>';
                }
            }
        }

        return $html;
    }
}
