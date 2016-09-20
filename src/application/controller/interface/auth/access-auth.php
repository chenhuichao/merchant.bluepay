<?php
$_Allow_Access_IP = array(
	'127.0.0.1',
	'192.168.1.196',
	'192.168.1.222',
);

$_Allow_Access_App = array(
	'101',
);

/*
Auth Request Source Begin
*/
/*
$_Client_IP = UtlsSvc::getClientIP();
if(!in_array($_Client_IP,$_Allow_Access_IP)){
	$desc = '<pre style="color:red;">
Time:['.date('Y-m-d H:i:s').']
IP:['.$_Client_IP.']
REQUEST_URI:['.$_SERVER['REQUEST_URI'].']
PAMAMS:['.var_export($_REQUEST,true).']
</pre>';
	//echo 'desc:'.$desc;
	SysinfoSvc::log($desc);
	if(isset($_REQUEST['_DEGUG_']) && DEBUG_ON === 1){
		echo 'Break Auth IP:';
		var_dump($_REQUEST);die();
	}else{
		exit;
	}
}*/

$tmparr = explode('|',$_SERVER['HTTP_AUTHORIZATION']);
$_App_Id = isset($_REQUEST['appid']) ? $_REQUEST['appid'] : $tmparr[1];
if(!in_array($_App_Id,$_Allow_Access_App)){
	$desc = '<pre style="color:red;">
Time:['.date('Y-m-d H:i:s').']
IP:['.$_Client_IP.']
REQUEST_URI:['.$_SERVER['REQUEST_URI'].']
PAMAMS:['.var_export($_REQUEST,true).']
</pre>';

	//echo 'desc:'.$desc;
	SysinfoSvc::log($desc);

	if(isset($_REQUEST['_DEGUG_']) && DEBUG_ON === 1){
		echo 'Break Auth App:';
		var_dump($_REQUEST);die();
	}else{
		exit;
	}
}
/*
Auth Request Source End
*/