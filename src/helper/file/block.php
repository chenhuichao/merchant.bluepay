<?php
echo time();
$s = $_GET['s'];
writeData('/data/htdocs/dev.qs.cn/admin/test/file/test.txt','a',"$s");

function writeData($path,$mode,$data){  
    $fp = fopen($path,$mode);   
    $retries = 0;  
    $max_retries = 100;
	//flock($fp, LOCK_EX | LOCK_NB)
    while (!flock($fp,LOCK_EX) and $retries<=$max_retries){
       usleep(rand(1,10000));
       $retries += 1;  
    } 
    if ($retries == $max_retries) return false;  
	/*
	sleep(5);
	for($i=$data+1;$i<$data+100;$i++){
	   fwrite($fp, "[$i]\n");  
	}*/
    fwrite($fp,"$data\n");  
    //flock($fp, LOCK_UN);
    fclose($fp);
    return true;   
}