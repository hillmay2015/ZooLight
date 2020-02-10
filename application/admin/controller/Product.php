<?php
namespace app\admin\controller;

use app\common\traits\CategoryTraits;
use think\validate;
use app\admin\model\Product as ProductModel;
use app\common\traits\ProductTraits;
use app\common\traits\FileUploadTraits;

class Product extends Admin
{
    use CategoryTraits;
    use ProductTraits;
    use FileUploadTraits;
    protected $model;

    protected $rule = [
        'name' => 'require',
        'sub_name' => 'require',
        'price' => 'require',
        'market_price' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'editorValue' => 'require',
        'image' => 'require',
        'address' => 'require',

    ];

    protected $message = [
        'name.require' => '请输入产品标题',
        'subname.require' => '请输入标题描述',
        'market_price.require' => '请输入市场价格',
        'price.require' => '请输入展示价格',
        'start_time.require' => '请输入开始时间',
        'end_time.require' => '请输入结束时间',
        'editorValue.require' => '请输入商家介绍',
        'image.require' => '请传入图片',
        'address' => '请输入门店地址',

    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }


    public function productList()
    {
        $param = $this->request->param();
        $where = [];
        $name = $this->request->param('name', '');
        $start_time = $this->request->param('start_time');
        $end_time = $this->request->param('end_time');
        if (isset($name) && !empty($name)) {
            $where['name'] = $name;
        }
        //开始时间处理
        if ($start_time) {
            $start = strtotime($start_time);
        }
        //结束时间处理
        if ($end_time) {
            $end = strtotime($end_time);
        }
        //组合时间搜索条件
        if ($start_time && $end_time) {
            $where['start_time'] = ['egt', $start];
            $where['end_time'] = ['elt', $end];
        } else {
            if ($start_time) {
                $where['start_time'] = ['egt', $start];
            }
            if ($end_time) {
                $where['end_time'] = ['elt', $end];
            }
        }

        $product = $this->model->selectAllList($where,'','id asc');
        $count = $this->model->getCount($where);
        $this->assign('product', $product);
        $this->assign('count', $count);
        $this->assign('name', $name);
        $this->assign('start', $start_time);
        $this->assign('end', $end_time);
        return $this->fetch();
    }


    public function productAdd()
    {
        $data = $this->cateAll();
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function doAdd()
    {
        $data = $this->request->param();
        $this->check($data);
        $data['seller_info'] = $data['editorValue'];
        unset($data['file']);//删除不需要的元素
        unset($data['editorValue']);

        $res = $this->model->save($data);

        if ($res) {
            $this->success('添加产品成功');
        } else {
            $this->error('添加产品失败');
        }


    }

    /**
     * 验证数据
     */
    protected function check($data)
    {
        $validate = new Validate($this->rule, $this->message);
        $result = $validate->check($data);
        if (!$result) {
            $this->error($validate->getError());
        }
    }

}