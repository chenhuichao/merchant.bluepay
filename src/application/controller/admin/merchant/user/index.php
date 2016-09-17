<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$request['id'] = RequestSvc::request('id');
$request['mobile'] = RequestSvc::request('mobile');
$request['email'] = RequestSvc::request('email');
$request['merchant_id'] = RequestSvc::request('merchant_id');
$request['state'] = RequestSvc::request('state');
$request['is_default'] = RequestSvc::request('is_default');

$results = UserSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/merchant/user?'));

$request['STATE_CONF'] = User::$STATE_CONF;
$request['IS_DEFAULT_CONF'] = User::$IS_DEFAULT_CONF;
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('merchant/user.tpl');