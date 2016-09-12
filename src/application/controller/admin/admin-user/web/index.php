<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$type = isset($_GET['type'])?$_GET['type']:null;
$id = RequestSvc::request('id');
$record = AdminuserSvc::getById($id);
$auths = array();
if($record->wid){
    $auths = explode(',',$record->wid);
}
$info = '';
if(is_object($record)){

	if($type == 'save'){

        $requset['wid'] = implode(',',$_POST['wid']);
		AdminuserSvc::updateById($id,$requset);
        $record = AdminuserSvc::getById($id);
        if($record->wid){
            $auths = explode(',',$record->wid);
        }
        $info = show_msg('操作成功', 'succ');
	}
	$website = array();
    $website = WebsiteSvc::lists(array());
}else{
	$info = show_msg('数据异常','warning');	
}

LoaderSvc::loadSmarty()->assign('id',$id);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->assign('auths',$auths);
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('website',$website);
LoaderSvc::loadSmarty()->display('admin-user/web.tpl');