<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$type = isset($_GET['type']) ? $_GET['type'] : null;

$id = RequestSvc::Request('id');
$record = RoleSvc::getById($id);

$info = '';
if($type == 'save'){
    $name = $_POST['name'];
	$pid = 0;
	$status = in_array($_POST['status'],array(Role::STATUS_DISABLE,Role::STATUS_ENABLE))?$_POST['status']:0;
	$remark = $_POST['remark'];
	$params = array(
		'name'=>$name,
		'pid'=>$pid,
		'status'=>$status,
		'remark'=>$remark
	);
	
	RoleSvc::UpdateById($id,$params);
	$record = RoleSvc::getById($id);
	$info = show_msg($_LANG_['response.message.success'], 'succ');
}

LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->display('role/edit.tpl');