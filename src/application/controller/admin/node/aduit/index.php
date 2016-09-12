<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0?$_REQUEST['id']:0;
if($_POST['status'] == Node::STATUS_DISABLE){
	$status = Node::STATUS_ENABLE;
}else{
	$status = Node::STATUS_DISABLE;
}
NodeSvc::updateById($id,array('status'=>$status));

$info = array('status'=>'0','data'=>array('status'=>$status));
$info['msg'] = '操作成功';
echo json_encode($info);
