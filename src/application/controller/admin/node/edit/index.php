<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$type = isset($_GET['type'])?$_GET['type']:null;

$id = $_REQUEST['id']>0?$_REQUEST['id']:0;
$record = NodeSvc::getById($id);

$info = '';
if($type == 'save'){
	$name = trim($_POST['name']);
	$title = $_POST['title'];
	$action = trim($_POST['action']);
	$type = trim($_POST['type']);
	
	$pid = $_POST['pid'] > 0 ? intval($_POST['pid']) : 0;
	
	$record = NodeSvc::getById($pid);
	$module = is_object($record)?$record->name:'';
	$status = in_array($_POST['status'],array(Node::STATUS_DISABLE,Node::STATUS_ENABLE))?$_POST['status']:0;
	
	$ismenu = in_array($_POST['ismenu'],array('0','1'))?$_POST['ismenu']:0;
	
	$remark = $_POST['remark'];
	$sort = $_POST['sort'] >= 0 ? intval($_POST['sort']) : 100;
	
	if(strlen($name) > 0){
		$params = array(
			'name'=>$name,
			'action'=>$action,
			'type'=>$type,
			'title'=>$title,
			'pid'=>$pid,
			'status'=>$status,
			'remark'=>$remark,
			'ismenu'=>$ismenu,
			'sort'=>$sort,
			'module'=>$module,
		);
		NodeSvc::UpdateById($id,$params);
		$record = NodeSvc::getById($id);
		$info = show_msg('操作成功', 'succ');
	}else{
		$info = show_msg('操作失败', 'err');
	}
}
$result = NodeSvc::getByParams(array('pid'=>'0'));
LoaderSvc::loadSmarty()->assign('result',$result);
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->display('node/edit.tpl');