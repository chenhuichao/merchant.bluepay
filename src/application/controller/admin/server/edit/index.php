<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = $_REQUEST['id']>0 ? $_REQUEST['id'] : 0;
$record = ServerSvc::getById($id);

$info = '';
if(is_object($record)){
	$action = isset($_GET['action']) ? $_GET['action'] : null;
	if('save' == $action){
		$sgid = intval($_POST['sgid']);
		$ip = $_POST['ip'];
		$spath = $_POST['spath'];
		$stype = $_POST['stype'];
		$port = intval($_POST['port']);
		$sname = $_POST['sname'];
		$spass = $_POST['spass'];
		$edition = $_POST['edition'];
		$status = intval($_POST['status']);
		$params = array(
			'id'=>$id,
			'ctime'=>$ctime,
			'utime'=>$utime,
			'sgid'=>$sgid,
			'ip'=>$ip,
			'spath'=>$spath,
			'stype'=>$stype,
			'port'=>$port,
			'sname'=>$sname,
			'spass'=>$spass,
			'edition'=>$edition,
			'status'=>$status,
		);
		ServerSvc::updateById($id,$params);
		$record = ServerSvc::getById($id);
		$info = '操作成功';
	}
}else{
	$info = '数据异常';
}
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->display('server/edit.tpl');
