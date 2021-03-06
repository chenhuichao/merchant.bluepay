<?php

class UtlsSvc
{/*{{{*/
	static public function u82gb($mix)
	{/*{{{*/
		if (is_array($mix)) {
			foreach ($mix as $k => $v) {
				$mix[$k] = self::u82gb($v);
			}
		} else {
			$mix = mb_convert_encoding(str_replace('•', '·', $mix), 'gbk', 'utf-8');
		}

		return $mix;
	}/*}}}*/

	static public function gb2u8($mix)
	{/*{{{*/
		if (is_array($mix)) {
			foreach ($mix as $k => $v) {
				$mix[$k] = self::gb2u8($v);
			}
		} else {
			$mix = mb_convert_encoding($mix, 'utf-8', 'gbk');
			//$mix = iconv(  'gb2312', 'utf-8', $mix);
		}

		return $mix;
	}/*}}}*/

	static public function reDirect($url = '/', $params = array())
	{/*{{{*/
		if (!empty($params)) {
			$url .= '?';
			$url .= http_build_query($params);
		}
		header('location:' . $url);
		exit;
	}/*}}}*/

	static public function obj2array($obj)
	{/*{{{*/
		$out = array();
		foreach ($obj as $key => $val) {
			switch (true) {
				case is_object($val):
					$out[$key] = self::obj2array($val);
					break;
				case is_array($val):
					$out[$key] = self::obj2array($val);
					break;
				default:
					$out[$key] = $val;
			}
		}
		return $out;
	}/*}}}*/

	static public function fenToYuan($fen)
	{/*{{{*/
		if (empty($fen) || !is_numeric($fen)) {
			return 0;
		}
		$result = number_format($fen / 100, 2, '.', '');
		return $result;
	}/*}}}*/

	//不带小数的元
	static public function fenToYuanInt($fen)
	{/*{{{*/
		if (empty($fen) || !is_numeric($fen)) {
			return 0;
		}
		if (($fen % 100) > 0) {
			$result = number_format($fen / 100, 2, '.', '');
		} else {
			$result = number_format($fen / 100, 0, '', '');
		}
		return $result;
	}/*}}}*/

	static public function yuanToFen($yuan)
	{/*{{{*/
		if (empty($yuan) || !is_numeric($yuan)) {
			return 0;
		}
		$result = number_format($yuan * 100, 0, '', '');
		return $result;
	}/*}}}*/

	static public function call($url, $time_out = 30)
	{/*{{{*/
		if ('' == $url) {
			return false;
		}

		$url_ary = parse_url($url);
		if (!isset($url_ary['host'])) {
			return false;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_NOPROGRESS, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)');

		$http_header = array();
		$http_header[] = 'Connection: close';
		$http_header[] = 'Pragma: no-cache';
		$http_header[] = 'Cache-Control: no-cache';
		$http_header[] = 'Accept: */*';
		$http_header[] = 'Host: ' . $url_ary['host'];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);

