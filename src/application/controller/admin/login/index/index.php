<?php
$uid = LoaderSvc::loadSess()->get('uid');
$returl = isset($_REQUEST['returl']) ? $_REQUEST['returl'] : '/';
if($uid && LoaderSvc::loadSess()->get('APP_NAME') == APP_NAME){
    if(isset($_GET['type']) && $_GET['type'] == 'logout'){
		LoaderSvc::loadSess()->set('uid',null);
	}
	header("location:$returl");
}else{
	if(isset($_GET['lang']) && in_array($_GET['lang'],['zh-CN','en-US'])){
		setcookie("_lang",$_GET['lang'],time() + 2592000);
		header("location:/login");
	}else{
		LoaderSvc::loadSess()->set('returl',urlencode($returl));
		LoaderSvc::loadSmarty()->display('login/index.tpl');
	}
}