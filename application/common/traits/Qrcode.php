<?php
/**
 * User: may
 * Date: 2019/5/14
 * Time: 上午11:42
 */
namespace app\common\traits;

class Qrcode
{
    function createQr($url = '')
    {
        require_once EXTEND_PATH . '/phpqrcode/phpqrcode.php';

        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 5;            //生成图片大小

        $img = QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize, 2, EXTEND_PATH . '/phpqrcode/');
        return $img;
    }
}