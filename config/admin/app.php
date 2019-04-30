<?php


define('CSS','/static/admin/h-ui/css/');
define('JS','/static/admin/h-ui/js/');
define('IMAGES','/static/admin//h-ui/images/');

define('ADMIN_CSS','/static/admin/h-ui.admin/css/');
define('ADMIN_JS','/static/admin/h-ui.admin/js/');
define('ADMIN_IMAGES','/static/admin/h-ui.admin/images/');
define('ADMIN_SKIN','/static/admin/h-ui.admin/skin/');

define('COMMON_JS','/static/common/js/');

define('LIB','/static/admin/lib/');

return [
    'template'=>[
        'layout_on'=>true,
        'layout_name'=>'layout',
    ],
    // 应用调试模式
    'app_debug' => true,
    // 应用Trace
    'app_trace' => true,
    'default_filter' => 'trim',
];
