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

$results = MerchantSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/merchant/?'));

$request['STATE_CONF'] = Merchant::$STATE_CONF;
$request['TYPE_CONF'] = Merchant::$TYPE_CONF;
$request['STATE_STV'] = Merchant::$STATE_STV;
$request['TYPE_STV'] = Merchant::$TYPE_STV;
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('merchant/index.tpl');