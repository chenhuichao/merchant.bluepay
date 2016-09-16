<?php
class UserSvc
{/*{{{*/
	const OBJ = 'User';
	static private function add($param)
	{
		$obj = User::createByBiz($param);
		return self::getDao()->add($obj);
	}
	static public function getById($id = '0')
	{
		if (empty($id))
		{
			return null;
		}
		return self::getDao()->getById($id,self::OBJ);
	}

	static public function updateById($id,$param)
	{
		return self::getDao()->updateById($id,$param,self::OBJ);
	}

	static private function getDao()
	{
		return LoaderSvc::loadDao(self::OBJ);
	}

	static public function lists($request = array(),$options = array(),$export = false)
	{/*{{{*/
		$request_param = array();
		$sql_condition = array();
		$sql_param = array();

		if(isset($request['id']) && $request['id']>1)
		{
			$request_param[] = '`id`=' . $request['id'];
			$sql_condition[] = '`id` = ? ';
			$sql_param[] = $request['id'];
		}
		if('' != $request['is_default']){
			$request_param[] = 'is_default=' . $request['is_default'];
			$sql_condition[] = '`is_default` = ?';
			$sql_param[]	 = $request['is_default'];
		}
		if('' != $request['merchant_id']){
			$request_param[] = 'merchant_id=' . $request['merchant_id'];
			$sql_condition[] = '`merchant_id` = ?';
			$sql_param[]	 = $request['merchant_id'];
		}
		if('' != $request['mobile']){
			$request_param[] = 'mobile=' . $request['mobile'];
			$sql_condition[] = '`mobile` = ?';
			$sql_param[]	 = $request['mobile'];
		}
		if('' != $request['state']){
			$request_param[] = 'state=' . $request['state'];
			$sql_condition[] = '`state` = ?';
			$sql_param[]	 = $request['state'];
		}

		if('' != $request['daystart']){
			$request_param[] = 'daystart=' . $request['daystart'];
			$sql_condition[] = '`ctime` >= ?';
			$sql_param[]	 = $request['daystart'];
		}

		if('' != $request['dayend']){
			$request_param[] = 'dayend=' . $request['dayend'];
			$sql_condition[] = '`ctime` <= ?';
			$sql_param[]	 = $request['dayend'];
		}

		$option = array();
		$option['len'] = ($options['len'] > 0) ? $options['len'] : PER_PAGE;
		if($options['page'] > 0){
			$option['offset'] = ($options['page'] - 1) * $option['len'];
		}
		$option['orderby'] = isset($options['orderby']) ? $options['orderby'] : '';
		$results = self::getDao()->getRecord($sql_condition,$sql_param ,$option);
		$pages = '';
		$total = $results['total'];
		if($total > 0){
			$temp = stristr($options['baseurl'],'?');
			if($temp != false && strlen($temp)>1){
				$options['baseurl'] .= implode('&',$request_param).'&';
			}
			$pages = Pager::getPageStr($options['page'],$option['len'],$total,$options['baseurl']);
		}
		$results['pages'] = $pages;
		//$results['offset'] = $option['offset'] + 1;
		//$results['len'] = $option['len'];
		$results['pagenums'] = ceil($total / $option['len']);

		return $results;
	}/*}}}*/

	static public function checkUnique($key,$v)
	{
		return self::getDao()->checkUnique($key,$v);
	}
	

	static public function registration($param)
	{
		$mobile = $param['mobile'];
		$passwd = $param['passwd'];
		$r = self::checkUnique('mobile',$mobile);
		if(true === $r){
			
			$endata = self::encodePasswd($passwd);
			$params = array(
				'mobile'=>$mobile,
				'passwd'=>$endata['hash'],
				'state'=>User::STATE_ENABLE,
				'salt'=>$endata['salt'],
			);
			$obj = self::add($params);
			if(is_object($obj)){
				return true;
			}
		}
		return false;
	}


	static public function getUserInfoByMobile($mobile)
	{
		return self::getDao()->getUserInfoByMobile($mobile);
	}

	static public function getUserInfoByUid($uid)
	{
		return self::getDao()->getUserInfoByUid($uid);
	}
	
	static public function encodePasswd($passwd)
	{
		$salt = UtlsSvc::random(10);
		$hash = hash('sha256',md5($passwd).$salt);
		return array(
			'salt'=>$salt,
			'hash'=>$hash,
		);
	}

	static public function veryfiPasswd($passwd,$salt)
	{
		$hash = hash('sha256',md5($passwd).$salt);
		return $hash;
	}


	static public function login($param)
	{

		$mobile = $param['mobile'];
		$passwd = $param['passwd'];

		$tmparr = self::getUserInfoByMobile($mobile);
		if(empty($tmparr)){
			return User::ERR_USER_NOT_FOUND;
		}
		$salt = $tmparr['salt'];
		$passwd = self::veryfiPasswd($passwd,$salt);
		if($passwd != $tmparr['passwd']){
			return User::ERR_USER_PASSWD_WRONG;
		}

		$merchant_id = $tmparr['merchant_id'];
		$merchant = MerchantSvc::getById($merchant_id);
		$data = array(
			'uid'=>$tmparr['id'],
			'real_name'=>$merchant->real_name,
			'mobile'=>$tmparr['mobile'],
			'merchant_id'=>$merchant_id,
			'is_default'=>$tmparr['is_default']
		);
		return $data;
	}

	static public function resetPasswd($passwd,$uid)
	{
		$r = self::encodePasswd($passwd);
		$params = array(
			'passwd'=>$r['hash'],
			'salt'=>$r['salt'],
		);

		$r = UserSvc::updateById($uid,$params);
		return $r;
	}

}