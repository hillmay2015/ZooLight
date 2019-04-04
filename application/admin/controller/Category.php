<?php
namespace app\admin\controller;

class Category extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cateList()
    {
        return $this->fetch();
    }

    public function cateAdd()
    {
        return $this->fetch();
    }
}