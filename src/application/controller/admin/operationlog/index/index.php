<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();

$results = OperationlogSvc::lists($request,array('page'=>intval($_GET['p']),'baseurl'=>'/operationlog/?'));
foreach($results['record'] as &$row){
	$temprecord = AdminuserSvc::getById($row['uid']);
	$row['realname'] = $temprecord->name;
	$row['time'] = date('Y-m-d H:i:s',$row['time']);
}

LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('operationlog/index.tpl');