<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

//定义站点域名
define('SITE_HOST', $_SERVER['HTTP_HOST']);
//带HTTP的域名
define('HTTP_SITE_NOPATH_HOST', "http://" . SITE_HOST);

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
//定义配置文件目录
define('CONF_PATH',__DIR__.'/../config/');

define('BASE_PATH',__DIR__);

// 执行应用并响应
Container::get('app')->run()->send();
