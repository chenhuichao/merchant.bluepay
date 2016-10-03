<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0?$_REQUEST['id']:0;
AdminuserSvc::delRecordById($id);

$info = array('status'=>'0');
$info['msg'] = $_LANG_['response.message.success'];
echo json_encode($info);
