<?php
namespace app\index\controller;

use app\admin\model\Categroy;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $type1=$this->getCategory();
        $this->assign('type', $type1);
        return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    /**
     * 获取分类
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
