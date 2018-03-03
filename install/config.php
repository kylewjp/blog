<?php
defined('InShopNC') or exit('Access Invalid!');
$config = array();

$config['root_site_url'] 		= 'http://#URL#';
$config['mobile_site_url'] 		= 'http://#URL#/mobile';
$config['shop_site_url'] 		= 'http://#URL#/home';
$config['admin_site_url'] 		= 'http://#URL#/admin';
$config['upload_site_url']		= 'http://#URL#/data/upload';
$config['resource_site_url']	= 'http://#URL#/data/resource';
$config['version'] 				= '201401162490';
$config['setup_date'] 			= '2014-11-01 23:46:46';
$config['gip'] 					= 0;
$config['dbdriver'] 			= 'mysqli';
$config['tablepre']				= '#DB_PREFIX#';
$config['db'][1]['dbhost']  	= '#DB_HOST#';
$config['db'][1]['dbport']		= '#DB_PORT#';
$config['db'][1]['dbuser']  	= '#DB_USER#';
$config['db'][1]['dbpwd'] 	 	= '#DB_PWD#';
$config['db'][1]['dbname']  	= '#DB_NAME#';
$config['db'][1]['dbcharset']   = '#DB_CHARSET#';
$config['db']['slave'] 			= array();
$config['session_expire'] 		= 3600;
$config['lang_type'] 			= 'zh_cn';
$config['cookie_pre'] 			= 'F6E6_';
$config['tpl_name'] 			= 'default';
$config['thumb']['cut_type']	= 'gd';
$config['thumb']['impath'] 		= '';
$config['cache']['type'] 		= 'file';
$config['debug'] 				= false;
$config['default_store_id'] 	= '1';
// 是否开启伪静态
$config['url_model']			= false;
// 二级域名后缀
$config['subdomain_suffix'] 	= '';

$config['sms']['gwUrl']			= 'http://sdkhttp.eucp.b2m.cn/sdk/SDKService';
$config['sms']['serialNumber'] 	= '';
$config['sms']['password'] 		= '';
$config['sms']['sessionKey'] 	= '';
$config['sms']['plugin'] 		= 'yunpian';
