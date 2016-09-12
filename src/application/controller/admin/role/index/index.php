<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$result = RoleSvc::getAll();
LoaderSvc::loadSmarty()->assign('result',$result);

$request['STATUS_STV'] = Role::$STATUS_STV; 
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->display('role/index.tpl');