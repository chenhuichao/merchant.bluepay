<?php
class PosSvc
{/*{{{*/
	const OBJ = 'pos';
	static public function add($param)
	{
		$obj = Pos::createByBiz($param);
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
		if('' != $request['sn']){
			$request_param[] = 'sn=' . $request['sn'];
			$sql_condition[] = '`sn` = ?';
			$sql_param[]	 = $request['sn'];
		}
		if('' != $request['merchant_id']){
			$request_param[] = 'merchant_id=' . $request['merchant_id'];
			$sql_condition[] = '`merchant_id` = ?';
			$sql_param[]	 = $request['merchant_id'];
		}
		if('' != $request['user_id']){
			$request_param[] = 'user_id=' . $request['user_id'];
			$sql_condition[] = '`user_id` = ?';
			$sql_param[]	 = $request['user_id'];
		}
	
		if('' != $request['daystart']){
			$request_param[] = 'daystart=' . $request['daystart'];
			$sql_condition[] = '`utime` >= ?';
			$sql_param[]	 = $request['daystart'];
		}

		if('' != $request['dayend']){
			$request_param[] = 'dayend=' . $request['dayend'];
			$sql_condition[] = '`utime` <= ?';
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

	static public function getBySn($sn)
	{
		return self::getDao()->getBySn($sn);
	}

	static public function getByUid($uid)
	{
		return self::getDao()->getByUid($uid);
	}

}