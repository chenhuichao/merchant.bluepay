<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$result = NodeSvc::getAll();
//var_dump($result);die();
LoaderSvc::loadSmarty()->assign('result',$result);
LoaderSvc::loadSmarty()->display('node/index.tpl');