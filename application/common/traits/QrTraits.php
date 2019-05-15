<?php
/**
 * User: may
 * Date: 2019/5/14
 * Time: 上午11:42
 */
namespace app\common\traits;

Trait QrTraits
{
    function createQr($url = '')
    {
        require_once EXTEND_PATH . '/phpqrcode/phpqrcode.php';

        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 9;            //生成图片大小
        $object = new \QRcode();

        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);

    }
}