<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

$record = RoleSvc::getById($id);
if(is_object($record)){
	if($_POST['status'] == Role::STATUS_DISABLE){
	$status = Role::STATUS_ENABLE;
	}else{
		$status = Role::STATUS_DISABLE;
	}
	RoleSvc::updateById($id,array('status'=>$status));
	$info = array('status'=>'0','data'=>array('status'=>$status));
}
echo json_encode($info);
