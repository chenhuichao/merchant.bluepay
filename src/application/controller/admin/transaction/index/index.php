<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$request['id'] = RequestSvc::request('id');
$request['id_no'] = RequestSvc::request('id_no');
$request['mobile'] = RequestSvc::request('mobile');
$request['real_name'] = RequestSvc::request('real_name');
$request['nick_name'] = RequestSvc::request('nick_name');
$request['company_name'] = RequestSvc::request('company_name');
$request['business_license_no'] = RequestSvc::request('business_license_no');
$request['daystart'] = RequestSvc::request('daystart');
$request['dayend'] = RequestSvc::request('dayend');
$request['type'] = RequestSvc::request('type');
$request['state'] = RequestSvc::request('state');
$request['email'] = RequestSvc::request('email');

$results = TransactionSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/transaction/?'));

$request['STATE_CONF'] = TransactionS::$STATE_CONF;
$request['TYPE_CONF'] = TransactionS::$TYPE_CONF;
$request['BTYPE_CONF'] = TransactionS::$BTYPE_CONF;

LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('transaction/index.tpl');