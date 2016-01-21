<?php
namespace App\Http;

class AdminHelpers
{
    public static function getOrderPayStatusArray($pay_status = null)
    {
        $arr = ['0'=>'待支付','1'=>'已支付'];

        if($pay_status || $pay_status === 0){
            return $arr[$pay_status];
        }

        return json_encode($arr);
    }

    public static function getOrderRefundStatusArray($refund_status = null)
    {

        $arr = ['1' => '已退款', '2' => '退款中'];


        if ($refund_status || $refund_status === 0) {
            return $arr[$refund_status];
        }

        return json_encode($arr);
    }

    public static function getOrderPayTypeArray($pay_type = null)
    {

        $arr = ['0' => '货到付款', '1' => '微信支付', '3' => '余额支付', '2' => '支付宝支付'];


        if ($pay_type || $pay_type === 0) {
            return $arr[$pay_type];
        }

        return json_encode($arr);
    }

    public static function getOrderStatusArray($pay_status = null)
    {
        $arr = ['1' => '送货中', '13' => '配单中', '11' => '配货中', '2' => '已完成', '-1' => '已取消', '0' => '待处理'];

        if ($pay_status || $pay_status === 0) {
            return $arr[$pay_status];
        }

        return json_encode($arr);
    }

    public static function getOrderStatusTitle($pay_status)
    {
        switch ($pay_status) {
            case '1':
                $title = '<a class="btn btn-warning">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '13':
                $title = '<a class="btn btn-info">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '11':
                $title = '<a class="btn btn-primary">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '2':
                $title = '<a class="btn btn-success">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '-1':
                $title = '<a class="btn btn-default">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '3':
                $title = '<a class="btn btn-danger">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '0':
                $title = '<a class="btn btn-danger">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
            case '-9':
                $title = '<a class="btn btn-danger">' . self::getOrderStatusArray($pay_status) . '</a>';
                break;
        }

        return $title;
    }


    public static function getOrderPayStatusTitle($pay_type, $pay_status, $refund_status)
    {
        if ($pay_status == 0) {
            return self::getOrderPayTypeArray($pay_type);
        } elseif (($pay_type == 1) && ($refund_status == 2)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderRefundStatusArray($refund_status) . ")";
        } elseif (($pay_type == 1) && ($refund_status == 1)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderRefundStatusArray($refund_status) . ")";
        } elseif (($pay_type == 2) && ($refund_status == 2)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderRefundStatusArray($refund_status) . ")";
        } elseif (($pay_type == 2) && ($refund_status == 1)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderRefundStatusArray($refund_status) . ")";
        } elseif (($pay_type == 1) && ($pay_status == 1)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderPayStatusArray($pay_status) . ")";
        } elseif (($pay_type == 1) && ($pay_status == 0)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderPayStatusArray($pay_status) . ")";
        } elseif (($pay_type == 2) && ($pay_status == 1)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderPayStatusArray($pay_status) . ")";
        } elseif (($pay_type == 2) && ($pay_status == 0)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderPayStatusArray($pay_status) . ")";
        } elseif (($pay_type == 3) && ($pay_status == 0)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderPayStatusArray($pay_status) . ")";
        } elseif (($pay_type == 3) && ($pay_status == 1)) {
            return self::getOrderPayTypeArray($pay_type) . "<br>(" . self::getOrderPayStatusArray($pay_status) . ")";
        }
    }
}