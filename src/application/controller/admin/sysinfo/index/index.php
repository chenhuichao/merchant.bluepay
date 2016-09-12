<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$page = isset($_GET['p']) && $_GET['p'] > 0? intval($_GET['p']):1;
$request = array();
$request['keyword'] = RequestSvc::request('keyword','');

$results = SysinfoSvc::lists($request,array('page'=>$page,'baseurl'=>'/sysinfo/?'));

//var_dump($results);die();
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('sysinfo/index.tpl');