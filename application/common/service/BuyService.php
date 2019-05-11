<?php
/**
 * User: may
 * Date: 2019/5/10
 * Time: 下午4:48
 * 购买生成订单
 */
namespace app\common\service;

use app\common\model\Order;
use app\common\model\Pay;
use think\Controller;
use think\Db;
use think\Exception;

class BuyService extends Controller
{
    protected $order_id = null;
    protected $pay_sn = null;
    protected $order_sn = null;

    public function createOrder($data)
    {

        try {// 启动事务
            Db::startTrans();
            //生成订单号,并插入订单表
            $this->step1($data);

            //生成付款单号
            $this->step2($data);

            // 提交事务
            Db::commit();
            $data['order_id'] = $this->order_id;
            $data['pay_sn'] = $this->pay_sn;
            $data['order_sn'] = $this->order_sn;
            return $data;
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

    }

    /**
     * 操作第一步
     */
    public function step1($data)
    {
        $order = new Order();
        $insert_order = [];
        $insert_order['order_sn'] = $this->makeOrderSn();
        $insert_order['product_id'] = $data['product_id'];
        $insert_order['product_name'] = $data['product_name'];
        $insert_order['number'] = $data['number'];
        $insert_order['price'] = $data['price'];
        $insert_order['total_money'] = $data['total_money'];
        $insert_order['discount'] = $data['discount'];
        $insert_order['state'] = 0;
        $insert_order['user_id'] = $data['user_id'];
        $order_id = $order->insertGetId($insert_order);
        if (empty($order_id)) {
            throw new Exception('订单表数据插入失败');
        } else {
            $this->order_id = $order_id;
            $this->order_sn = $insert_order['order_sn'];
        }


    }

    /**
     * 操作第二步
     */
    public function step2($data)
    {
        $insert_pay = [];
        $insert_pay['pay_sn'] = $this->makePaySn($data['user_id']);
        $insert_pay['order_id'] = $this->order_id;
        $pay = new Pay();
        $res = $pay->insert($insert_pay);
        if (empty($res)) {
            throw new Exception('支付表插入失败');
        }
    }

    /**
     * 生成支付单号
     */
    private function makePaySn($user_id)
    {
        return mt_rand(10, 99)
            . sprintf('%010d', time() - 946656000)
            . sprintf('%03d', (float)microtime() * 1000)
            . substr($user_id, -3);
    }

    /**
     * 生成订单号
     */
    private function makeOrderSn()
    {
        $res = date('m') . date('d') . (date('y', time()) % 9 + 1) . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $res;
    }


}