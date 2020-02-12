<?php
/**
 * User: may
 * Date: 2019/5/14
 * Time: 上午10:26
 * 微信支付
 */
namespace wxpay;

class wxpay
{
    /**
     * 组装客户端传过来的数据
     * @param $data
     */
    public function setData($data)
    {
        require_once EXTEND_PATH.'/wxpay/lib/WxPay.Api.php';
        $input = new \WxPayUnifiedOrder();
        // 设置商品描述
        $input->SetBody($data['product_name']);
        // 设置订单号
        $input->SetOut_trade_no($data['pay_sn']);
        // 设置订单金额（单位：分）
        $input->SetTotal_fee($data['total_money']);
        // 设置异步通知地址
        $input->SetNotify_url('http://zoo.test.com:7888/index/buy/stepThree');
        // 设置交易类型
        $input->SetTrade_type('NATIVE');
        // 设置商品ID
        $input->SetProduct_id($data['product_id']);
        // 调用统一下单API
        $result = \WxPayAPI::unifiedOrder($input);
        // 生成二维码图片
        // $code_url = $result['code_url'];
        return $result;
    }
}