<?php
namespace app\admin\controller;

use think\Config;
use think\Exception;
use think\Session;
use think\Controller;

class Index extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->view->engine->layout('layout/layout');
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
    }


}
