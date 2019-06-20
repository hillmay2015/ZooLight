<?php
/**
 * User: may
 * Date: 2019/4/3
 * Time: 上午9:16
 * 购买
 */
namespace app\index\controller;

use app\common\service\BuyService;
use think\Controller;
use app\common\traits\CategoryTraits;
use app\common\model\Product as ProductModel;
use wxpay;
use app\common\traits\QrTraits;
use alipay;

class Buy extends Controller
{
    use CategoryTraits;
    use QrTraits;
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
        $this->assign('is_login', session('is_login') == 1 ? 1 : 0);
        $this->assign('user_name', !empty(session('user_name')) ? session('user_name') : '');
    }

    /**
     * 购买第一步
     */

    public function index()
    {
        //分类
        $type1 = $this->getCategory();
        $this->assign('type', $type1);
        //根据id来查相关的商品
        $id = $this->request->param('id', 0, 'intval');
        $where['id'] = $id;
        $filed = 'id,name,sub_name,image,discount_price,price,start_time,end_time,seller_info,tips';
        $result = $this->model->findOneList($where, $filed);
        $info = json_decode(json_encode($result), true);
        if (!empty($info)) {
            $this->assign('info', $info);
        } else {
            $this->assign('info', []);
        }

        return $this->fetch();
    }


    /**
     * 购买第二步
     */

    public function stepTwo()
    {
        $service = new BuyService();
        $data = $service->createOrder($this->request->param());
        $this->assign('data', $data);
        return $this->fetch();

    }


    /**
     * 购买第三步
     */
    public function stepThree()
    {
        return $this->fetch();

    }


    /**
     * 支付页面
     */
    public function pay()
    {
        $param = $this->request->param();
        if ($param['pay'] == 2) {
            $this->alipay($param);
        } elseif ($param['pay'] == 3) {
            $this->wxpay($param);
            $this->view->engine->layout(false);
            $this->assign('data',$param);
            return $this->fetch();
        }

    }

    /**
     * 微信刷新重新支付
     */
    public function refreshPay()
    {
        $this->pay();
    }

    /**
     * @param $param
     * 支付宝支付
     */
    public function alipay($param)
    {
        //支付时判断是移动端还是PC端
        $isMobile = isMobile();
        if ($isMobile) {
            $mode = 2;//WAP端支付
        } else {
            $mode = 1;//电脑端支付
        }
        $alipay = new alipay\Alipay($mode);
        $data = ['out_trade_no' => $param['order_sn'],
            'total_amount' => $param['total_money'],
            'subject' => $param['product_name'],
            'body' => 'test'
        ];
        $alipay->payRequest($data);
    }

    /**
     * @param $param
     * 微信支付
     */
    public function wxpay($param)
    {
        $wxpay = new wxpay\wxpay();
        $result = $wxpay->setData($param);
        $this->assign('url', $result['code_url']);

    }

    /**
     * 支付提交
     */
    public function doPay()
    {

    }

}