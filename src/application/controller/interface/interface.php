<?php
ob_start();
$filepath = $_SERVER['ENV_APPLOGS_DIR'].'/req.log';
LogSvc::fileLog($filepath,$_REQUEST);
foreach($_POST as $_k=>$_v){
	$_POST[$_k] = json_decode($_v);
}


$desc = '<pre style="color:orange;">
DEGUG .....'.date('Y-m-d H:i:s').'

Request:
	URI:'.$_SERVER['REQUEST_URI'].'
	Param:'.var_export($_REQUEST,true).
'</pre>';
SysinfoSvc::log($desc);

require_once __DIR__.'/auth/access-auth.php';

$_RESULT = array(
	'code'=>'OK',
);

/*
Process The Request
*/
$_Module = substr(RequestSvc::request('_M_'),0,20);
$_Func = substr(RequestSvc::request('_F_'),0,20);

$pattern = '/^([a-zA-Z]{1,20})$/i';
$r0 = preg_match($pattern,$_Module,$matches0);
$r1 = preg_match($pattern,$_Func,$matches1);
$_Logic_File = '';
if($r0 === 1 && $r1 === 1){
	$_Module = $matches0[0];
	$_Func = $matches1[0];
	$_Logic_File = __DIR__.'/'.$_Module.'/'.$_Func.'.php';
}

if(file_exists($_Logic_File)){
	include_once $_Logic_File;
}else{
	$desc = '<pre style="color:red;">Time:['.date('Y-m-d H:i:s').']
_Logic_File:['.$_Logic_File.']
IP:['.$_Client_IP.']	
REQUEST_URI:['.$_SERVER['REQUEST_URI'].']
PAMAMS:['.var_export($_REQUEST,true).']
_Module:['.$_Module.']
_Func:['.$_Func.']</pre>';
	SysinfoSvc::log($desc);
	if(isset($_REQUEST['_DEBUG_']) && APP_DEBUG == 1){
		echo 'Break Logic Include:';
		var_dump($_REQUEST);die();
	}else{
		exit;
	}
}
ob_clean();

$_Format = RequestSvc::request('_Format');
if('json' == $_Format){
	header('Content-type: application/json');
	echo json_encode($_RESULT);
}else{
	header("Content-Type: text/plain");
	echo serialize($_RESULT);
}

//if($_RESULT['code'] !== 'OK'){
	$desc = '<pre style="color:red;">
[Request]
URI:'.$_SERVER['REQUEST_URI'].'
Param:'.var_export($_REQUEST,true).'

[Response]
'.var_export($_RESULT,true).
'</pre>';
	SysinfoSvc::log($desc);
//}


