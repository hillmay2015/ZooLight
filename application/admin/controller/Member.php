<?php
/**
 * User: may
 * Date: 2019/3/28
 * Time: 下午2:19
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\User;

class Member extends Admin
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }

    public function memberList()
    {
        return $this->fetch();
    }

    public function memberAdd()
    {
        return $this->fetch();
    }

    public function doAdd(){
        $data = $this->request->param();
        print_r($data);
        $this->check($data);
        $data['seller_info'] = $data['editorValue'];
        unset($data['file']);//删除不需要的元素
        unset($data['editorValue']);

        $res = $this->model->save($data);

        if ($res) {
            $this->success('添加产品成功');
        } else {
            $this->error('添加产品失败');
        }

    }


    public function memberEdit()
    {
        return $this->fetch();
    }

    public function memberDel()
    {
        return $this->fetch();
    }

    public function memberShow()
    {
        return $this->fetch();
    }

    public function changePassword()
    {
        return $this->fetch();
    }
}