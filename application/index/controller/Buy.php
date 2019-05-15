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

class Buy extends Controller
{
    use CategoryTraits;
    use QrTraits;
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
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
        $wxpay = new wxpay\wxpay();
        echo '<pre>';
        print_r($param);
        exit();
        $result = $wxpay->setData($param);

        $this->assign('url', $result['code_url']);
        $this->createQr($result['code_url']);
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    /**
     * 支付提交
     */
    public function doPay()
    {

    }

}