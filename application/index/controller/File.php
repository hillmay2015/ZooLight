<?php
/**
 * User: may
 * Date: 2020/2/18
 * Time: 下午8:34
 * 文件下载
 */
namespace app\index\controller;

use think\Controller;

class File extends Controller
{

    public function index()
    {
        //文件列表
        return $this->fetch();
    }

    public function download()
    {
//        $file=fopen('http://104.224.166.36:8081/myetc.tar.gz',"r");
//
//        header("Content-Type: application/octet-stream");
//
//        header("Accept-Ranges: bytes");
//
//        header("Accept-Length: ".filesize('http://104.224.166.36:8081/myetc.tar.gz'));
//
//        header("Content-Disposition: attachment; filename=文件名称");
//
//        echo fread($file,filesize('http://104.224.166.36:8081/myetc.tar.gz'));
//
//        fclose($file);
        header('location:http://104.224.166.36:8081/myetc.tar.gz');

    }

}
