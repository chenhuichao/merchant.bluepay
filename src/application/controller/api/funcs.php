<?php
function outPut($_RESULT,$type = 0){
	global $_LANG_;
	if($type == 0) {
		header('Content-type: application/json');
		$_RESULT['msg'] = isset($_RESULT['msg']) ? $_RESULT['msg'] : $_LANG_[$_RESULT['code']];
		echo json_encode($_RESULT);
	}
	exit;
} 