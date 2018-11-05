<?php
/**
 * 菜单
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.11
 */
defined('InShopNC') or exit('Access Invalid!');
/**
 * top 数组是顶部菜单 ，left数组是左侧菜单
 * left数组中'args'=>'welcome,dashboard,dashboard',三个分别为op,act,nav，权限依据act来判断
 */
$arr = array(
		'top' => array(
			0 => array(
				'args' 	=> 'dashboard',
				'text' 	=> $lang['nc_console']),
			1 => array(
				'args' 	=> 'setting',
				'text' 	=> $lang['nc_config']),
            2 => array(
                'args' 	=> 'article',
                'text' 	=> '相关文章'),
            3 => array(
                'args' 	=> 'uploads',
                'text' 	=> '文件管理'),
		),
		'left' =>array(
			0 => array(
				'nav' => 'dashboard',
				'text' => $lang['nc_normal_handle'],
				'list' => array(
					array('args'=>'welcome,dashboard,dashboard',			'text'=>$lang['nc_welcome_page']),
					array('args'=>'aboutus,dashboard,dashboard',			'text'=>$lang['nc_aboutus']),
					array('args'=>'base,setting,dashboard',					'text'=>$lang['nc_web_set']),
					
				)
			),
			1 => array(
				'nav' => 'setting',
				'text' => $lang['nc_config'],
				'list' => array(
//
//                    array('args'=>'mb_home_list,mb_home,setting',	'text'=>'首页轮播图'),
                    array('args'=>'base,setting,setting',			'text'=>$lang['nc_web_set']),
                    array('args'=>'friendlink,friendlink,setting',	'text'=>'友情连接'),
//					array('args'=>'email,message,setting',			'text'=>$lang['nc_message_set']),//邮件相关
					array('args'=>'admin,admin,setting',			'text'=>$lang['nc_limit_manage']),
//					array('args'=>'clear,cache,setting',			'text'=>$lang['nc_admin_clear_cache']),
//					array('args'=>'list,admin_log,setting',			'text'=>$lang['nc_admin_log']),
                    array('args'=>'aboutme,aboutme,setting',	'text'=>'关于我'),
				)
			),
            2 => array(
                'nav' => 'article',
                'text' => '相关文章',
                'list' => array(
                    array('args'=>'article,article,article',	'text'=>'文章管理'),
                    array('args'=>'article_class,article_class,article',	'text'=>'文章分类'),

                    array('args'=>'list,message_board,article',	'text'=>'客户留言'),
//					array('args'=>'list,message_board,article',	'text'=>'管理员留言'),
                )
            ),
            3 => array(
                'nav' => 'uploads',
                'text' => '文件管理',
                'list' => array(
                    array('args'=>'index,upload,uploads',	'text'=>'文件管理'),
                )
            ),
		)
);
return $arr;
?>
