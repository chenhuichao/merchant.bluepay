<?php
    /*
     *图片显示
     */

    $_path = $_SERVER['ENV_DATA_DIR'].'/upload';
    $key = RequestSvc::request('key');
    $arr = Filepool::get($key);
    //$data = array('status'=>100,'msg'=>'File Not Found');
    if(is_array($arr)){
        $file = $_path.$arr['path'];
        if(file_exists($file)){
            header("Content-Type:".$arr['type']);
            $handle = fopen($file,"r");
            $con = fread($handle, filesize ($file));
            fclose($handle);
            echo $con;
        }
    }

