<?php
function outPut($_RESULT,$type = 0){
	global $_LANG_;
	if($type == 0) {
		header('Content-type: application/json');
		$_RESULT['msg'] = isset($_RESULT['msg']) && !empty($_RESULT['msg']) ? $_RESULT['msg'] : $_LANG_[$_RESULT['code']];
		echo json_encode($_RESULT);
	}
	exit;
}

function getSessUid(){
	global $_SESS;
	if(isset($_SESS['logined']) && $_SESS['logined'] == 1 && isset($_SESS['uid'])){
		return intval($_SESS['uid']);
	}
	return 0;
}