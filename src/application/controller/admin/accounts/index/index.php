<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();

$request['daystart'] = RequestSvc::request('daystart');
$request['dayend'] = RequestSvc::request('dayend');

$request['merchant_id'] = RequestSvc::request('merchant_id');
$request['uid'] = MerchantSvc::getUidByKey($request['merchant_id']);

$results = AccountsSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/accounts/?'));
$request['MERCHANT_TYPE_CONF'] = Merchant::$TYPE_CONF;
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('accounts/index.tpl');