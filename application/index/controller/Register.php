<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:56 PM
 * 注册
 */
namespace app\index\controller;

use think\Controller;

class Register extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 注册数据提交
     */
    public function doRegister(){

    }
}