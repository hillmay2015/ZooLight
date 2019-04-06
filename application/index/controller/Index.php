<?php
namespace app\index\controller;

use app\admin\model\Categroy;
use think\Controller;
use app\common\traits\CategoryTraits;

class Index extends Controller
{
    use CategoryTraits;

    public function index()
    {
        $type1 = $this->getCategory();
        $this->assign('type', $type1);
        return $this->fetch();
    }


}
