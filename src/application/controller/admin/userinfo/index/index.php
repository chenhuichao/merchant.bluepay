<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = $_POST['id'] > 0 ? $_POST['id'] : 0;
$record = AdminuserSvc::getById($id);
LoaderSvc::loadSmarty()->assign('session',LoaderSvc::loadSess()->get('session'));
$info = '';
if ($action == 'save' && is_object($record) && $uid == $id) {
  	$oldpass = trim($_POST['oldpass']);
	$newpass = $_POST['newpass'];
	$renewpass = $_POST['renewpass'];

	$record = AdminuserSvc::getById($uid);

	if(strlen($oldpass) == 0){
		$info = show_msg('原始密码不能为空', 'err');
		LoaderSvc::loadSmarty()->assign('info',$info);
		LoaderSvc::loadSmarty()->display('userinfo/index.tpl');
		exit;
	}

	if($record->passwd != md5($oldpass.md5($record->salt))){
		$info = show_msg('原始密码错误', 'err');
		LoaderSvc::loadSmarty()->assign('info',$info);
		LoaderSvc::loadSmarty()->display('userinfo/index.tpl');
		exit;
	}

    if($newpass != $renewpass || strlen($newpass) < 6 ){
        $info = show_msg('两次密码不一致或新密码长度小于6位', 'err');
        LoaderSvc::loadSmarty()->assign('oldpass',$oldpass);
		LoaderSvc::loadSmarty()->assign('info',$info);
		LoaderSvc::loadSmarty()->display('userinfo/index.tpl');
		exit;
    }

    $salt = UtlsSvc::random(5);
	$params = array(
		'passwd'=>md5($newpass.md5($salt)),
		'salt'=>$salt
	);
	AdminuserSvc::updateById($uid,$params);
	$info = show_msg('更新密码成功! <a href="/">重新登录</a>','succ');
	LoaderSvc::loadSmarty()->assign('info',$info);
	LoaderSvc::loadSess()->set('uid',null);

	//记录操作日志开始
	$operationlog = array(
		'uid'=>$uid,
		'entity'=>'adminuser',
		'pkid'=>$uid,
		'action'=>$_SERVER['REQUEST_URI'],
		'status'=>'Y',
		'desc'=>var_export($params, TRUE),
	);
	OperationlogSvc::add($operationlog);
	//记录操作日志结束
}

LoaderSvc::loadSmarty()->display('userinfo/index.tpl');
