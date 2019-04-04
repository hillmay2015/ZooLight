<?php
namespace app\admin\controller;

class Product extends Admin
{
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
        return $this->fetch();
    }

}