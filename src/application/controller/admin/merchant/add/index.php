<?php
require_once dirname(dirname(dirname(__FILE__))) . '/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
if ($action == 'do') {
    $type = RequestSvc::Request('type');
    $mobile = RequestSvc::Request('mobile');
    $email = RequestSvc::Request('email');
    $nick_name = RequestSvc::Request('nick_name');
    $real_name = RequestSvc::Request('real_name');

    $bank_card_no = RequestSvc::Request('bank_card_no');
    $bank_name = RequestSvc::Request('bank_name');
    $bank_of_deposit = RequestSvc::Request('bank_of_deposit');
    $id_no = RequestSvc::Request('id_no');
    $id_pic_0 = RequestSvc::Request('id_pic_0');

    $company_name = RequestSvc::Request('company_name');
    $contact = RequestSvc::Request('contact');
    $business_license_no = RequestSvc::Request('business_license_no');
    $business_license_pic = RequestSvc::Request('business_license_pic');

    $state = RequestSvc::Request('state');

    $type = in_array($type, array(
            Merchant::TYPE_COMPANY,
            Merchant::TYPE_PERSONAL
    )) ? $type : Merchant::TYPE_COMPANY;

    $state = in_array($state, array(
            Merchant::STATE_VALID,
            Merchant::STATE_INVALID
    )) ? $state : Merchant::STATE_INVALID;
    
    $params = array(
        'type'=>$type,
        'mobile'=>$mobile,
        'email'=>$email,
        'bank_card_no'=>$bank_card_no,
        'bank_name'=>$bank_name,
        'bank_of_deposit'=>$bank_of_deposit,
        'contact'=>$contact,
        'state'=>$state,
    );

    if($type == Merchant::TYPE_COMPANY){
        $params['business_license_pic'] = $business_license_pic;
        $params['business_license_no'] = $business_license_no;
        $params['company_name'] = $company_name;

        if(strlen($business_license_no) == 0){
            $info = show_msg($_LANG_['response.message.business_license_no.require'], 'err');
            goto ret;
        }
        $r = MerchantSvc::checkUnique('business_license_no',$business_license_no);
        if(!$r){
            $info = show_msg($_LANG_['response.message.business_license_no.exists'], 'err');
            goto ret;
        }
    }elseif($type == Merchant::TYPE_PERSONAL){
        $params['nick_name'] = $nick_name;
        $params['real_name'] = $real_name;
        $params['id_no'] = $id_no;
        $params['id_pic_0'] = $id_pic_0;

        if(strlen($id_no) == 0){
            $info = show_msg($_LANG_['response.message.id_no.require'], 'err');
            goto ret;
        }
        $r = MerchantSvc::checkUnique('id_no',$id_no);
        if(!$r){
            $info = show_msg($_LANG_['response.message.id_no.exists'], 'err');
            goto ret;
        }
    }

    $obj = MerchantSvc::add($params);

    if(is_object($obj)){
         $info = show_msg($_LANG_['response.message.success'], 'succ');
    }else{
         $info = show_msg($_LANG_['response.message.error'], 'err');
    }
}

ret:
$request = array();
$request['STATE_CONF'] = Merchant::$STATE_CONF;
$request['TYPE_CONF'] = Merchant::$TYPE_CONF;
$request['STATE_STV'] = Merchant::$STATE_STV;
$request['TYPE_STV'] = Merchant::$TYPE_STV;
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('info', $info);
LoaderSvc::loadSmarty()->display('merchant/add.tpl');