		$result = curl_exec($ch);
		if($result === false){
		    echo 'Curl error: ' . curl_error($ch);
		}
		curl_close($ch);
		return $result;
	}/*}}}*/

	static public function remote_get_contents($url, $expire = 600)
	{
		$filename = md5($url);
		if (!is_dir($_SERVER['ENV_CACHE_DIR'] . '/remote/')) {
			mkdir($_SERVER['ENV_CACHE_DIR'] . '/remote/', 0755);
		}
		$file = $_SERVER['ENV_CACHE_DIR'] . '/remote/' . $filename;
		if (is_file($file) && (filemtime($file) + $expire > time())) {
			return file_get_contents($file);
		}
		$content = UtlsSvc::simpleRequest($url);
		if (strlen($content) > 100) {
			file_put_contents($file, $content);
		} else {
			if (is_file($file)) {
				return file_get_contents($file);
			} else {
				return '';
			}
		}
		return $content;
	}

	static public function simpleRequest($url, $post_data = array(), $option = array())
	{/*{{{*/
		//使用http_build_query拼接post
		if ('' == $url) {
			return false;
		}
		$url_ary = parse_url($url);
		if (!isset($url_ary['host'])) {
			return false;
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		curl_setopt($ch, CURLOPT_HEADER, ($option['CURLOPT_HEADER'] === true));
		if ($option['referer'] != '') {
			curl_setopt($ch, CURLOPT_REFERER, $option['referer']);
		}
		if (!empty($post_data)) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
		}
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36');

		$http_header = array();
		$http_header[] = 'Connection: close';
		$http_header[] = 'Pragma: no-cache';
		$http_header[] = 'Cache-Control: no-cache';
		$http_header[] = 'Accept: */*';
		if (isset($option['header'])) {
			foreach ($option['header'] as $header) {
				$http_header[] = $header;
			}
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (!isset($option['timeout'])) {
			$option['timeout'] = 15;
		}

		curl_setopt($ch, CURLOPT_TIMEOUT, $option['timeout']);
		$result = curl_exec($ch);
// 		if($result === false){
// 		    echo 'Curl error: ' . curl_error($ch);
// 		}
		curl_close($ch);
		return $result;
	}/*}}}*/

	static public function array2json($arr)
	{/*{{{*/
		return json_encode(self::gb2u8($arr));
	}/*}}}*/

	static public function getClientIP()
	{/*{{{*/
		if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		} elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		} elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		} elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}/*}}}*/

	static public function get_ip_address($ip)
	{
		if ($ip == '127.0.0.1') return 'IP：' . $ip . ' 来自：本地';
		$content = self::simpleRequest("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
		$ipdata = json_decode($content, true);
		$ipaddress = " " . $ipdata['data']['country'] . "-" . $ipdata['data']['area'] . "-" . $ipdata['data']['region'] . "-" . $ipdata['data']['city'] . "-" . $ipdata['data']['county'] . $ipdata['data']['isp'] . "";
		return $ipaddress;
	}

	/*
	*返回地址数组
	*/
	static public function get_ip_address2($ip)
	{
		if ($ip == '127.0.0.1' || empty($ip)) {
			return array();
		}

		$content = self::simpleRequest("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
		$ipdata = json_decode($content, true);

		if ($ipdata['data']) {
			$address['country'] = $ipdata['data']['country'];
			$address['area'] = $ipdata['data']['area'];
			$address['region'] = $ipdata['data']['region'];
			$address['city'] = $ipdata['data']['city'];
			$address['county'] = $ipdata['data']['county'];
			$address['isp'] = $ipdata['data']['isp'];
		} else {
			$address = array();
		}
		return $address;
	}

	static public function get_ip_province($ip)
	{
		if ($ip == '127.0.0.1') return 'IP：' . $ip . ' 来自：本地';
		$content = self::simpleRequest("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
		$ipdata = json_decode($content, true);
		$ipaddress = $ipdata['data']['region'];
		return $ipaddress;
	}

	static public function getRemoteIP()
	{/*{{{*/
		return $_SERVER['REMOTE_ADDR'];
	}/*}}}*/

	static public function array2xml($array)
	{/*{{{*/
		$xml = '<?xml version="1.0" encoding="UTF-8"?><root>';
		foreach ($array as $k => $v) {
			$xml .= "<" . $k . ">";
			if (is_array($v)) {
				$xml .= self::array2xml_node($v);
			} else {
				$xml .= htmlspecialchars(mb_convert_encoding($v, 'utf-8', 'gbk'));
			}
			$xml .= "</" . $k . ">";
		}
		$xml .= '</root>';
		return $xml;
	}/*}}}*/

	static private function array2xml_node($array)
	{/*{{{*/
		$xml = '';
		foreach ($array as $k => $v) {
			if (is_numeric($k)) {
				$k = 'item';
			}
			$xml .= "<" . $k . ">";
			if (is_array($v)) {
				$xml .= self::array2xml_node($v);
			} else {
				$xml .= htmlspecialchars(mb_convert_encoding($v, 'utf-8', 'gbk'));
			}
			$xml .= "</" . $k . ">";
		}
		return $xml;
	}/*}}}*/

	public static function xml2array($xml)
	{/*{{{*/
		libxml_use_internal_errors(true);
		if (empty($xml)) return false;
		if (is_string($xml)) $xml = simplexml_load_string($xml, null, LIBXML_NOCDATA);
		if ($xml === false) return false;

		$children = $xml->children();
		if (!$children) return (string)$xml;
		$arr = array();
		foreach ($children as $key => $node) {
			$node = self::xml2array($node);

			if ($key == 'item') $key = count($arr);

			// if the node is already set, put it into an array
			if (isset($arr[$key])) {
				if (!is_array($arr[$key]) || $arr[$key][0] == null) $arr[$key] = array($arr[$key]);
				$arr[$key][] = $node;
			} else {
				$arr[$key] = $node;
			}
		}
		return $arr;
	}/*}}}*/

	public static function htmlspecialcharsRecursive($value)
	{/*{{{*/
		if (is_numeric($value)) {
			return $value;
		}
		if (is_string($value)) {
			return htmlspecialchars($value);
		}
		if (is_array($value)) {
			foreach ($value as $k => $v) {
				$value[$k] = self::htmlspecialcharsRecursive($v);
			}
			return $value;
		}
		if (is_object($value)) {

			foreach ($value as $k => $v) {
				$value->$k = self::htmlspecialcharsRecursive($v);
			}
			return $value;
		}
		return $value;
	}/*}}}*/

	public function tmplog($msg)
	{/*{{{*/
		error_log("\n[" . date('H:i:s') . " " . $_SERVER['REMOTE_ADDR'] . "]" . $msg, 3, "/tmp/log-" . date('Ymd') . ".log");
	}/*}}}*/

	public function encode_uri_json($arr)
	{/*{{{*/
		$out = array();
		foreach ($arr as $k => $v) {
			if (is_array($v)) {
				$out[] = $k . ":'" . self::encode_uri_json($v) . "'";
			} else {
				$out[] = $k . ":'" . addslashes(self::gb2u8($v)) . "'";
			}
		}
		$output = '{' . implode(',', $out) . '}';
		return $output;
	}/*}}}*/


	public function showMsg($alert, $url, $time = 12)
	{/*{{{*/
		$time = $time * 1000;
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><script src="public/js/jquery-1.7.2.min.js"></script><script src="/public/js/public/msg_util.js"></script><link rel="stylesheet" href="/public/css/public/public.css" /></head><body>';
		echo "<script>MsgUtil.show('" . addslashes($alert) . "',function(){window.location.href='" . $url . "';},$time);</script>";
		echo "</body></html>";
		exit;
	}/*}}}*/

	//截取字符串
	function cutstr($string, $length, $dot = '')
	{
		$str = $string;
		$cutlen = 0;
		$cutstr = '';

		$wordLen = mb_strlen($string, 'utf-8');

		if ($length > $wordLen) {
			return $str;
		}

		for ($i = 0; $i < $length * 2; $i++) {
			$one = mb_substr($str, 0, 1, 'utf-8');
			if (strlen($one) > 1) {
				$cutlen = $cutlen + 2;
			} else {
				$cutlen = $cutlen + 1;
			}
			$cutstr .= $one;
			$str = mb_substr($str, 1, mb_strlen($str), 'utf-8');
			if ($cutlen >= $length * 2) {
				break;
			}
		}
		return $cutstr . $dot;
	}

	//截取字符串 等宽
	function cutstr1($string, $length, $dot = '')
	{
		$str = $string;
		$cutlen = 0;
		$cutstr = '';

		$wordLen = mb_strlen($string, 'utf-8');

		if ($length > $wordLen) {
			return $str;
		}

		for ($i = 0; $i < $length; $i++) {
			$one = mb_substr($str, 0, 1, 'utf-8');
			if (strlen($one) > 1) {
				$cutlen = $cutlen + 2;
			} else {
				$cutlen = $cutlen + 1;
			}
			$cutstr .= $one;
			$str = mb_substr($str, 1, mb_strlen($str), 'utf-8');
			if ($cutlen >= $length) {
				break;
			}
		}
		return $cutstr . $dot;
	}

	public function checkMobile($str)
	{
		$pattern = "/^(13|15|18|14)\d{9}$/";
		if (preg_match($pattern, $str)) {
			Return true;
		} else {
			Return false;
		}
	}

	public function isIpad()
	{
		return strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false;
	}

	public function isIOS()
	{
		return (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false)
		|| (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false)
		|| (strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== false);
	}

	public function isAndroid()
	{
		return (strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false);
	}

	public function inCompany()
	{
		$ip = $_SERVER['REMOTE_ADDR'];

		if (substr($ip, 0, 8) == '192.168.') {
			return true;
		}
		if (in_array($ip, array('127.0.0.1', '111.206.165.43'))) {
			return true;
		}
		return false;
	}

	static public function hexdec_big($hex)
	{
		$ret = 0;
		$c = 0;
		while (strlen($hex) > 0) {
			$h = substr($hex, -1);
			$d = base_convert($h, 16, 10);
			$ret = bcadd($ret, bcmul(bcpow(16, $c, 0), $d, 0), 0);
			$hex = substr($hex, 0, -1);
			$c++;
		}
		return $ret;
	}

	/*
	*只读模式
	*/
	public static function isReadonly()
	{
		return $_SERVER['READONLY_MODE'] == "1";
	}

	public function numToCny($num)
	{
		$capUnit = array('万', '亿', '万', '圆', '');  //单元
		$capDigit = array(2 => array('角', '分', ''), 4 => array('仟', '佰', '拾', ''));
		$capNum = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
		if ((strpos(strval($num), '.') > 16) || (!is_numeric($num)))
			return '';
		$num = sprintf("%019.2f", $num);
		$CurChr = array('', '');
		for ($i = 0, $ret = '', $j = 0; $i < 5; $i++, $j = $i * 4 + floor($i / 4)) {
			$nodeNum = substr($num, $j, 4);
			for ($k = 0, $subret = '', $len = strlen($nodeNum); (($k < $len) && (intval(substr($nodeNum, $k)) != 0)); $k++) {
				$CurChr[$k % 2] = $capNum[$nodeNum{$k}] . (($nodeNum{$k} == 0) ? '' : $capDigit[$len][$k]);
				if (!(($CurChr[0] == $CurChr[1]) && ($CurChr[$k % 2] == $capNum[0])))
					if (!(($CurChr[$k % 2] == $capNum[0]) && ($subret == '') && ($ret == '')))
						$subret .= $CurChr[$k % 2];
			}
			$subChr = $subret . (($subret == '') ? '' : $capUnit[$i]);
			if (!(($subChr == $capNum[0]) && ($ret == ''))) {
				$ret .= $subChr;
			}
		}
		$ret = ($ret == "") ? $capNum[0] . $capUnit[3] : $ret;
		return $ret;
	}

	/*
	*根据手机号获取手机归属地等信息
	*/
	public static function getMobileInfo($mobile)
	{
		$page = self::simpleRequest('http://opendata.baidu.com/api.php?query=' . $mobile . '&co=&resource_id=6004&t=' . time() . '&ie=utf8&oe=gbk&cb=bd__cbs__854nlx&format=json&tn=baidu');

		$page = iconv('gbk', 'utf-8', substr(str_replace('bd__cbs__854nlx(', '', $page), 0, -2));

		$json = json_decode($page);
		$city = $json->data[0]->city;//城市
		$operators = $json->data[0]->type;//归属地
		$prov = $json->data[0]->prov;//省份
		return array('city' => $city, 'operators' => $operators, 'prov' => $prov);

	}


	/**
	 * 二维数组排序
	 *
	 * @param $arr :数据
	 * @param $keys :排序的健值
	 * @param $type :升序/降序
	 *
	 * @return array
	 */
	public static function arraySort($arr, $keys, $type = "asc")
	{
		if (!is_array($arr)) {
			return false;
		}
		$keysvalue = array();
		foreach ($arr as $key => $val) {
			$keysvalue[$key] = $val[$keys];
		}
		if ($type == "asc") {
			asort($keysvalue);
		} else {
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $key => $vals) {
			$keysort[$key] = $key;
		}
		$new_array = array();
		foreach ($keysort as $key => $val) {
			$new_array[$key] = $arr[$val];
		}
		return $new_array;
	}//end function

	static public function seconds2Hms($seconds)
	{
		if ($seconds >= 3600) {
			$h = floor($seconds / 3600);
			$seconds -= $h * 3600;
		} else {
			$h = '00';
		}

		if ($seconds >= 60) {
			$m = floor($seconds / 60);
			$seconds -= $m * 60;
		} else {
			$m = '00';
			$seconds = '00';
		}
		$h = strlen($h) == 1 ? ('0' . $h) : $h;
		$m = strlen($m) == 1 ? ('0' . $m) : $m;
		$seconds = strlen($seconds) == 1 ? ('0' . $seconds) : $seconds;
		return $h . ':' . $m . ':' . $seconds;
	}

	static public function uploadFile($fh, $path = '/', $ftypes = array('xls', 'xlsx', 'csv', 'tsv'), $size = 10737418240)
	{
		//'jpeg','jpg','png','gif','bmp','pjpeg',
		if ($_FILES[$fh]['error'] === 0) {
			if (is_uploaded_file($_FILES[$fh]['tmp_name'])) {
				//var_dump($_FILES);
				$fname = $_FILES[$fh]['name'];
				$pathinfo = pathinfo($_FILES[$fh]['name']);
				$tempFile = $_FILES[$fh]['tmp_name'];
				$id = LoaderSvc::loadIdGenter()->create('upload');
				if ($_FILES[$fh]['size'] > 0 && $_FILES[$fh]['size'] < $size) {
					$targetPath = $path .'/'.date('Y').'/'.date('m').'/' . $id . '/';
					$relPath = $id . '/';
					if (!file_exists($targetPath)) {
						mkdir($targetPath, 0755, true);
					}
					$NewName = $fname;
					$ext = $pathinfo['extension'];

					if (in_array($ext, $ftypes)) {
						$targetFile = $targetPath . $NewName;
						$relFile = $relPath . $NewName;
						$rs = move_uploaded_file($tempFile, $targetFile);
						//var_dump($rs); die();
						if ($rs) {
							$data = array('status' => '0', 'data' => array('fname' => $NewName, 'path' => $targetFile, 'relpath' => $relFile));
						} else {
							$data = array('status' => '102', 'msg' => '移动文件失败');
						}
					} else {
						$data = array('status' => '101', 'msg' => '文件后缀不符合要求');
					}
				} else {
					$data = array('status' => '100', 'msg' => '文件大小10M以内');
				}

			}
		} else {
			$data = array('status' => '99', 'msg' => '上传出错');
		}
		return $data;
	}

	/**
	 * @param    int $length 随机串长度
	 * @param    int $max 长度范围
	 * @return   string
	 */
	public static function random($length = 20,$max = false,$type = 3)
	{
		if (is_int($max) && $max > $length) {
			$length = mt_rand($length, $max);
		}
		$output = '';
		for ($i = 0; $i < $length; $i++) {
			$which = ($type == 0 ? 0 : mt_rand(0, 2));
			if ($which === 0) {
				$output .= mt_rand(0, 9);
			} elseif ($which === 1) {
				$output .= chr(mt_rand(65, 90));
			} else {
				$output .= chr(mt_rand(97, 122));
			}
		}
		return $output;
	}

	static public function uuid()
	{
		return strtoupper(trim(file_get_contents('/proc/sys/kernel/random/uuid')));
	}

	static public function sessionHijacking($uid)
	{
		$rand = LoaderSvc::loadSess()->get('session-hijacking-rand');
		if (strlen($rand) == 0) {
			LoaderSvc::loadSess()->set('session-hijacking-rand', self::uuid());
			$rand = LoaderSvc::loadSess()->get('session-hijacking-rand');
		}
		return md5($uid . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $rand);
	}

	static public function sendMail($tousers, $message, $subject = 'SYS-WARING', $ccusers = array(), $files = array())
	{
		$mail = new PHPMailer(); //实例化
		$mail->IsSMTP(); // 启用SMTP 
		$mail->Host = "smtp.exmail.qq.com"; //SMTP服务器 以163邮箱为例子 
		$mail->Port = 25;  //邮件发送端口 
		$mail->SMTPAuth = true;  //启用SMTP认证

		$mail->CharSet = "UTF-8"; //字符集
		$mail->Encoding = "base64"; //编码方式 

		$mail->Username = SYS_WARING_MAILER_FROM;  //你的邮箱 
		$mail->Password = SYS_WARING_MAILERE_FROM_PASS;  //你的密码 
		$mail->Subject = $subject; //邮件标题 

		$mail->From = SYS_WARING_MAILER_FROM;  //发件人地址（也就是你的邮箱） 
		$mail->FromName = 'Sys-Mailer';  //发件人姓名 

		foreach ($tousers as $address) {
			$mail->AddAddress($address, '');//添加收件人（地址，昵称）
		}

		foreach ($ccusers as $address) {
			$mail->AddCC($address, '');//添加抄送
		}

		foreach ($files as $item) {
			$mail->AddAttachment($item['path'], $item['name']); // 添加附件,并指定名称
		}

		$mail->IsHTML(true); //支持html格式内容 
		$mail->Body = $message;
		return $mail->Send();
	}

	public static function makeSign($data,$salt,$algo='md5')
    {/*{{{*/
        if (is_array($data)) {
            $str = '';
            ksort($data);
            foreach ($data as $key => $val) {
                if ('' === strval($val) || 'sign' == $key) {
                    continue;
                }
                $str .= "{$key}={$val}&";
            }
            $str  = rtrim($str,'&');
            $str .= $salt;
        } elseif (is_string($data)) {
            $str  = $data.$salt;
        } else {
            throw new Exception("unsupported sign data type");
        }

        return hash($algo, $str);
    }/*}}}*/

	static public function sms($mobile,$type,$data,$channel = 0)
	{
		$tpl = [
			0=>'尊敬的用户，本次验证码为：%_CODE_%，非常感谢使用我们服务！',
		];

		$content = $tpl[$type];
		foreach($data as $key=>$val){
			$content = str_replace('%_'.$key.'_%',$val,$content);
		}

		//send data

		return true;
	}

	static public function displayErr($uri, $code)
	{
   		$r = strpos($uri,'/static/');
   		if($r === false){
   			$desc = '<pre style="color:orange;">
Error Code ['.$code.'] ==> ['.$uri.']';
			SysinfoSvc::log($desc);
			LoaderSvc::loadSmarty()->display('error/' . $code . '.tpl');
		} else {
			header("http/1.1 404 Not Found");
		}
	}

	static public function email($email)
	{
		return preg_match("/^[a-z0-9]([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i", $email);
	}
	
	static public function mobile($mobile)
	{
	    return ((strlen($mobile) == 11 && is_numeric($mobile)));
	}
	
	static public function idcode($vStr)
	{
	    $vCity = array(
	        '11','12','13','14','15','21','22',
	        '23','31','32','33','34','35','36',
	        '37','41','42','43','44','45','46',
	        '50','51','52','53','54','61','62',
	        '63','64','65','71','81','82','91'
	    );
	    
	    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;
	    
	    if (!in_array(substr($vStr, 0, 2), $vCity)) return false;
	    
	    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
	    $vLength = strlen($vStr);
	    
	    if ($vLength == 18)
	    {
	        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
	    } else {
	        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
	    }
	    
	    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
	    if ($vLength == 18)
	    {
	        $vSum = 0;
	    
	        for ($i = 17 ; $i >= 0 ; $i--)
	        {
	        $vSubStr = substr($vStr, 17 - $i, 1);
	        $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
	        }
	    
	        if($vSum % 11 != 1) return false;
	    }
	    
	    return true;
	}


    static public function createSerialNum($prefix = '',$total = 8)
    {
        $OBJ = 'SN'.date('Y');
        $snum = LoaderSvc::loadIdGenter()->create( $OBJ );
        $orderid = '';
        if(strlen($prefix)) $orderid .= $prefix;
        for($i=strlen($snum);$i<$total;$i++){
            $orderid .='0';
        }
        $orderid .= "$snum".substr(date('YmdHis'),2,12);
        return $orderid;
    }




}/*}}}*/
