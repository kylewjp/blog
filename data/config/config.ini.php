<?php
defined('InShopNC') or exit('Access Invalid!');
$config = array();

$config['root_site_url'] 		= 'http://blogs.home.jiashaokj.com';
$config['mobile_site_url'] 		= 'http://blogs.home.jiashaokj.com/mobile';
$config['shop_site_url'] 		= 'http://blogs.home.jiashaokj.com/home';
$config['admin_site_url'] 		= 'http://blogs.home.jiashaokj.com/admin';
$config['upload_site_url']		= 'http://blogs.home.jiashaokj.com/data/upload';
$config['resource_site_url']	= 'http://blogs.home.jiashaokj.com/data/resource';
$config['version'] 				= '201401162490';
$config['setup_date'] 			= '2014-11-01 23:46:46';
$config['gip'] 					= 0;
$config['dbdriver'] 			= 'mysqli';
$config['tablepre']				= 'jq_';
$config['db'][1]['dbhost']  	= '127.0.0.1';
$config['db'][1]['dbport']		= '3306';
$config['db'][1]['dbuser']  	= 'root';
$config['db'][1]['dbpwd'] 	 	= 'root';
$config['db'][1]['dbname']  	= 'tpblog';
$config['db'][1]['dbcharset']   = 'utf-8';
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
