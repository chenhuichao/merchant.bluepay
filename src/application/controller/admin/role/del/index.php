<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = RequestSvc::Request('id');

if($id > 0){
	RoleSvc::delRecordById($id);
	$info = array('status'=>'0','msg'=>'删除记录成功');
}else{
	$info = array('status'=>'1','msg'=>'超管定义角色不能删除');
}
echo json_encode($info);
