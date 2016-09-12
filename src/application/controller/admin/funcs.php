<?php

function show_msg($msg, $type, $width = '30%')
{
    $tpl = 'succ';
    switch ($type) {
        case 'succ':
            $tpl = 'succ';
            break;
        case 'err':
            $tpl = 'err';
            break;
        case 'notice':
            $tpl = 'notice';
            break;
        case 'warning':
            $tpl = 'warning';
            break;
        default:
            break;
    }
    
    LoaderSvc::loadSmarty()->assign('info', $msg);
    LoaderSvc::loadSmarty()->assign('width', $width);
    return LoaderSvc::loadSmarty()->fetch('info/' . $tpl . '.tpl');
}

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}

/**
 * 把字符串或数组或对象转换成json格式并输出
 * @param  $info
 * 
 */
function ajaxReturn($info){
    echo json_encode($info);
    die;
}

/**
 * 根据身份证号码计算年龄
 * @param number $id
 * @return string|number
 */
function getAgeByID($id){
    //过了这年的生日才算多了1周岁
    if(empty($id)) return '';
    $date=strtotime(substr($id,6,8));
    //获得出生年月日的时间戳
    $today=strtotime('today');
    //获得今日的时间戳
    $diff=floor(($today-$date)/86400/365);
    //得到两个日期相差的大体年数

    //strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
    $age=strtotime(substr($id,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;

    return $age;
}

function getPreferredLanguage() {
    $langs = array();
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        // break up string into pieces (languages and q factors)
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)s*(;s*qs*=s*(1|0.[0-9]+))?/i',
                $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
        if (count($lang_parse[1])) {
            // create a list like "en" => 0.8
            $langs = array_combine($lang_parse[1], $lang_parse[4]);
            // set default to 1 for any without q factor
            foreach ($langs as $lang => $val) {
                if ($val === '') $langs[$lang] = 1;
            }
            // sort list based on value
            arsort($langs, SORT_NUMERIC);
        }
    }
    //extract most important (first)
    foreach ($langs as $lang => $val) {break;}
    //if complex language simplify it
    if (stristr($lang,"-")) {$tmp = explode("-",$lang); $lang = $tmp[0]; }
    return $lang;
}