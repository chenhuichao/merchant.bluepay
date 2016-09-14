<?php
class MerchantSvc
{/*{{{*/
	const OBJ = 'Merchant';
	static private function add($param)
	{
		$obj = Merchant::createByBiz($param);
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
		
		if('' != $request['mobile']){
			$request_param[] = 'mobile=' . $request['mobile'];
			$sql_condition[] = '`mobile` = ?';
			$sql_param[]	 = $request['mobile'];
		}
		if('' != $request['real_name']){
			$request_param[] = 'real_name=' . $request['real_name'];
			$sql_condition[] = '`real_name` = ?';
			$sql_param[]	 = $request['real_name'];
		}

		if('' != $request['id_no']){
			$request_param[] = 'id_no=' . $request['id_no'];
			$sql_condition[] = '`id_no` = ?';
			$sql_param[]	 = $request['id_no'];
		}

		if('' != $request['company_name']){
			$request_param[] = 'company_name=' . $request['company_name'];
			$sql_condition[] = '`company_name` = ?';
			$sql_param[]	 = $request['company_name'];
		}

		if('' != $request['business_license_no']){
			$request_param[] = 'business_license_no=' . $request['business_license_no'];
			$sql_condition[] = '`business_license_no` = ?';
			$sql_param[]	 = $request['business_license_no'];
		}

		if('' != $request['email']){
			$request_param[] = 'email=' . $request['email'];
			$sql_condition[] = '`email` = ?';
			$sql_param[]	 = $request['email'];
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
}