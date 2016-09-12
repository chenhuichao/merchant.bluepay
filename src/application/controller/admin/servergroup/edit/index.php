<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0 ? $_REQUEST['id'] : 0;
$record = ServergroupSvc::getById($id);

$info = '';
if(is_object($record)){
	$action = isset($_GET['action']) ? $_GET['action'] : null;
	if('save' == $action){
		$sgname = $_POST['sgname'];
		$params = array(
			'id'=>$id,
			'ctime'=>$ctime,
			'utime'=>$utime,
			'sgname'=>$sgname,
		);
		ServergroupSvc::updateById($id,$params);
		$record = ServergroupSvc::getById($id);
		$info = '操作成功';
	}
}else{
	$info = '数据异常';
}
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->display('servergroup/edit.tpl');
