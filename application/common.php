<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * @param string $url
 */
function createQr($url = '')
{
    require_once EXTEND_PATH . '/phpqrcode/phpqrcode.php';

    $errorCorrectionLevel = 'L';    //容错级别
    $matrixPointSize = 5;            //生成图片大小

    $img = QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize, 2, EXTEND_PATH . '/phpqrcode/');
    return $img;
}