<?php
/**
 * User: may
 * Date: 2019/3/28
 * Time: 下午4:56
 */
namespace app\admin\controller;

use think\Controller;
use think\facade\Session;

class Login extends controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 登录提交
     */
    public function loginPost()
    {
        $member = 1;
        Session::set('member', $member);
        $this->success('登录成功', 'index');
    }
}