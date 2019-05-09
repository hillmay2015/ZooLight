<?php
/**
 * Created by PhpStorm.
 * User: lj
 * Date: 2019/4/2
 * Time: 9:37 PM
 */
define('CSS','/static/index/css/');
define('JS','/static/index/js/');
define('IMAGE','/static/index/image/');
define('ADMIN_IMAGE','/static/admin/lib/webuploader/0.1.5/server/upload/');
define('COMMON_JS','/static/common/js/');
return [
    'template'=>[
        'layout_on'=>true,
        'layout_name'=>'layout/layout',
    ],
    // 应用调试模式
    'app_debug' => true,
    // 应用Trace
    'app_trace' => false,

];
