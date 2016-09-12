<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0 ? $_REQUEST['id'] : 0;
$record = LiblogSvc::getById($id);

$info = '';
if(is_object($record)){
	$action = isset($_GET['action']) ? $_GET['action'] : null;
	if('save' == $action){
		$wid = intval($_POST['wid']);
		$cmd = $_POST['cmd'];
		$type = intval($_POST['type']);
		$result = $_POST['result'];
		$uid = intval($_POST['uid']);
		$cat = intval($_POST['cat']);
		$status = intval($_POST['status']);
		$params = array(
			'id'=>$id,
			'ctime'=>$ctime,
			'utime'=>$utime,
			'wid'=>$wid,
			'cmd'=>$cmd,
			'type'=>$type,
			'result'=>$result,
			'uid'=>$uid,
			'cat'=>$cat,
			'status'=>$status,
		);
		LiblogSvc::updateById($id,$params);
		$record = LiblogSvc::getById($id);
		$info = '操作成功';
	}
}else{
	$info = '数据异常';
}
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->display('liblog/edit.tpl');
