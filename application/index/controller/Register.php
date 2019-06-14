<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:56 PM
 * 注册
 */
namespace app\index\controller;

use think\App;
use think\Controller;
use think\captcha\Captcha;
use think\validate;
use app\index\model\User;
use app\common\common\Rsa;


class Register extends Controller
{
    protected $rule = [
        'user_name' => 'require|unique:user',
        'email' => 'require|unique:user|email',
        'password' => 'require',
    ];

    protected $message = [
        'user_name.require' => '用户名不能为空',
        'user_name.unique' => '用户名已存在',
        'email.require' => '邮箱不能为空',
        'email.email' => '邮箱格式不正确',
        'email.unique' => '邮箱已存在',
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
     * 注册数据提交
     */
    public function doRegister()
    {
        $param= $this->request->param();
        $rsa = new Rsa();
        $data['user_name'] = $rsa->privDecrypt($_POST['user_name']);//私钥解密
        $data['password'] = md5($rsa->privDecrypt($_POST['password']));//私钥解密
      //  $param['confirm_password']=$rsa->privDecrypt($_POST['confirm_password']);
        $data['email'] = $rsa->privDecrypt($_POST['email']);//私钥解密
        $data['captcha'] = $_POST['captcha'];
        $this->check($data);
//        if($param['password']!=$param['confirm_password']){
//            $this->error('两次输入的密码不一致');
//        }
        array_pop($data);//删除最后一个元素
        $res = $this->model->save($data);
        if($res){
            $this->success('注册成功,请先登录',url('login/index'));
        }else{
            $this->error('注册失败',url('index'));
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
}