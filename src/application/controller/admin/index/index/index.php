<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

//提示修改初始密码  开始
$record = AdminuserSvc::getById($uid);
if($record->passwd == md5('123456'.md5($record->salt))){
	$resetpass = 1;
}else $resetpass = 0;
LoaderSvc::loadSmarty()->assign('resetpass',$resetpass);
//提示修改初始密码  结束
LoaderSvc::loadSmarty()->display('index/index.tpl');