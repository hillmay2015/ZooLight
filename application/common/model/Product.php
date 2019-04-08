<?php
/**
 * User: may
 * Date: 2019/4/8
 * Time: 下午5:13
 */
namespace app\common\model;

use think\Model;

Class Product extends Model
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
}

