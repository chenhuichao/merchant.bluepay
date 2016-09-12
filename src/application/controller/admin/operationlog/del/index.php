<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id'] > 0 ? $_REQUEST['id'] : 0;
OperationlogSvc::delRecordById($id);

$info = array('status'=>'0');
$info['msg'] = '删除记录成功';
echo json_encode($info);
