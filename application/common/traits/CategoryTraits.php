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

    /**
     * 前端获取分类
     */
    private function getCategory()
    {
        $model = new Categroy();
        $type1 = $model->where(array('pid' => 0))->field('id,pid,name')->select();//获取一级分类
        $type1 = json_decode(json_encode($type1), true);
        $type2 = array();
        $type3 = array();
        foreach ($type1 as $k => $v) {
            $type1[$k]['child'] = array();
            $type2 = $model->where(array('pid' => $v['id']))->field('id,pid,name')->select();//获取二级分类
            $type2 = json_decode(json_encode($type2), true);
            foreach ($type2 as $key => $val) {
                array_push($type1[$k]['child'], $val);//合并一二级分类
                $type1[$k]['child'][$key]['child2'] = array();//组装三级分类的数组
                $type3 = $model->where(array('pid' => $val['id']))->field('id,pid,name')->select();//获取三级分类
                $type3 = json_decode(json_encode($type3), true);
                foreach ($type3 as $v2) {
                    array_push($type1[$k]['child'][$key]['child2'], $v2);
                }
            }

        }
        return $type1;

    }

}