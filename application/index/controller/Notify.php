<?php
/**
 * User: may
 * Date: 2019/6/14
 * Time: 上午11:07
 * 支付宝支付后回调
 */
namespace app\index\controller;

use app\common\model\Order;
use think\Controller;
use Alipay\Alipay;
use think\Exception;

class Notify extends Controller
{
    //异步通知
    public function alipayNotify()
    {

    }

    //同步通知 返回商户自定义的页面 供商户自己校验一些参数和处理
    public function alipayReturn($data, $sign = false)
    {
        $alipay = new Alipay();
        //参数校验
        $alipay->checkReturnData($data, $sign);

        //金额校验

        $res = $this->checkOrderAmount($data);


        //更新订单状态
        $rs = $this->updateOrder($data);


    }

    //更新订单状态
    /**
     * @param $['out_trade_no'] 商户订单号
     * @param $data ['trade_no'] 支付宝交易号
     * @return mixed
     * @throws Exception
     */
    public function updateOrder($data)
    {
        $orderModel = new Order();
        $where['order_sn'] = $data['out_trade_no'];
        $update['state'] = 1;//已支付
        $rs = $orderModel->updateData($where, $update);
        if (!$rs) {
            throw  new Exception('更新订单状态失败');
        } else {
            return true;
        }
    }


    public function checkOrderAmount($data)
    {
        $orderModel = new Order();
        $where['order_sn'] = $data['out_trade_no'];
        $list = $orderModel->findOneList($where);//查询数据库实际订单总额
        if ($list['total_money'] !== $data['total_amount']) {
            throw new Exception('付款金额与订单金额不一致');
        } else {
            return true;
        }
    }
}