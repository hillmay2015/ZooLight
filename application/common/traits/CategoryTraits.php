<?php
/**
 * User: may
 * Date: 2019/4/5
 * Time: 下午10:50
 */
namespace app\common\traits;

use app\admin\model\Categroy;
use Think\db;

trait CategoryTraits
{

    public function cateAll()
    {
        $model = new Categroy();
        $res = $model->getlist('', "*,concat(path,',',pid) as paths", 'paths', false);
        $data = $res['data'];
        foreach ($data as $k => $v) {
            $data[$k]['id'] = $v['id'];
            $data[$k]['name'] = str_repeat('|---', $v['level']) . $v['name'];
        }
        return $data;
    }
}