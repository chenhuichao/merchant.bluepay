<?php
if(isset($_POST['account']) && isset($_POST['password'])){
	$account = trim($_POST['account']);
	$password = trim($_POST['password']);
	$verify = trim($_POST['verify']);

	if(strtolower($verify) != strtolower(LoaderSvc::loadSess()->get('security_code'))){
		echo json_encode(array('errorField'=>'verify','errorInfo'=>'验证码错误'));
		exit;
	}
	
	$sign = AdminuserSvc::LOGIN_FAIL;
	$row = AdminuserSvc::getByEmail($account);

	if(empty($row)){
		$data = array('errorField'=>'account','errorInfo'=>'账户不存在或被禁用');
	}else{
		$data = array('errorField'=>'password','errorInfo'=>'密码错误');

$private_key_str = '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAuzbtOrQAiVSXvrwrZMyvD8Z0OhiAXh3eo2CQEmLz/8eET5XT
arUU0jVAVAjBucQZKyKOgSMAn+uGiMQtbwbJGhxS7p36I5nggSLnVi4PTCtWEQ4r
LykWGdqqlyUIaKIwwpJ7GYJhF3bm4/d6f01rrILT7J7PLwCj/1KnaGuVgKRk6bcJ
sAwSgP1m3OoG/f2uDL9DNaSks6jLO4EUgQ5FaMNiuwErJbG2c1P7CbiHoLkWiEdB
5CTnEeurcdz4o+ocENIfIMb20NMQctWwj/xDna5V+hLC2tqPX8D+krsgj5yUQt7Q
drMbFihh4o+NrU0ecC3CF6xqo4QNWxN/uTbGnQIDAQABAoIBAQCujo4u9/qwEXHT
Y7vKJpbrzIw+Ru4Z0xvtlXF/00fSK4OQeRBBJEofnYs3T1riDJezAmuAuNQyR/aO
uuvp45fKgrJIzn+Whjkv7w1n61ZUHOwIxv8438Q9owcAGoV2mhOAt/eTV1+T80dh
MzTCUbudg/Z5X7GqD5zZyYVR9U3WPNdeasiQ9EFYSp244OEPRfMFnR1Bm3Or2WOK
sgEHRSJQQQ0psuQAeVG/ee8qzh4PRJvSx6cHbAowu0iD0+OkfBD7Uzvacj5qsPJp
MRDjlW6xhhWGvfdbQn65TVK30FNyxr428RZS7FKY4vFwqvQD1gXBSRgLu5cgkWLv
3asmdjkBAoGBAPNAJlqlQSZf432y75DitGaU5OhweOJWd1dgoce8J0srbIe9DpN+
k/fHY5tJp1esU76DG5qZ/ykejiHIJfWzHcOjyCEyJvNoxuexY/MvJeUttX9mVqhA
I4dFEyYXawU/aVeiij+2wDG9P8xByMSPFPGAdFE2NrZ/b4pStUG6RiHhAoGBAMUG
58DDvH4hCMrtPMFddVv2+g5+hGkse3c9XAu8POEqB1NVsOldx1dBkgRIhS5Sx/vd
CbHVitwnPcKCTqvmMz2GHbpGJF7zP6BFfUKojywgZyRL0AUmNzHy/xqch+NUUDk+
F0Kd3ocXaajo0yqv09cSkY9tOJfHGxushlBpfzQ9AoGATs1WX4EvpO3ldcA1CdvX
k2/i5EYjczeNu9nLLziOBjUQGL0vbqrP5rJKW3E17BogmxRAKgp/deO3Kcx8N6eK
GeoCGHb11V75KO/3sD1y6laveJE/u4vjtpuzA2EMw4tyZfh7Dv72Lmbftx0MnFi5
8S6q//AvM1n/WXFH1P4yYCECgYB9T4EClvtBdR00g2KK0TgdP52Wrlzkz4fPNNVg
GV7XDnYOSIf2RNDN7EREOSOLbNcIl3LdCiYBE2wyU9JZflXEoZIysP3c7fTfqJKc
XLyCojE3YohxXfbo69XYRQogSbWkUptUoTewz/FBnqL/mUiwl3zArgS6c8YH+diL
OC3ROQKBgQCrovESHvhI6FzCDkRrREsx0ju8sDkvvdaK4SJYLMmB0bBuLlkG9CX8
2LrX4j1PdcFfYTJAHinB8i+U2NB0YVCl6ykCvT8BMt/zALNP+Rw3nrnSg0lFLBeW
97mEja7aIssQ85NLfU7MX3++Dz52rE+KDwIaRu7hpjAT+ZwCfFNHbg==
-----END RSA PRIVATE KEY-----';

		$private_key = openssl_pkey_get_private($private_key_str);
		$bin_ciphertext = base64_decode($password);
		openssl_private_decrypt($bin_ciphertext,$decpasswd,$private_key,OPENSSL_PKCS1_PADDING) or die("openssl decrypt error");

		if($row['passwd'] == md5($decpasswd.md5($row['salt']))){
			if($row['status'] == Adminuser::STATUS_DISABLE){
				$data['errorInfo'] = '账户已被禁用';
			}else{
				$data['status'] = '0';
				$data['url'] = isset($_REQUEST['returl']) ? urlencode($_REQUEST['returl']) : '/';
				LoaderSvc::loadSess()->set('uid',$row['id']);
				LoaderSvc::loadSess()->set('name',$row['name']);
				LoaderSvc::loadSess()->set('APP_NAME',APP_NAME);
				$session = array(
					'uid'=>$row['id'],
					'name'=>$row['name'],
					'email'=>$row['email'],
				);

				LoaderSvc::loadSess()->set('session',$session);
				LoaderSvc::loadSess()->set('session-hijacking',UtlsSvc::sessionHijacking($row['id']));
				LoaderSvc::loadDBCache()->set($row['id'],LoaderSvc::loadSess()->get('session-hijacking')); 
				$sign = AdminuserSvc::LOGIN_SUCC;
			}
		}
	}
	
	//记录登录日志
	$uid = $row['id'] > 0 ? $row['id'] : -1;
	AdminuserSvc::loginLog($uid,$sign);
	echo json_encode($data);
}

