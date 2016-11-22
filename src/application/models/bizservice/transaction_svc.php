<?php
class TransactionSvc
{/*{{{*/
	const OBJ = 'Transaction';
	
	static public function getById($id = '0')
	{
		if (empty($id))
		{
			return null;
		}
		return self::getDao()->getById($id,self::OBJ);
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
		if('' != $request['fee']){
			$request_param[] = 'fee=' . $request['fee'];
			$sql_condition[] = '`fee` = ?';
			$sql_param[]	 = $request['fee'];
		}
		if('' != $request['type']){
			$request_param[] = 'type=' . $request['type'];
			$sql_condition[] = '`type` = ?';
			$sql_param[]	 = $request['type'];
		}
		if('' != $request['daystart'])
		{
			$request_param[] = 'daystart=' . $request['daystart'];

			$sql_condition[] = '`datetime` >= ?';
			$sql_param[]	 = $request['daystart'].' '.'00:00:00';
		}
		
		if('' != $request['dayend'])
		{
			$request_param[] = 'dayend=' . $request['dayend'];

			$sql_condition[] = '`datetime` <= ?';
			$sql_param[]	 = $request['dayend'].' '.'23:59:59';
		}

		if('' != $request['uid']){
			$request_param[] = 'uid=' . $request['uid'];
			$sql_condition[] = '`uid` = ?';
			$sql_param[]	 = $request['uid'];
		}

		if('' != $request['btype']){
			$request_param[] = 'btype=' . $request['btype'];
			$sql_condition[] = '`btype` = ?';
			$sql_param[]	 = $request['btype'];
		}

		if('' != $request['state']){
			$request_param[] = 'state=' . $request['state'];
			$sql_condition[] = '`state` = ?';
			$sql_param[]	 = $request['state'];
		}

		if('' != $request['sstate']){
			$request_param[] = 'sstate=' . $request['sstate'];
			$sql_condition[] = '`sstate` = ?';
			$sql_param[]	 = $request['sstate'];
		}

		if('' != $request['user_id']){
			$request_param[] = 'user_id=' . $request['user_id'];
			$sql_condition[] = '`user_id` = ?';
			$sql_param[]	 = $request['user_id'];
		}

		if('' != $request['orderid']){
			$request_param[] = 'orderid=' . $request['orderid'];
			$sql_condition[] = '`orderid` = ?';
			$sql_param[]	 = $request['orderid'];
		}

		if('' != $request['tradeno']){
			$request_param[] = 'tradeno=' . $request['tradeno'];
			$sql_condition[] = '`tradeno` = ?';
			$sql_param[]	 = $request['tradeno'];
		}

		if('' != $request['sn']){
			$request_param[] = 'sn=' . $request['sn'];
			$sql_condition[] = '`sn` = ?';
			$sql_param[]	 = $request['sn'];
		}

		$option = array();
		$option['len'] = ($options['len'] > 0) ? $options['len'] : PER_PAGE;
		if($options['page'] > 0){
			$option['offset'] = ($options['page'] - 1) * $option['len'];
		}
		$option['orderby'] = isset($options['orderby']) ? $options['orderby'] : '';
		
		$results = self::getDao()->getRecord($sql_condition,$sql_param,$options);
		if($export) return $results;
		
		$pages = '';
		$total = $results['total'];
		if($total > 0){
			$temp = stristr($options['baseurl'],'?');
			if($temp === false) $options['baseurl'] .= '?';
			$options['baseurl'] .= implode('&',$request_param);
			if(count($request_param)) $options['baseurl'] .= '&';
			$pages = Pager::getPageStr($options['page'],$option['len'],$total,$options['baseurl']);
		}
		$results['pages'] = $pages;
		//$results['offset'] = $option['offset'] + 1;
		//$results['len'] = $option['len'];
		$results['pagenums'] = ceil($total / $option['len']);

		return $results;
	}/*}}}*/
	
}
