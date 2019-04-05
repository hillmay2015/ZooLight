<?php
namespace app\admin\controller;

use app\admin\model\Categroy as CategoryModel;
use think\Db;
use app\common\traits\CategoryTraits;

class Category extends Admin
{
    protected $model;
    use CategoryTraits;

    public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
    }

    /**
     * 分类列表展示
     */
    public function cateList()
    {

        $list = $this->model->getlist();
        $this->assign('data', $list['data']);
        return $this->fetch();
    }

    public function cateAdd()
    {
        $data = $this->cateAll();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 添加分类
     */
    public function CateAddDo()
    {
        $data['name'] = $this->request->param('name', '');
        $data['pid'] = $this->request->param('pid', 0, 'intval');

        if (!empty($data['name'])) {
            if ($data['pid'] == 0) {
                //添加顶级分类
                $data['level'] = 1;
                $re = $this->model->insertGetId($data);
                $path['path'] = '0' . ',' . $re;
                $update = $this->model->update($path, ['id' => $re]);
                if ($update && $re) {
                    $this->success('顶级分类添加成功');
                } else {
                    $this->error('顶级分类添加失败');
                }
            }
            //添加子分类
            $condition['id'] = $data['pid'];
            $res = $this->model->findOneList($condition, 'path');
            $data['path'] = $res['path'];
            $data['level'] = substr_count($data['path'], ',');
            $re = $this->model->insertGetId($data);
            $path['path'] = $data['path'] . ',' . $re;
            $path['level'] = substr_count($path['path'], ',');
            $update = $this->model->update($path, ['id' => $re]);
            if ($update && $re) {
                $this->success('子分类添加成功');
            } else {
                $this->error('子分类添加失败');
            }
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