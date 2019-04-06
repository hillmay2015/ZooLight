<?php
namespace app\admin\controller;

use app\common\traits\CategoryTraits;
use think\validate;
use app\admin\model\Product as ProductModel;

class Product extends Admin
{
    use CategoryTraits;

    protected $rule = [
        'name' => 'require',
        'sub_name' => 'require',
        'price' => 'require',
        'market_price' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'editorValue'=>'require',
        'file'=>'require',
    ];

    protected $message = [
        'name.require' => '请输入产品标题',
        'subname.require' => '请输入标题描述',
        'price.require' => '请输入展示价格',
        'market_price.require' => '请输入展示价格',
        'start_time.require' => '请输入展示价格',
        'end_time.require' => '请输入展示价格',
        'editorValue.require' => '请输入商家介绍',
        'file.require' => '请传入图片',

    ];

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }


    public function productList()
    {
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
        echo '<pre>';
        print_r($data);
        exit();
        $res=$this->model->insert($data);
        if($res){
            $this->success('添加产品成功');
        }else{
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