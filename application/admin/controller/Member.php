<?php
/**
 * User: may
 * Date: 2019/3/28
 * Time: 下午2:19
 */
namespace app\admin\controller;

use think\Controller;

class Member extends Admin
{
    public function memberList()
    {
        return $this->fetch();
    }

    public function memberAdd()
    {
        return $this->fetch();
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