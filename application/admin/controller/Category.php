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

    public function CateAddDo()
    {
        $data['name'] = $this->request->param('name','');
        $data['pid'] = $this->request->param('pid',0,'intval');


        if (!empty($data['name'])) {
            if ($data['pid'] == 0) {//添加顶级分类
                $data['level'] = 1;
                $re = Db::name('category')->insertGetId($data);
                $path['path'] = '0' . ',' . $re;
                Db::name('category')->where('id', $re)->update($path);
                $this->success('顶级添加分类成功');
            }
            //添加子分类
            $res = Db::name('category')->field('path')->find($data['pid']);
            $data['path'] = $res['path'];
            $data['level'] = substr_count($data['path'], ',');
            $re = Db::name('category')->insertGetId($data);
            $path['path'] = $data['path'] . ',' . $re;
            $path['level'] = substr_count($path['path'], ',');
            Db::name('category')->where('id', $re)->update($path);
            $this->success('添加分类成功');

        } else {
            $this->error('请填写分类名称');
        }

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