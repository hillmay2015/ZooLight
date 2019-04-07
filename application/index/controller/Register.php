<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:56 PM
 * 注册
 */
namespace app\index\controller;

use think\App;
use think\Controller;
use think\captcha\Captcha;
use think\validate;


class Register extends Controller
{
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
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }

    public function index()
    {
        return $this->fetch();
    }

    /**
     * 生成验证码
     */
    public function verify()
    {
        $config = ['length' => 4, 'imageH' => 50];//验证码位数为4位,高度为50
        $captcha = new Captcha($config);
        return $captcha->entry();
    }


    /**
     * 注册数据提交
     */
    public function doRegister()
    {
        $data = $this->request->param();
        $this->check($data);
        array_pop($data);//删除最后一个元素
        $res = $this->model->save($data);

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
        $captcha = new Captcha();
        if (!$captcha->check($data['captcha'])) {
            // 验证失败
            $this->error('验证码错误');
        }
    }
}