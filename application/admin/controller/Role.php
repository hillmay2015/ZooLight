<?php
/**
 * User: may
 * Date: 2019/5/1
 * Time: 下午3:15
 * 角色管理
 */

namespace app\admin\controller;

use think\Db;


class Role extends Admin
{
    /**
     * 角色列表
     */
    public function roleList()
    {
        return $this->fetch();
    }

    public function roleAdd(){

    }
}
