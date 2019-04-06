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
use app\common\traits\CategoryTraits;

class Product extends Controller
{
    use CategoryTraits;

    public function detail()
    {
        $type1 = $this->getCategory();
        $this->assign('type', $type1);
        return $this->fetch();
    }
}