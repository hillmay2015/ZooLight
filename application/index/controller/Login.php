<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:56 PM
 * 登录
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}