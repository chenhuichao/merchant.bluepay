<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$type = isset($_GET['type'])?$_GET['type']:null;
$id = RequestSvc::request('id');
$record = RoleSvc::getById($id);
$info = '';
if(is_object($record)){
	$auths = AccessSvc::getNidsByRoleId($id);
	//var_dump($auths);
	if($type == 'save'){
		$rid = $id;
		AccessSvc::delByParams(array('rid'=>$rid));
		$nids = explode('-',$_POST['nids']);
		
		//var_dump($nids);die();
		
		$modules = array();
		foreach($nids as $nid){
			$temprecord = NodeSvc::getById($nid);
			if(is_object($temprecord)){
				$pid = $temprecord->pid;
				$params = array(
					'rid'=>$rid,
					'nid'=>$nid,
					'pid'=>$pid,
				);
				AccessSvc::add($params);
				
				$precord = NodeSvc::getById($pid);
				if($precord->pid == 0){
					if(!in_array($pid,$modules))
						array_push($modules,$pid);
				}
				
			}
		}
		
		//添加模块权限
		foreach($modules as $nid){
			$params = array(
				'rid'=>$rid,
				'nid'=>$nid,
				'pid'=>0,
			);
			AccessSvc::add($params);
		}
		
		echo json_encode(array('status'=>'0'));
		exit;
	}

	$nodes = array();

	$modules = NodeSvc::getByParams(array('pid'=>0),'`sort` asc');
	foreach($modules as $k=>$row){
		$nodes[$k]['data'] = $row;
		$results = NodeSvc::getByParams(array('pid'=>$row['id']),'`id` asc');
		$nodes[$k]['record'] = $results;
	}
	
}else{
	$info = show_msg($_LANG_['framework.public.exception'],'warning');	
}

//var_dump($nodes);
LoaderSvc::loadSmarty()->assign('id',$id);
LoaderSvc::loadSmarty()->assign('record',$record);
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->assign('auths',$auths);
LoaderSvc::loadSmarty()->assign('nodes',$nodes);
LoaderSvc::loadSmarty()->display('role/auth.tpl');