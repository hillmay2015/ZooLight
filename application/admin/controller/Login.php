<?php
/**
 * User: may
 * Date: 2019/3/28
 * Time: 下午4:56
 */
namespace app\admin\controller;

use think\Controller;
use think\facade\Session;
use think\captcha\Captcha;
use think\Validate;
use app\admin\model\Admin as AdminModel;

class Login extends controller
{

    protected $rule = [
        'admin_name' => 'require',
        'password' => 'require',
        'captcha' => 'require',
    ];

    protected $message = [
        'admin_name.require' => '请输入登录账号',
        'password.require' => '请输入登录密码',
        'captcha.require' => '验证码不能为空',
    ];

    /**
     * 登录页面
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 生成验证码
     */
    public function verify()
    {
        $config = ['length' => 4, 'imageH' => 50];//验证码位数为4位,高度为50
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

    /**
     * 登录提交
     */
    public function loginPost()
    {
        $data = $this->request->param();
        $this->check($data);
        $model = new AdminModel();
        array_pop($data);//删除最后一个元素
        $result = $model->findOneList($data);
        if ($result) {
            Session::set('member', $data);
            $this->success('登录成功', url('index/index'));
        } else {
            $this->error('账号或密码错误');
        }
    }

    /**
     * 验证数据
     */
    protected function check($data)
    {
        $validate = new Validate($this->rule, $this->message);
        $result = $validate->check($data);
        if (!$result) {
            $this->error($validate->getError());
        }
        $captcha = new Captcha();
        if (!$captcha->check($data['captcha'])) {
            // 验证失败
            $this->error('验证码错误');
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::clear('member');
        $this->success('退出登录', url('login/index'));
    }
}