<?php
namespace app\admin\controller;

use app\common\traits\CategoryTraits;
use think\validate;
use app\admin\model\Product as ProductModel;

class Product extends Admin
{
    use CategoryTraits;

    protected $rule = [
        'admin_name' => 'require',
        'password' => 'require',
        'captcha' => 'require',
    ];

    protected $message = [
        'admin_name.require' => '请输入登录账号',
        'password.require' => '请输入登录密码',
        'captcha.require' => '验证码不能为空',
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