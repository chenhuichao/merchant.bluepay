<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$type = isset($_GET['type'])?$_GET['type']:null;
$info = '';

if($type == 'save'){
	$name = $_POST['name'];

	if(strlen(trim($name)) > 0){
		$status = in_array($_POST['status'],array(Role::STATUS_DISABLE,Role::STATUS_ENABLE))?$_POST['status']:0;
		$remark = $_POST['remark'];
		$params = array(
			'name'=>$name,
			'pid'=>0,
			'status'=>$status,
			'remark'=>$remark
		);
		RoleSvc::add($params);
    	$info = show_msg('添加记录成功','succ');	
	}else{
		$info = show_msg('角色名称不能为空','err');	
	}
	
	
}

LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('role/add.tpl');