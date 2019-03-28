<?php
/**
 * User: may
 * Date: 2019/3/28
 * Time: 下午4:56
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function loginDo()
    {

    }
}