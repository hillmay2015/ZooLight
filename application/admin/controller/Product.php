<?php
namespace app\admin\controller;

use app\common\traits\CategoryTraits;

class Product extends Admin
{
    use CategoryTraits;

    public function __construct()
    {
        parent::__construct();
    }

    public function productList()
    {
        return $this->fetch();
    }


    public function productAdd()
    {
        $data = $this->cateAll();
        $this->assign('data', $data);
        return $this->fetch();
    }

}