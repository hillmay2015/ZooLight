<?php
/**
 * User: may
 * Date: 2019/4/8
 * Time: 下午5:11
 * 查询产品公共方法
 */

namespace app\common\traits;

use Think\db;
use app\common\model\Product;

trait ProductTraits
{
    public function getList()
    {
        $model = new Product();
        $result = $model->getlist();
        return $result['data'];
    }
}
