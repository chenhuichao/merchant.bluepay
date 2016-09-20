<?php
class PosDao extends BaseDao
{
	const TABLE_NAME = 'pos';

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
		if(in_array($key,array('sn'))){
			$sql = "select count(*) as total ";
			$sql.= "from ".self::TABLE_NAME." ";
			$sql.= "where `$key` = ? ";
			$tmparr = $this->getExecutor()->query($sql,array($v));
			if($tmparr['total'] == 0) $r = true;
		}

		return $r;	
	}

	public function getByUid($uid)
	{
		$sql = "select * ";
		$sql.= "from ".self::TABLE_NAME." ";
		$sql.= "where `user_id` = ? ";
		$tmparr = $this->getExecutor()->querys($sql,array($uid));

		return is_array($tmparr) ? $tmparr : array();
	}

	public function getByMerchantId($merchant_id)
	{
		$sql = "select * ";
		$sql.= "from ".self::TABLE_NAME." ";
		$sql.= "where `merchant_id` = ? ";
		$tmparr = $this->getExecutor()->querys($sql,array($merchant_id));

		return is_array($tmparr) ? $tmparr : array();
	}

	public function getBySn($sn)
	{
		$sql = "select * ";
		$sql.= "from ".self::TABLE_NAME." ";
		$sql.= "where `sn` = ? ";
		$tmparr = $this->getExecutor()->query($sql,array($sn));

		return is_array($tmparr) ? $tmparr : array();
	}


}