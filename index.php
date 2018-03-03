<?php
/**
 * 默认入口
 *
 * @since      File available since Release v1.1
 */
$site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/home/index.php');
@header('Location: '.$site_url);

