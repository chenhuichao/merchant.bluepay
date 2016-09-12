<?php
include __DIR__.'/funcs.php';
/**
Auth Login
*/
$uid = LoaderSvc::loadSess()->get('uid');
if($uid && LoaderSvc::loadSess()->get('APP_NAME') == APP_NAME){
	$rid = AdminuserSvc::getById($uid)->rid;
	
	if(defined(WARNING_NOTIFICATION_EMAIL)){
		/**
		session hijacking start
		*/
		if(LoaderSvc::loadSess()->get('session-hijacking') != UtlsSvc::sessionHijacking($uid)){
			$desc = '<pre style="color:red;">Session Hijacking:UID['.$uid.']-['.LoaderSvc::loadSess()->get('name').']    FORWARD_IP['.UtlsSvc::getClientIp().']   URI:['.$_SERVER["REQUEST_URI"].']    REMOTE_ADDR:['.$_SERVER["REMOTE_ADDR"].']  	HTTP_USER_AGENT:['.$_SERVER["HTTP_USER_AGENT"].']    ['.date('Y-m-d H:i:s').']</pre>';
			//SysinfoSvc::add(array('desc'=>$desc));
			UtlsSvc::sendMail(array(WARNING_NOTIFICATION_EMAIL),$desc);
			die();
		}
		/**
		session hijacking end
		*/

		$_SIGNAL_ = (LoaderSvc::loadDBCache()->get($uid) == LoaderSvc::loadSess()->get('session-hijacking')) ? TRUE : FALSE;
		if(!$_SIGNAL_ && !UtlsSvc::inCompany()){
			$desc = '<pre style="color:green;">More Session Login:UID['.$uid.']-['.LoaderSvc::loadSess()->get('name').']    FORWARD_IP['.UtlsSvc::getClientIp().']   URI:['.$_SERVER["REQUEST_URI"].']    REMOTE_ADDR:['.$_SERVER["REMOTE_ADDR"].']   	HTTP_USER_AGENT:['.$_SERVER["HTTP_USER_AGENT"].']    ['.date('Y-m-d H:i:s').']</pre>';
	      	UtlsSvc::sendMail(array(WARNING_NOTIFICATION_EMAIL),$desc);
		}

		if(!UtlsSvc::inCompany()){
	        $desc = '<pre style="color:orange;">Not In Com:UID['.$uid.']-['.LoaderSvc::loadSess()->get('name').']    FORWARD_IP['.UtlsSvc::getClientIp().']   URI:['.$_SERVER["REQUEST_URI"].']    REMOTE_ADDR:['.$_SERVER["REMOTE_ADDR"].']    HTTP_USER_AGENT:['.$_SERVER["HTTP_USER_AGENT"].']    ['.date('Y-m-d H:i:s').']</pre>';
	        UtlsSvc::sendMail(array(WARNING_NOTIFICATION_EMAIL),$desc);
	    }

	}

	/**
	csrf start
	*/
	/*
	if(isset($_REQUEST['csrf'])){
		if($_REQUEST['csrf'] != LoaderSvc::loadSess()->get('csrf')){
			die("CSRF");
		}
		LoaderSvc::loadSess()->set('csrf',UtflSvc::uuid());
	}*/
	/**
	csrf end
	*/

    //no ajax 
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		$menu = AccessSvc::getMenuByUid($uid);
		$name = LoaderSvc::loadSess()->get('name');
		LoaderSvc::loadSmarty()->assign('rname', Adminuser::$RID_CONF[$rid]['NAME']);
		$session = LoaderSvc::loadSess()->get('session');
		LoaderSvc::loadSmarty()->assign('menu',$menu);
		LoaderSvc::loadSmarty()->assign('uid',$uid);
		LoaderSvc::loadSmarty()->assign('name',$name);
		LoaderSvc::loadSmarty()->assign('session',$session);

		//多语言处理
		$lang = getPreferredLanguage();
		$lang = in_array($lang,array('zh-CN','en-US','id-ID')) ? $lang : 'zh-CN';
		include ROOT_PATH.'/src/application/lang/'.$lang.'.php';
		LoaderSvc::loadSmarty()->assign('_LANG_',$_LANG_);
	}

	$auth = AdminuserSvc::auth($uid);
	if($auth == false){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			echo json_encode(array('status'=>ErrorSvc::ERR_AUTHINFO_ERROR,'msg'=>'ERR_AUTHINFO_ERROR'));
		}else{
			LoaderSvc::loadSmarty()->assign('info','Permission Denied');
			LoaderSvc::loadSmarty()->display('error/auth.tpl');
		}
		exit();
	}
}else{
	header("location:/login/");
	exit();
}