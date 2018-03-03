<?php
/**
 * Created by PhpStorm.
 * User: wjp_kyle
 * Date: 2018/2/2
 * Time: 14:02
 */

/**
 * 模型实例化入口
 *
 * @param string $model_name 模型名称
 * @return obj 对象形式的返回结果
 */
function Model($model = null){
    static $_cache = array();
    if (!is_null($model) && isset($_cache[$model])) return $_cache[$model];
    $file_name = BASE_PATH.'/data/model/'.$model.'.model.php';
    $class_name = $model.'Model';
    if (!file_exists($file_name)){
        return $_cache[$model] =  new Model($model);
    }else{
        require_once($file_name);
        if (!class_exists($class_name)){
            $error = 'Model Error:  Class '.$class_name.' is not exists!';
            throw_exception($error);
        }else{
            $_cache[$model] = new $class_name();
            return $_cache[$model] = new $class_name();
        }
    }
}

// 写入日志
function logOut($message,$level='error') {
    $now = date('Y-m-d H:i:s',time());
    switch ($level) {
        case 'sql':
            $log_file = BASE_PATH.'/data/log/sql'.date('Ymd',time()).'.log';
            $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'];
            $url .= " ( act={$_GET['act']}&op={$_GET['op']} ) ";
            $content = "[{$now}] {$level}: {$message}\r\n";
            file_put_contents($log_file,$content, FILE_APPEND);
            break;
        case 'error':
            $log_file = BASE_PATH.'/data/log/error'.date('Ymd',TIMESTAMP).'.log';
            $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'];
            $url .= " ( act={$_GET['act']}&op={$_GET['op']} ) ";
            $content = "[{$now}] {$url}\r\n{$level}: {$message}\r\n";
            file_put_contents($log_file,$content, FILE_APPEND);
            break;
    }
}
// 记录和统计时间（微秒）
function addUpTime($start,$end='',$dec=3) {
    static $_info = array();
    if(!empty($end)) { // 统计时间
        if(!isset($_info[$end])) {
            $_info[$end]   =  microtime(TRUE);
        }
        return number_format(($_info[$end]-$_info[$start]),$dec);
    }else{ // 记录时间
        $_info[$start]  =  microtime(TRUE);
    }
}
/**
 * 取得系统配置信息
 *
 * @param string $key 取得下标值
 * @return mixed
 */
function C($key){
    if (strpos($key,'.')){
        $key = explode('.',$key);
        if (isset($key[2])){
            return $GLOBALS['config'][$key[0]][$key[1]][$key[2]];
        }else{
            return $GLOBALS['config'][$key[0]][$key[1]];
        }
    }else{
        return $GLOBALS['config'][$key];
    }
}