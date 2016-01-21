<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 订单模型
 * @package App\Models
 */
class Order extends Model
{
    protected $table = 'z_order';

    /**
     * 订单一对一优惠券
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hasOneVoucher()
    {
        return $this->hasOne('App\Models\VoucherRecord', 'id', 'vrid');
    }
}
