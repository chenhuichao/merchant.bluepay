<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$request['name'] = RequestSvc::request('name');
$request['rid'] = RequestSvc::request('rid');
$results = AdminuserSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/admin-user/?'));

$request['STATUS_STV'] = Adminuser::$STATUS_STV; 
$request['RID_CONF'] = Adminuser::$RID_CONF;
$request['RID_STV'] = Adminuser::$RID_STV;

LoaderSvc::loadSmarty()->assign('rid',$rid);
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('admin-user/index.tpl');