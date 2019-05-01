<?php
/**
 * User: may
 * Date: 2019/5/1
 * Time: 下午9:33
 * 权限管理
 */
namespace app\admin\controller;


class Permission extends Admin
{
    /**
     * 权限管理列表
     */
    public function permissionList()
    {
        return $this->fetch();
    }
}
