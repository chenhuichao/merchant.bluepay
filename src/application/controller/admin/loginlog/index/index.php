<?php
require_once dirname(dirname(dirname(__FILE__))) . '/header.php';

$page = isset($_GET['p']) && $_GET['p'] > 0 ? intval($_GET['p']) : 1;
$request = array();

$results = AdminuserSvc::loginLogLists($request, array('page' => $page, 'baseurl' => '/loginlog/?'));

foreach ($results['record'] as &$row) {
	$temprecord = AdminuserSvc::getById($row['uid']);
	$row['realname'] = $temprecord->name;
	$row['time'] = date('Y-m-d H:i:s', $row['time']);
}
LoaderSvc::loadSmarty()->assign('results', $results);
LoaderSvc::loadSmarty()->display('loginlog/index.tpl');