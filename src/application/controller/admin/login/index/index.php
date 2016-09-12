<?php
$uid = LoaderSvc::loadSess()->get('uid');
$returl = isset($_REQUEST['returl']) ? $_REQUEST['returl'] : '/';
if($uid && LoaderSvc::loadSess()->get('APP_NAME') == APP_NAME){
    if(isset($_GET['type']) && $_GET['type'] == 'logout'){
		LoaderSvc::loadSess()->set('uid',null);
	}
	header("location:$returl");
}else{
	LoaderSvc::loadSess()->set('returl',urlencode($returl));
	LoaderSvc::loadSmarty()->display('login/index.tpl');
}