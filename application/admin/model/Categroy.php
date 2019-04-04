<?php
/**
 * User: may
 * Date: 2019/4/4
 * Time: 下午9:55
 */
namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function getlist($where = [], $field = "*", $order = "", $paginate = true, $limit = '', $param = [])
    {
        $query = $this->where($where)->field($field)->order($order);
        $page = '';
        $pageParam = [];
        if ($paginate) {
            //分页查询
            $limit = $limit ? $limit : 15;
            $result = $query->paginate($limit, false, ['query' => $param]);
            $page = $result->render();
            $data = $result->toArray();
            $data = $data['data'];
            $pageParam = [ //一些分页参数
                'total' => $result->total(),
                'listRows' => $result->listRows(),
                'currentPage' => $result->currentPage(),
                'lastPage' => $result->lastPage()
            ];
        } else {
            $result = $query->limit($limit)->select();
            $data = collection($result)->toArray();
        }
        return ['data' => $data, 'page' => $page, 'page_param' => $pageParam];
    }
}