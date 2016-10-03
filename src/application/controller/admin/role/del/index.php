<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = RequestSvc::Request('id');

if($id > 0){
	RoleSvc::delRecordById($id);
	$info = array('status'=>'0','msg'=>$_LANG_['response.message.success']);
}else{
	$info = array('status'=>'1','msg'=>$_LANG_['role.root.no_del']);
}
echo json_encode($info);
