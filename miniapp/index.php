<?php
/**
 * Mini app入口
 */


error_reporting(E_ALL & ~E_NOTICE);//设置报错级别
define('WECHAT','WECHAT');
header("Content-type: text/html; charset=utf-8");
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
define('BASE_ROOT_PATH',str_replace('\\','/',dirname(dirname(__FILE__))));

// 加载对应的通用函数
if (!@include_once(BASE_PATH.'/framework/function/function.php')){
    exit("Class Error: {function.php}.isn't exists!");
}

// 加载配置信息
define('InShopNC','InShopNC');
if (!@include(BASE_ROOT_PATH.'/data/config/config.ini.php')) exit('config.ini.php isn\'t exists!');

global $config;
$config['db']['slave'] = $config['db'][1];
$config['db']['master'] = $config['db'][1];
define('DBPRE',$GLOBALS['config']['tablepre']);

// 加载数据库驱动
define('DBDRIVER',$config['dbdriver']);
if (!@include_once(BASE_PATH.'/framework/db/'.strtolower(DBDRIVER).'.php')){
    exit("Class Error: {".strtolower(DBDRIVER).'.php'."}.isn't exists!");
}

// 加载控制器和函数
$class_name = empty($_GET['c'])?'index':$_GET['c'];
if (!@include_once(BASE_PATH.'/control/'.trim($class_name).'.class.php')){
    exit("Class Error: {$class_name}.isn't exists!");
}else{
    $op =  empty($_GET['op'])?'index':$_GET['op'];
    $main = new $class_name();
    $function = $op.'Op';
    if (method_exists($main,$function)){
        $main->$function();
    }elseif (method_exists($main,'indexOp')){
        $main->indexOp();
    }else {
        $error = "Base Error: function $function not in $class_name!";
        throw_exception($error);
    }
}



