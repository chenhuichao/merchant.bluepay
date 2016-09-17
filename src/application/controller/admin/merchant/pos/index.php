<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$id = RequestSvc::request('id');
$temp = MerchantSvc::getPos($id);

$html = '';
if(!empty($temp)){
	$html = getData($temp);
}else{
	$html = '<p style="width:200px;height:50px;text-align:center;margin-top:30px;">有效记录为空</p>';
}

$data = array(
	'status'=>'0',
	'data'=>array(
		'title'=>'POS',
		'content'=>$html,
	),
);
echo json_encode($data);

function getData($results){
	global $_LANG_;
	$html = '<table class="table table-striped table-bordered"><tbody role="alert" aria-live="polite" aria-relevant="all">';
	$html .= '<tr><th>'.$_LANG_['framework.public.id'].'</th>';
	$html .= '<tr><th>'.$_LANG_['framework.public.sn'].'</th>';
	$html .= '<th>'.$_LANG_['framework.public.merchant_id'].'</th>';
	$html .= '<th>'.$_LANG_['framework.public.bind_user_id'].'</th>';
	$html .= '<th>'.$_LANG_['framework.public.mobile'].'</th>';
	$html .= '<th>'.$_LANG_['framework.public.ctime'].'</th>';
	$html .= '</tr>';
	foreach($results as $row){
		$record = UserSvc::getById($row['user_id']);
		$html .= '<tr><td>'.$row['id'].'</td>';
		$html .= '<td>'.$row['sn'].'</td>';
		$html .= '<td>'.$row['merchant_id'].'</td>';
		$html .= '<td>'.$row['user_id'].'</td>';
		$html .= '<td>'.$record->mobile.'</td>';
		$html .= '<td>'.$row['ctime'].'</td></tr>';
	}
    $html .= '</tbody></table>';
	return $html;
}