<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:56 PM
 * 登录
 */
namespace app\index\controller;

use think\captcha\Captcha;
use think\Controller;

class Login extends Controller
{
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
     * 登录
     */
    public function doLogin()
    {

    }
}