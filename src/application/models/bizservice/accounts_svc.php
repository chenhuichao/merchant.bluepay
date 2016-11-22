<?php
class AccountsSvc
{/*{{{*/
	const OBJ = 'Accounts';
	
	static private function getDao()
	{
		return LoaderSvc::loadDao(self::OBJ);
	}

    /**
	 * @brief 账户列表
	 */
	static public function lists($request = array(),$options = array(),$export = false)
	{/*{{{*/
		$request_param = array();
		$sql_condition = array();
		$sql_param = array();

		if(isset($request['id']) && $request['id']>1)
		{
			$request_param[] = '`id`=' . $request['id'];
			$sql_condition[] = 'A.id = ? ';
			$sql_param[] = $request['id'];
		}
		if('' != $request['uid']){
			$request_param[] = 'uid=' . $request['uid'];
			$sql_condition[] = 'A.uid = ?';
			$sql_param[]	 = $request['uid'];
		}

		if('' != $request['daystart']){
			$request_param[] = 'daystart=' . $request['daystart'];
			$sql_condition[] = 'A.ctime >= ?';
			$sql_param[]	 = $request['daystart'];
		}

		if('' != $request['dayend']){
			$request_param[] = 'dayend=' . $request['dayend'];
			$sql_condition[] = 'A.ctime <= ?';
			$sql_param[]	 = $request['dayend'];
		}

		$option = array();
		$option['len'] = ($options['len'] > 0) ? $options['len'] : PER_PAGE;
		if($options['page'] > 0){
			$option['offset'] = ($options['page'] - 1) * $option['len'];
		}
		$option['orderby'] = isset($options['orderby']) ? $options['orderby'] : '';

		$results = self::getDao()->getRecord($sql_condition,$sql_param ,$option);
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
		//$results['pagenums'] = ceil($total / $option['len']);

		return $results;
	}/*}}}*/
	
}

