<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    protected $table = 'materials_record';
    public $timestamps = false;
    /**获取未确认的采购数据 lwj
     * *采购限制：未审核的采购单号可以继续操作，但不能新增新的单号
     **/
    public static function getNoCheck()
    {
        $data = self::where('status', 0)->orderBy('id', 'desc')->get();
        return $data;
    }
}
