<?php
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/src/config/task_init.php';

while(1){
    $request = array(
        'state'=>Liblog::STATE_INITIAL
    );
    $liblog = LiblogSvc::lists($request);

    foreach($liblog['record'] as $key=>$val){
        exec($val['cmd'],$out,$state);
        if($state == '0'){
            $type = $val['type'];
            if(in_array($type,array(Liblog::TYPE_CO,Liblog::TYPE_UP))){
                $params = array(
                    'utime'=>date("Y-m-d H:i:s"),
                    'result'=>implode($out,'<br/>'),
                    'state'=>Liblog::STATE_SUCC
                );

                $params2 = array(
                    'utime'=>date("Y-m-d H:i:s"),
                    'version'=>date('YmdHis'),
                    'state'=>Lib::STATE_CO_SUCC
                );

                if($type == Liblog::TYPE_UP){
                    $params2['state'] = Lib::STATE_UP_SUCC;
                }

                LiblogSvc::updateById($val['id'],$params);
                LibSvc::updateById($val['lid'],$params2);
            }
            elseif(in_array($type,array(Liblog::TYPE_SSH))){
                $params = array(
                    'utime'=>date("Y-m-d H:i:s"),
                    'result'=>implode($out,'<br/>'),
                    'state'=>Liblog::STATE_SUCC
                );
                LiblogSvc::updateById($val['id'],$params);
            }

        }
        else{
            $params = array(
                'utime'=>date("Y-m-d H:i:s"),
                'result'=>implode($out,'<br/>'),
                'state'=>Liblog::STATE_FAIL
            );
            LiblogSvc::updateById($val['id'],$params);
        }

    }

    sleep(5);
}


