<?php
/**
 * 控制台
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class dashboardControl extends SystemControl{
	private $paramList = array(
		'companynum'=>0,
		'companysee'=>0,
		
		'personelnum'=>0,
		'personelsee'=>0,
		
		'drivernum'=>0,
		'driversee'=>0,
		
		'ordernum'=>0,
		'ordersee'=>0
	);
	public function __construct(){
		parent::__construct();
		Language::read('dashboard');
	}
	/**
	 * 欢迎页面
	 */
	public function welcomeOp(){
		/**
		 * 管理员信息
		 */
		$model_admin = Model('admin');
		$tmp = $this->getAdminInfo();
		$condition['admin_id'] = $tmp['id'];
		$admin_info = $model_admin->infoAdmin($condition);
		$admin_info['admin_login_time'] = date('Y-m-d H:i:s',($admin_info['admin_login_time'] == '' ? time() : $admin_info['admin_login_time']));
		/**
		 * 系统信息
		 */
		$version = C('version');
		$setup_date = C('setup_date');
		$statistics['os'] = PHP_OS;
		$statistics['web_server'] = $_SERVER['SERVER_SOFTWARE'];
		$statistics['php_version'] = PHP_VERSION;
		$statistics['sql_version'] = Db::getServerInfo();
		$statistics['shop_version'] = $version;
		$statistics['setup_date'] = substr($setup_date,0,10);
		Tpl::output('statistics',$statistics);
		
		$showlist = $this->listPage();
		Tpl::output('showlist',$showlist);

		Tpl::output('admin_info',$admin_info);
		Tpl::showpage('welcome');
	}
	
	/**
	 * 界面功能显示
	 * 返回数组
	 */
	private function listPage(){
		$showlist = array();
		/** 
		 *	板块开始1
		 *	文章
		 */
		$showlistarray = array();
		$showlistarray[] = array(
				'param_show_type'=>'normal',					//小模块数据提醒显示 normal(表示普通不发亮),high（表示红色发亮）
				'param_url'=>'index.php?act=article_class&op=article_class',	//小模块跳转连接
				'text_title_name'=> '管理分类',	//小模块名字
				'param_title_name'=>'classSee'			//获取数据的标签***
			);
		$showlist[] = array(
                'param_picture_name'=>'pic0',				//板块图片标签[pic0-pic8]
                'param_title_name'=>'classNum',				//获取板块数据标签***
                'text_title_name_title'=> '分类数量',	//数据介绍
                'text_title_name'=> '分类数量',		    //板块名字
                'text_title_name_subhead'=> '副标题',	//板块副标题
                'array'=>$showlistarray                 //底部跳转配置
            );
		/******板块结束*****/
		return $showlist;
	}
	/**
	 * 统计
	 */
	public function statisticsOp(){
		$model_stat= Model('stat');
        // 本周开始时间点
        $tmp_time = mktime(0,0,0,date('m'),date('d'),date('Y'))-(date('w')==0?7:date('w')-1)*24*60*60;
        // 分类总数
        $this->paramList['classNum'] = '??';
        $this->paramList['classSee'] = '';
        echo json_encode($this->paramList);
		exit;
	}
	/**
	 * 关于我们
	 */
	public function aboutusOp(){
		
		Tpl::showpage('aboutus');
	}
	
}
