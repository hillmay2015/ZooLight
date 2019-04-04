<?php
namespace app\admin\controller;

use app\admin\model\Categroy as CategoryModel;
use think\Db;

class Category extends Admin
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
    }

    public function cateList()
    {

        $list = $this->model->getlist();
        $this->assign('data', $list['data']);
        return $this->fetch();
    }

    public function cateAdd()
    {
        $res = $this->model->getlist('', "*,concat(path,',',pid) as paths", 'paths', false);
        $data = $res['data'];
        foreach ($data as $k => $v) {
            $data[$k]['id'] = $v['id'];
            $data[$k]['name'] = str_repeat('|---', $v['level']) . $v['name'];
        }

        $this->assign('data', $data);
        return $this->fetch();
    }

    public function getCateGory()
    {
        $category = $this->model->getlist('', 'id,pid as pId,name', '', false);

        if ($category) {
            $this->success('获取商品分类成功', '', $category['data']);
        } else {
            $this->error('获取商品分类失败');
        }

    }
}