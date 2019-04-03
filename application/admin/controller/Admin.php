<?php
/**
 * User: may
 * Date: 2019/4/3
 * Time: 下午3:11
 */
namespace app\admin\controller;

use think\Controller;
use think\facade\Session;

class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //判断是否登录
        $this->checkLogin();

    }

    public function checkLogin()
    {
        $member = Session::get('member');
        $login=$this->request->domain().'/admin/login';
        if (empty($member)) {
            exit("<script>top.location.href='{$login}'</script>");
        }
        //重置cookie过期时间
        cookie(session_name(), cookie(session_name()), ['expire'=>3600]);

    }
}