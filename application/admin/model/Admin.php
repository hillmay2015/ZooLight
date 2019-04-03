<?php
/**
 * User: may
 * Date: 2019/4/3
 * Time: 下午5:44
 */
namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function findOneList($where, $field = '*')
    {
        $result = $this->where($where)->find();
        return $result;
    }
}