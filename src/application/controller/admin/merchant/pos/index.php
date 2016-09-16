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
		'title'=>'借款信息',
		'content'=>$html,
	),
);
echo json_encode($data);

function getData($results){
	$html = '<table class="table table-striped table-bordered">
			<tbody role="alert" aria-live="polite" aria-relevant="all">';
	foreach($results as $row){
		$html .= '<tr><th>'.$_LANG_['framework.public.id'].'</th><td>'.$row['id'].'</td></tr>';
		$html .= '<tr><th>'.$_LANG_['framework.public.sn'].'</th><td>'.$row['sn'].'</td></tr>';
		$html .= '<tr><th>'.$_LANG_['framework.public.merchant_id'].'</th><td>'.$row['merchant_id'].'</td></tr>';
		$html .= '<tr><th>'.$_LANG_['framework.public.user_id'].'</th><td>'.$result['user_id'].'</td></tr>';
		$html .= '<tr><th>'.$_LANG_['framework.public.ctime'].'</th><td>'.$result['ctime'].'</td></tr>';
	}
    $html .= '</tbody></table>';

	return $html;
}