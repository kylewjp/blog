<?php
/**
 * 载入权限
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
$_limit =  array(
	array('name'=>$lang['nc_config'], 'child'=>array(
        array('name'=>'友情连接', 'op'=>'friendlink', 'act'=>'friendlink'),
//        array('name'=>'首页轮播图', 'op'=>'mb_home_list', 'act'=>'mb_home'),
        array('name'=>$lang['nc_web_set'], 'op'=>null, 'act'=>'setting'),
//		array('name'=>$lang['nc_message_set'], 'op'=>null, 'act'=>'message'),//邮件相关
	    //array('name'=>$lang['nc_limit_manage'], 'op'=>null, 'act'=>'admin'),
//	    array('name'=>$lang['nc_admin_clear_cache'], 'op'=>null, 'act'=>'cache'),
//	    array('name'=>$lang['nc_admin_log'], 'op'=>null, 'act'=>'admin_log'),
		array('name' => '关于我','op'=>'aboutMe','act'=>'aboutme')

	)),
    array('name'=>'相关文章', 'child'=>array(
        array('name'=>'文章管理', 'op'=>'article', 'act'=>'article'),
        array('name'=>'文章分类', 'op'=>'article_class', 'act'=>'article_class'),

        array('name'=>'客户留言', 'op'=>'list', 'act'=>'message_board'),
    )),
	
);
return $_limit;
?>
