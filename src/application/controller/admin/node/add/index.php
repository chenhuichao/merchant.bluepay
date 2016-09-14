<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$type = isset($_GET['type'])?$_GET['type']:null;
$info = '';

$result = NodeSvc::getByParams(array('pid'=>'0'));
if($type == 'save'){
	$name = trim($_POST['name']);
	$title = $_POST['title'];
	$title_en = $_POST['title_en'];
	$action = trim($_POST['action']);
	$type = trim($_POST['type']);
	$pid = $_POST['pid'] > 0 ? intval($_POST['pid']) : 0;
	
	$record = NodeSvc::getById($pid);
	$module = is_object($record)?$record->name:'';
	$status = in_array($_POST['status'],array(Node::STATUS_DISABLE,Node::STATUS_ENABLE))?$_POST['status']:Node::STATUS_DISABLE;
	$remark = $_POST['remark'];
	$sort = $_POST['sort'] >= 0 ? intval($_POST['sort']) : 100;
	
	if(strlen($name) > 0){
		$params = array(
			'name'=>$name,
			'action'=>$action,
			'type'=>$type,
			'title'=>$title,
		    'title_en'=>$title_en,
			'pid'=>$pid,
			'status'=>$status,
			'remark'=>$remark,
			'sort'=>$sort,
			'module'=>$module,
		);
	
		NodeSvc::add($params);
	    $info = show_msg($_LANG_['response.message.success'], 'succ');
	}else{
		$info = show_msg($_LANG_['response.message.error'], 'err');
	}
}

LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('result',$result);
LoaderSvc::loadSmarty()->display('node/add.tpl');