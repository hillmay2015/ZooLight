<?php
namespace app\admin\controller;

class Category extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }
}