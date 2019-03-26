<?php
/**
 * User: may
 * Date: 2019/3/26
 * Time: 下午3:45
 */
return [
    // 生成应用公共文件
    '__file__' => ['common.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    'admin'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['controller', 'model', 'view'],
        'controller' => ['Index', 'User', 'Product','Category','Menu'],
        'model'      => ['Index'],
        'view'       => ['index/index'],
    ],

    // 其他更多的模块定义
];
