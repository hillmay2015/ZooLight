<?php
/**
 * User: may
 * Date: 2019/4/4
 * Time: 下午9:55
 */
namespace app\admin\model;

use think\Model;

class Categroy extends Model
{
    public function getlist($where = [], $field = "*", $order = "", $paginate = true, $limit = '', $param = [])
    {
        $query = $this->where($where)->field($field)->order($order);
        $page = '';
        if ($paginate) {
            //分页查询
            $limit = $limit ? $limit : 15;
            $result = $query->paginate($limit, false, ['query' => $param]);
            $page = $result->render();
            $data = $result->toArray();
            $data = $data['data'];
        } else {
            $result = $query->limit($limit)->select();
            $data = $result->toArray();
        }
        return ['data' => $data, 'page' => $page];
    }

    public function findOneList($where, $field = '*')
    {
        $result = $this->where($where)->find();
        return $result;
    }

}