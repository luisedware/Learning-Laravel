<?php
if (!function_exists('is_image')) {
    /**
     * 判断文件的MIME类型是否为图片
     * @param $mimeType
     * @return bool
     */
    function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}

if (!function_exists('human_filesize')) {
    /**
     * 返回可读性更好的文件尺寸
     * @param     $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}

if (!function_exists('breadcrumb_navigation')) {
    /**
     * 根据菜单编号获取面包屑导航
     * @param $model
     * @param $id
     * @return array
     */
    function breadcrumb_navigation($model, $id)
    {
        $nav = [];

        foreach ($model as $key => $value) {
            if ($value['id'] == $id) {
                $nav[] = $value;
                $nav = array_merge($nav, breadcrumb_navigation($model, $value['parent_id']));
            }
        }

        return $nav;
    }
}

if (!function_exists('node_tree')) {
    /**多维数据无限分类
     * @param        $model
     * @param string $node
     * @param int    $parent_id
     * @return array
     */
    function node_tree($model, $node = "child", $parent_id = 0)
    {
        $tree = [];

        foreach ($model as $value) {
            if ($value->parent_id == $parent_id) {
                $value[$node] = node_tree($model, $node, $value->id);
                $tree[] = $value;
            }
        }

        return $tree;
    }
}

if (!function_exists('tree')) {
    /**一维数据无限分类
     * @param        $model
     * @param int    $parent_id
     * @param int    $level
     * @param string $html
     * @return array
     */
    function tree($model, $parent_id = 0, $level = 0, $html = '-')
    {
        $tree = [];

        foreach ($model as $value) {
            if ($value->parent_id == $parent_id) {
                if ($level != 0) {
                    $value->html = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    $value->html .= '|';
                }
                $value->html .= str_repeat($html, $level);
                $tree[] = $value;
                $tree = array_merge($tree, tree($model, $value->id, $level + 1));
            }
        }

        return $tree;
    }
}