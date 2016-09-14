<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
if('do' == $action){
	$pid = RequestSvc::Request('pid');
	$branch = RequestSvc::Request('branch');
	$version = RequestSvc::Request('version');

	$params = array(
		'id'=>$id,
		'pid'=>$pid,
		'path'=>$path,
		'state'=>$state,
	);
	$obj = LibSvc::add($params);

	if(is_object($obj)){
		 $info = show_msg('操作成功', 'err');
	}else{
		 $info = show_msg('操作失败', 'err');
	}
}

$web = WebsiteSvc::lists(array());
$user = AdminuserSvc::getById($uid);
$auth = explode(',',$user->wid);
foreach($web['record'] as $key=>$val){
    if(!in_array($val['id'],$auth)){
        unset($web['record'][$key]);
    }
}

LoaderSvc::loadSmarty()->assign('web',$web);
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('lib/pull.tpl');
