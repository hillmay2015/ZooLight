<?php
namespace app\index\controller;

use app\admin\model\Categroy;
use think\Controller;
use app\common\traits\CategoryTraits;
use app\common\traits\ProductTraits;

class Index extends Controller
{
    use CategoryTraits;
    use ProductTraits;

    public function index()
    {
        $product = $this->getList();
        $type1 = $this->getCategory();
        $this->assign('type', $type1);
        $this->assign('product', $product);
        $this->assign('is_login', session('is_login') == 1 ? 1 : 0);
        $this->assign('user_name', !empty(session('user')) ? session('user') : '');
        return $this->fetch();
    }


}
