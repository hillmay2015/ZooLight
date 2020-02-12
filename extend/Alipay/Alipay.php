<?php
/**
 * User: may
 * Date: 2019/6/13
 * Time: 下午5:56
 * 将操作支付宝的方法封装成一个类
 */

namespace Alipay;

use think\log;
use think\Exception;

class Alipay
{
    const PC = 1;//电脑网站支付
    const WAP = 2;//手机网站支付支付
    public $pay_path = [
        self::PC => 'pagepay/',//电脑网站支付
        self::WAP => 'wappay/',//手机网站支付
    ];
    //当前支付模式
    private $mode = self::PC;
    //当前引入sdk目录
    private $sdk_path = '';
    private $path;
    private $config = [//应用ID,您的APPID。
        'app_id' => "2018102361824249",

        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => "MIIEpAIBAAKCAQEA2li11zw0hBIcaVsNieSnC7CX79Nzz1+a0CxJyCqTloaLX7dNUh4Uk/KcYbp8KmOoxYxKl1HvLd1xtXOC76IDCUAyBeVcQTW5m+Hmg+TsJbzB6dlWcO1k0z+LJ+0uLpfAjXoQv5VeSuPUKhvc9Bhgz8K/VqjxT6lnsHtnKaEc10QzpDSyv7xk64EigNAazdjnLpTw+kyz/9bUlgbF032+3LLMMmfsdaW2Ro9W+Kh+f4MjNPxBFxkhibz+AJB6cyznKp6znRG6qmi+riUqPdI6XIuJulvFJ4TPY/eh4SvW2blW2yTUwYtiPZ88X3ssL6zUWGA3XG3HeL0Q3W5ztsjRewIDAQABAoIBADlKhYwQNAdjaSkLxyWjZWFf2L4I0Z5cC5cLx+BJq6gXbYKT6ind0rBvPDE4aVQGCkarZPcHfKagMDHYOUb/T6Shv35kjCxgGG+aeo2pB31vZcIiUNgYshfr2GuFhFSdZNy6ZqKeYrtrxEO4Q+WYb+6TvvjSI18vqBFaj9sQdyzUMFITDAiHwOazxd3p1RymQN+6EZ2XvYPUKiEk15j00bv1dyF9XDwWS84WxWWvE/Epzb7SBCVSc7DR1ioasENId2AIPA+ecpKRmGAgc32AIJzlvieiP1rt6xHlzdYiqJIyJficmaNiVjJqRBDZc2DQ5S07+lncaUBb/VT7iQo0xuECgYEA8GMlwfeLEpXeIndZqkUtDlFZTLL0Wt1KHlSHaeeSg0fY4l4vzwUVii3tOJVbpAqAaw5O36lEO/tyX+GNN01gWtoV61zsx8eGCHBoteBd5Bu7SpPG7Dgm5TSoXSC7tuiEObrgGg1muYGIfhOZhnQYZ5o378dlezUM0hywmogVuL0CgYEA6IcY2pOdQxzvsMCjl4+WoAZ02Rp8FziOxFlzjrCaJZisnECmbuF9TAI0YMcoByyxRd4mhKHWqwe/huXkjzi5gzI61OCIAVdrgtMw8ATKxS1dkecn8qR+wYQI04zrxGcxTNfRpc1kaYrVzFzzCECMS+ZV5m5I3Kia5sjyR9uK4pcCgYEAtsKKmFe9slmi0w1ubFe/k50hiYCc6uBHU5vsgAYBjDH5oND/BCPXZoDYVCapz6P0UnBEYyNrrzbSlDcFiEAZu7kG5TR3CMSXEJ913KFCgQTcdiy4Fivy1lwcjQEv9jX9IW8Epon9yZfD0CbSmDh3vXywfmpYqz2AC9aoJjTEXvkCgYBF73QDMYiICejxUU8io3YbFTYJohSWa1VNKtY9oVILYrrvl+Y2zS0BMlyMivm4BrIeoG0XURGeiQsKyJQQm2/4TKAzLIDbXm6gf2JlnhtaaIWO/2YdbWoOS+bXsberb5n9UZ/lbTv5Hl+lQoN6BOftYA6P6rWRYEiOhvuPrzE7awKBgQCyX49bCsnY8rCcqlpDXWbmm3m8u8sPUjazjUk+DvFWn2gj+APGOER30+i1mhKuHeBjYrZz1gSQ5+JBvWXY9iWYRFj9Egp2oCy/OENOsG0M0R7KmvPRUXcbsd4OPsuNMbmdd/ylGpVMpm30arSlCaum6Zp+EQCATK3gXI25YiBzbw==",
        //异步通知地址
        'notify_url' => "http://xxx/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",

        //同步跳转
        'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type' => "RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmN4T6I53xtt76TLJQUKoOITkA+RkU1Q9K+oM9zjCtYJqi8wpRwxO0sJZLBgI6QfwDyTFT2ddQlWYt975iZlMVLoUidEJQc2h7VTBhxqDx2UBL++7ON4zva5ebNS0hgaF53SyJKqUrL8mpKV683H0pB01ioTLoM4dvxY8UlNeAjRn+kDVxV4w+QdJPfcDYF4uIHKydTgsnkHlRkBn1mTdw6w4iwuRcrpUiIA3Hk6NZzd7d/HmL0JW43/C9PD5TP85fVClLXKlkLqBTjHPnCCi//WG1WnQOkEFKYsZhxJaBUP5XUGKfJgv3enYzofTuhtDK3e4zqZRUSaWqb3qCHNQywIDAQAB"
    ];

