<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0 ? $_REQUEST['id'] : 0;
$record = WebsiteSvc::getById($id);

$info = '';
if(is_object($record)){
	$action = isset($_GET['action']) ? $_GET['action'] : null;
	if('save' == $action){
		$wname = $_POST['wname'];
		$control = $_POST['control'];
		$cpath = $_POST['cpath'];
		$uid = intval($_POST['uid']);
		$language = $_POST['language'];
		$params = array(
			'id'=>$id,
			'ctime'=>$ctime,
			'utime'=>$utime,
			'wname'=>$wname,
			'control'=>$control,
			'cpath'=>$cpath,
			'uid'=>$uid,
			'language'=>$language,
		);
        WebsiteSvc::updateById($id,$params);
		$record = WebsiteSvc::getById($id);
		$info = '操作成功';
	}
}else{
	$info = '数据异常';
}
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->display('website/edit.tpl');
