<?php
/**
 * User: may
 * Date: 2019/4/6
 * Time: 下午4:18
 * 产品
 */
namespace app\index\controller;

use app\admin\model\Categroy;
use think\Controller;

class Product extends Controller
{
    public function detail()
    {
        return $this->fetch();
    }
}