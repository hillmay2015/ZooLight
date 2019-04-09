<?php
/**
 * User: may
 * Date: 2019/4/6
 * Time: 下午4:18
 * 产品
 */
namespace app\index\controller;

use app\admin\model\Categroy;
use think\App;
use think\Controller;
use app\common\traits\CategoryTraits;
use app\common\model\Product as ProductModel;

class Product extends Controller
{
    use CategoryTraits;
    protected $model;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->model = new ProductModel();
    }

    public function detail()
    {
        //分类
        $type1 = $this->getCategory();
        $this->assign('type', $type1);
        //根据id来查相关的商品
        $id = $this->request->param('id', 0, 'intval');
        $where['id'] = $id;
        $filed = 'id,name,sub_name,image,discount_price,price,start_time,end_time,seller_info,tips';
        $result = $this->model->findOneList($where, $filed);
        $info=json_decode(json_encode($result),true);
        if (!empty($info)) {
            $this->assign('info', $info);
        } else {
            $this->assign('info', []);
        }

        return $this->fetch();
    }
}