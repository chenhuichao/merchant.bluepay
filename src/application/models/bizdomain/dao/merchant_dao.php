<?php
class MerchantDao extends BaseDao
{
	const TABLE_NAME = 'merchant';
	const COLUMN = '*';
	const POS_TABLE_NAME = 'pos';

	private function getTableName()
	{
		return self::TABLE_NAME;
	}
	
	public function getRecord($sql_condition = array(),$sql_param = array(),$options = array())
	{
		$sql = "select SQL_CALC_FOUND_ROWS * ";
		$sql.= "from ".self::getTableName()." ";
		if(!empty( $sql_condition )){
			$sql.= 'where '. implode(' and ', $sql_condition);
		}
		if($options['orderby']){
			$sql.= " order by ".$options['orderby']." ";
		}else{
			$sql.= " order by `id` desc ";
		}
		
		if($options['offset'] >=0 && $options['len'] > 0){
			$sql.= ' limit '.intval($options['offset']).','.intval($options['len']);
		}elseif($options['len'] > 0){
			$sql.= ' limit '.intval($options['len']);
		}
		
		$results = array();
		$result = $this->getExecutor()->querys($sql,$sql_param);
		
		$sql = "SELECT FOUND_ROWS() as `total`;";
		$rs = $this->getExecutor()->query($sql);
		
		$results = array(
			'total'=>$rs['total'],
			'record'=>(is_array($result)?$result:array()),
		);
		return $results;
	}
	
	public function checkUnique($key,$v)
	{
		$r = false;
		if(in_array($key,array('id_no','business_license_no'))){
			$sql = "select count(*) as total ";
			$sql.= "from ".self::TABLE_NAME." ";
			$sql.= "where `$key` = ? ";
			$tmparr = $this->getExecutor()->query($sql,array($v));
			if($tmparr['total'] == 0) $r = true;
		}

		return $r;	
	}

	public function getMerchantInfoByBL($business_license_no)
	{
		$sql = "select ".self::COLUMN." ";
		$sql.= "from ".self::TABLE_NAME." ";
		$sql.= "where `type` = ? ";
		$sql.= "and `business_license_no` = ? ";
		$tmparr = $this->getExecutor()->query($sql,array(Merchant::TYPE_COMPANY,$business_license_no));

		return is_array($tmparr) ? $tmparr : array();
	}

	public function getMerchantInfoByIdNo($id_no)
	{
		$sql = "select ".self::COLUMN." ";
		$sql.= "from ".self::TABLE_NAME." ";
		$sql.= "where `type` = ? ";
		$sql.= "and `id_no` = ? ";
		$tmparr = $this->getExecutor()->query($sql,array(Merchant::TYPE_PERSONAL,$id_no));

		return is_array($tmparr) ? $tmparr : array();
	}

	public function getPos($merchant_id,$user_id = null)
	{
		$sql_param = [];
		$sql = "select * ";
		$sql.= "from ".self::POS_TABLE_NAME." ";
		$sql.= "where `merchant_id` = ? ";
		$sql_param[] = $merchant_id;
		if(is_numeric($user_id) && $user_id >=0){
			$sql .= "and `user_id` = ? ";
			$sql_param[] = $user_id;
		}
		$sql .= "order by `id` asc";
		$results = $this->getExecutor()->querys($sql,$sql_param);
		return is_array($results) ? $results : [];
	}

	public function getUidByKey($key)
	{
		$sql = "select `id` as uid ";
		$sql.= "from binduser ";
		$sql.= "where `key`= ?";
		$result = $this->getExecutor()->query($sql,array($key));
		$uid = is_array($result) && $result['uid'] > 0 ? $result['uid'] : null;
		return $uid;   
	}
}
