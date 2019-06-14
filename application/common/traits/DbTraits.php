<?php
/**
 * User: may
 * Date: 2019/4/5
 * Time: 下午9:14
 * 此方法为数据库基本操作的封装
 */
namespace app\common\traits;

use Think\db;

trait DbTraits
{
    /**
     * @param $where
     * @param string $field
     * @param string $order
     * @return mixed
     * 查询所有列表
     */
    public function selectAllList($where, $field = '*', $order = 'id desc')
    {
        $result = $this->where($where)->order($order)->select();
        return json_decode(json_encode($result),true);
    }

    /**
     * @param $where
     * @param string $field
     * @return mixed
     * 查询单条数据信息
     */
    public function findOneList($where, $field = '*')
    {
        $result = $this->where($where)->find();
        return $result;
    }

    /**
     * @param $where
     * @return mixed
     * 统计数据条数
     */
    public function getCount($where)
    {
        $result = $this->where($where)->Count();
        return $result;
    }

    /**
     * @param $where
     * @param $field
     * @return mixed
     * 统计数据总量
     */
    public function getSum($where, $field)
    {
        $result = $this->where($where)->Sum($field);
        return $result;
    }

    /**
     * @param $where
     * @param $data
     * @return mixed
     * 更新数据
     */
    public function updateData($where, $data)
    {
        $result = $this->where($where)->update($data);
        return $result;
    }
//
//    /**
//     * @param $where
//     * @return mixed
//     * 删除数据
//     */
//    public function deleteData($where)
//    {
//        $result = $this->where($where)->delete();
//        return $result;
//    }

    /**
     * @param $data
     * @return mixed
     * 插入数据
     */
    public function insert($data)
    {
        $result = $this->insertData($data);
        return $result;
    }
}