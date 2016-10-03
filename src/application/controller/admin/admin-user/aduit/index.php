<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0?$_REQUEST['id']:0;
if($_POST['status'] == Adminuser::STATUS_DISABLE){
	$status = Adminuser::STATUS_ENABLE;
}else{
	$status = Adminuser::STATUS_DISABLE;
}
AdminuserSvc::updateById($id,array('status'=>$status));

$info = array('status'=>'0','data'=>array('status'=>$status));
$info['msg'] = $_LANG_['response.message.success'];
echo json_encode($info);
