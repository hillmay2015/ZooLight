<?php
/**
 * User: may
 * Date: 2019/5/1
 * Time: 下午9:37
 * 管理员列表
 */
namespace app\admin\controller;


class Manager extends Admin
{
    /**
     * 权限管理列表
     */
    public function managerList()
    {
        return $this->fetch();
    }
}
