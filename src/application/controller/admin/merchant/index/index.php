<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$request['id'] = RequestSvc::request('merchant_id');
$request['id_no'] = RequestSvc::request('id_no');
$request['mobile'] = RequestSvc::request('mobile');
$request['real_name'] = RequestSvc::request('real_name');
$request['business_license_no'] = RequestSvc::request('business_license_no');

$results = MerchantSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/merchant/?'));

$request['STATE_STV'] = Merchant::$STATE_STV;
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('merchant/index.tpl');