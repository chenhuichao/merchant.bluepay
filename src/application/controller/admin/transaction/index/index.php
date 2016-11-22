<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$request = array();
$request['type'] = RequestSvc::request('type');
$request['btype'] = RequestSvc::request('btype');
$request['orderid'] = RequestSvc::request('orderid');
$request['mobile'] = RequestSvc::request('mobile');
$request['tradeno'] = RequestSvc::request('tradeno');

$user = !empty($request['mobile']) ? (UserSvc::getUserInfoByMobile($request['mobile'])) : [];
$request['user_id'] = !empty($user) ? $user['id'] : RequestSvc::request('user_id');

$request['daystart'] = RequestSvc::request('daystart');
$request['dayend'] = RequestSvc::request('dayend');
$request['state'] = RequestSvc::request('state');
$request['merchant_id'] = RequestSvc::request('merchant_id');
$request['uid'] = !empty($request['merchant_id']) ? MerchantSvc::getUidByKey($request['merchant_id']) : '';

$results = TransactionSvc::lists($request,array('page'=>RequestSvc::request('p',1,'int'),'baseurl'=>'/transaction/?'));

$request['STATE_CONF'] = Transaction::$STATE_CONF;
$request['TYPE_CONF'] = Transaction::$TYPE_CONF;
$request['BTYPE_CONF'] = Transaction::$BTYPE_CONF;

LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('transaction/index.tpl');