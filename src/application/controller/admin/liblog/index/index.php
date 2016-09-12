<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$request['id']  = RequestSvc::Request('id');
$request['type']  = RequestSvc::Request('type');
$request['state']  = RequestSvc::Request('state');
$request['daystart']  = RequestSvc::Request('daystart');
$request['dayend']  = RequestSvc::Request('dayend');
$results = LiblogSvc::lists($request,array('page'=>RequestSvc::Request('p',1,'int'),'baseurl'=>'/liblog/?'));
$user = AdminuserSvc::getById($uid);
$auth = explode(',',$user->wid);
$num = 0;
foreach ($results['record'] as $key=>&$row) {

    if(!in_array($row['wid'],$auth)){
        unset($results['record'][$key]);
    }

	$row['num'] = ++$num;
	$row['wname'] = WebsiteSvc::getById($row['wid'])->wname;
	$row['tname'] = Liblog::$TYPE_CONF[$row['type']]['NAME'];
	$row['aname'] = AdminuserSvc::getById($row['uid'])->name;
	$row['sname'] = Liblog::$STATE_CONF[$row['state']]['NAME'];
	$row['result'] = addslashes(htmlspecialchars($row['result']));
}


$request['TYPE_CONF_STV'] = Liblog::$TYPE_CONF_STV;
$request['STATE_CONF_STV'] = Liblog::$STATE_CONF_STV;

LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('liblog/index.tpl');
