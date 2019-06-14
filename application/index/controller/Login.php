<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:56 PM
 * 登录
 */
namespace app\index\controller;

use think\captcha\Captcha;
use think\Controller;
use app\common\common\Rsa;
use think\validate;
use app\index\model\User;

class Login extends Controller
{
    protected $rule = [
        'user_name' => 'require',
        'password' => 'require',
    ];

    protected $message = [
        'user_name.require' => '用户名不能为空',
        'password.require' => '密码不能为空',

    ];

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }


    public function index()
    {
        $rsa = new Rsa();
        $rsa_public = $rsa->getPublicKey();//获取公钥
        $this->assign('rsa_public', $rsa_public);
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
     * 登录
     */
    public function doLogin()
    {
        $data = $this->request->param();
        $rsa = new Rsa();
        $data['user_name'] = $rsa->privDecrypt($_POST['user_name']);//私钥解密
        $data['password'] = md5($rsa->privDecrypt($_POST['password']));//私钥解密
        $data['captcha'] = $_POST['captcha'];
        $this->check($data);
        array_pop($data);//删除最后一个元素

        $res = $this->model->findOneList($data);
        if ($res) {
            unset($res['password']);
            session('user_name', $res['user_name']);
            session('is_login', 1);//是否登录
            $this->success('登录成功', url('index/index'));
        } else {
            $this->error('登录失败', url('index'));
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
     * 退出
     */
    public function loginout()
    {
        session('user', '');
        session('islogin', '');
        $this->redirect('index');
    }
}