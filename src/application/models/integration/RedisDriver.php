<?php
define('DEFAULT_REDIS_SET', '_');
class RedisDriver
{
	static function redis( $persistent_id = DEFAULT_REDIS_SET) {	    
        static $redis_instances = array();
        //判断是否已经实例化
        if( array_key_exists($persistent_id, $redis_instances)) {
            $instance = $redis_instances[$persistent_id];
        }else{
            //实例化一个redis对象
            $instance = new Redis();
            //连接redis
            
            foreach ($_SERVER['REDIS_SETS'][$persistent_id] as $server) {
                $conn = $instance->connect($server['host'],$server['port']);
                if(!$conn){
                    die('redis construct instance fail');
                    //走错误流程,预留
                }
                $redis_instances[$persistent_id] = $instance;
            }
           
        }
        return $instance;
    }
}