    public function __construct($paymentModel = self::WAP)
    { //默认支付方式为 电脑网站支付
        $this->path = dirname(__FILE__) . "/";
        $this->mode = $paymentModel;
        $this->sdk_path = $this->pay_path[$paymentModel];
        //  $this->writeLog($this->config, '支付宝配置参数:');
        //注册自动加载方法
        spl_autoload_register([__CLASS__, 'importSdk']);
    }


    /**
     * 引入相关的文件,包括配置文件
     * @param $className
     * @return bool
     * 自动加载类文件
     *
     */
    public function importSdk($className)
    {
        $fileName = $className . '.php';
        $currentPath = dirname(__FILE__) . '/';
        $pagepayPath = $currentPath . $this->sdk_path;
        $buildermodelPath = $currentPath . $this->sdk_path . $this->sdk_path . 'buildermodel/';
        $servicePath = $currentPath . $this->sdk_path . $this->sdk_path . 'service/';
        $requestPath = $currentPath . $this->sdk_path . 'aop/request/';
        if (file_exists($pagepayPath . $fileName)) {
            include $pagepayPath . $fileName;
        } elseif (file_exists($buildermodelPath . $fileName)) {
            include $buildermodelPath . $fileName;
        } elseif (file_exists($servicePath . $fileName)) {
            include $servicePath . $fileName;
        } elseif (file_exists($requestPath . $fileName)) {
            include $requestPath . $fileName;
        } else {
            return false;
        }
        return true;
    }


    /**
     * 发起支付
     * @param $builder 业务参数，使用buildmodel中的对象生成。
     * @param $return_url 同步跳转地址，公网可以访问
     * @param $notify_url 异步通知地址，公网可以访问
     * @return $response 支付宝返回的信息
     * 订单号 out_trade_no
     * 订单名称 subject
     * 付款金额 total_amount
     * 商品描述 body
     */
    public function payRequest($data)
    {
        // $this->setLog($data, '发起支付的参数:');
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($data['out_trade_no']);

        //订单名称，必填
        $subject = trim($data['subject']);

        //付款金额，必填
        $total_amount = trim($data['total_amount']);

        //商品描述，可空
        $body = trim($data['body']);

        //超时时间
        $timeout_express = "1m";

        if ($this->mode == self::PC) {

            //构造参数
            $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setOutTradeNo($out_trade_no);

            $aop = new \AlipayTradeService($this->config);

            $response = $aop->pagePay($payRequestBuilder, $this->config['return_url'], $this->config['notify_url']);
        } else {

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService($this->config);

            $result = $payResponse->wapPay($payRequestBuilder, $this->config['return_url'], $this->config['notify_url']);

            return $result;

        }

    }


    /**
     * 申请退款
     * alipay.trade.refund (统一收单交易退款接口)
     * @param $builder 业务参数，使用buildmodel中的对象生成。
     * @return $response 支付宝返回的信息
     */
    public function refund($data)
    {
        // $this->writeLog($data, '支付宝退款参数:');

        $RequestBuilder = new \AlipayTradeRefundContentBuilder();

        //商户订单号和支付宝交易号不能同时为空。 trade_no、  out_trade_no如果同时存在优先取trade_no
        if (isset($data['trade_no']) && !empty($data['trade_no'])) {
            $RequestBuilder->setTradeNo($data['trade_no']);//支付宝交易号
        } elseif (isset($data['out_trade_no']) && !empty($data['out_trade_no'])) {
            $RequestBuilder->setOutTradeNo($data['out_trade_no']);//商户订单号
        } else {
            throw new Exception('支付单号和支付宝交易号不能同时为空');
        }

        //退款金额，不能大于订单总金额
        $refund_amount = trim($data['refund_amount']);

        //退款的原因说明
        $refund_reason = trim($data['refund_reason']);

        //标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
        $out_request_no = trim($data['out_request_no']); //退款单号

        $RequestBuilder->setRefundAmount($refund_amount);
        $RequestBuilder->setRefundReason($refund_reason);
        $RequestBuilder->setOutRequestNo($out_request_no);

        $Response = new \AlipayTradeService($this->config);
        $result = $Response->Refund($RequestBuilder);
        return;
    }

    /**退款查询**/


    /**支付宝参数校验**/
    /**
     * @param $data 回传参数
     * @param $sign 是否验证
     */
    public function checkReturnData($data, $sign)
    {
        if ($sign) {
            //验证签名
            $alipay = new \AlipayTradeService($this->config);
            $result = $alipay->check($data);
            if (!$result) throw new Exception('验签失败');
        }
        //验证接口调用的app_id是否一致
        $appid = $data['app_id'];
        if ($appid != $this->config['app_id']) {
            throw new Exception('app_id不一致');
        }

    }


    /**交易单号查询**/
    public function query($data)
    {

        //商户订单号和支付宝交易号不能同时为空。 trade_no、  out_trade_no如果同时存在优先取trade_no
        //商户订单号，和支付宝交易号二选一
        $RequestBuilder = new \AlipayTradeQueryContentBuilder();
        if (isset($data['trade_no']) && !empty($data['trade_no'])) {
            $RequestBuilder->setTradeNo($data['trade_no']);//支付宝交易号
        } elseif (isset($data['out_trade_no']) && !empty($data['out_trade_no'])) {
            $RequestBuilder->setOutTradeNo($data['out_trade_no']);//商户订单号
        } else {
            throw new Exception('支付单号和支付宝交易号不能同时为空');
        }

        $Response = new \AlipayTradeService($this->config);
        $result = $Response->Query($RequestBuilder);
        return;
    }


    /**记录日志**/
    public function writeLog($content, $title)
    {
        Log::write($title . $content, 'notice');
    }

}
