<?php
define('DEFAULT_MEMCACHED_SET', '_');
class MemCachedDriver
{/*{{{*/
	static function mcache( $persistent_id = DEFAULT_MEMCACHED_SET ) {
        // one instantiation per-connection per-request
        static $memcached_instances = array();
    
        if( array_key_exists($persistent_id, $memcached_instances)) {
            $instance = $memcached_instances[$persistent_id];
        }else{
            $instance = new Memcached($persistent_id);
            $instance->setOption(Memcached::OPT_PREFIX_KEY, $persistent_id);
            $instance->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE, true); // advisable option
            
            // Add servers if no connections listed. Get server set by $persistent_id or use default set.
            // In a production environment with multiple server sets you may wish to prevent typos from silently adding data 
            // to the default pool, in which case return an error on no match instead of defaulting
            if( !count($instance->getServerList()) ) {
                $servers = array_key_exists($persistent_id, $_SERVER['MEMCACHED_SETS'])
                    ? $_SERVER['MEMCACHED_SETS'][$persistent_id]
                    : $_SERVER['MEMCACHED_SETS'][DEFAULT_MEMCACHED_SET];
                $instance->addServers($servers);
            }

            $memcached_instances[$persistent_id] = $instance;
        }
        return $instance;
    }
}/*}}}*/