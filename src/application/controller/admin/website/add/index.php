<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

//编辑获取内容
$edit_id = $_GET['edit_id'];
if($edit_id){

    $result = WebsiteSvc::getById($edit_id);
    $res = array(
        "id"=>$result->id,
        "wname"=>$result->wname,
        "control"=>$result->control,
        "cpath"=>$result->cpath,
        "language"=>$result->language,
    );

    LoaderSvc::loadSmarty()->assign('request',$res);
}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$save_id = $_POST['save_id'];
$info = '';
if('save' == $action){
	$wname = $_POST['wname'];
	$control = $_POST['control'];
	$cpath = $_POST['cpath'];
	$language = $_POST['language'];
    if($wname && $cpath && $language){

        $params = array(
            'wname'=>$wname,
            'control'=>$control,
            'cpath'=>$cpath,
            'uid'=>$uid,
            'language'=>$language,
        );
        if($save_id){
            $params['utime'] = date("Y-m-d H:i:s");
            WebsiteSvc::updateById($save_id,$params);
            $params['id'] = $save_id;
        }else{
            $website = WebsiteSvc::add($params);
            $params['id'] = $website->id;
        }
        $info = show_msg('操作成功', 'succ');

    }else {
        $info = show_msg('操作失败', 'err');
    }

    LoaderSvc::loadSmarty()->assign('request',$params);
}

LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('website/add.tpl');
