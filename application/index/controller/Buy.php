<?php
/**
 * User: may
 * Date: 2019/4/3
 * Time: 上午9:16
 * 购买
 */
namespace app\index\controller;

use think\Controller;

class Buy extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}