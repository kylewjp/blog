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
		 *	公司
		 */
		$showlistarray = array();
		$showlistarray[] = array(
				'param_show_type'=>'normal',					//小模块数据提醒显示 normal(表示普通不发亮),high（表示红色发亮）
				'param_url'=>'index.php?act=wjp_company&op=list_see',	//小模块跳转连接
				'text_title_name'=> L('dashboard_wel_company_see'),	//小模块名字
				'param_title_name'=>'companysee'			//获取数据的标签***
			);
		$showlist[] = array(
					'param_picture_name'=>'pic0',				//板块图片标签[pic0-pic8]
					'param_title_name'=>'companynum',				//获取板块数据标签***
					'text_title_name_title'=> L('dashboard_wel_company_title'),	//数据介绍
					'text_title_name'=> L('dashboard_wel_company_info'),		//板块名字
					'text_title_name_subhead'=>L('dashboard_wel_company_fu'),	//板块副标题
					'array'=>$showlistarray
					);
		/******板块结束*****/
		/** 
		 *	板块开始2
		 *	人员
		 */
		$showlistarray = array();
		$showlistarray[] = array(
				'param_show_type'=>'normal',					//小模块数据提醒显示 normal(表示普通不发亮),high（表示红色发亮）
				'param_url'=>'index.php?act=wjp_personel&op=list_see',	//小模块跳转连接
				'text_title_name'=> L('dashboard_wel_personel_see'),	//小模块名字
				'param_title_name'=>'personelsee'			//获取数据的标签***
			);
		$showlist[] = array(
					'param_picture_name'=>'pic0',				//板块图片标签[pic0-pic8]
					'param_title_name'=>'personelnum',				//获取板块数据标签***
					'text_title_name_title'=> L('dashboard_wel_personel_title'),	//数据介绍
					'text_title_name'=> L('dashboard_wel_personel_info'),		//板块名字
					'text_title_name_subhead'=>L('dashboard_wel_personel_fu'),	//板块副标题
					'array'=>$showlistarray
					);
		/******板块结束*****/
		/** 
		 *	板块开始3
		 *	司机
		 */
		$showlistarray = array();
		$showlistarray[] = array(
				'param_show_type'=>'normal',					//小模块数据提醒显示 normal(表示普通不发亮),high（表示红色发亮）
				'param_url'=>'index.php?act=wjp_driver&op=list_see',	//小模块跳转连接
				'text_title_name'=> L('dashboard_wel_driver_see'),	//小模块名字
				'param_title_name'=>'driversee'			//获取数据的标签***
			);
		$showlist[] = array(
					'param_picture_name'=>'pic0',				//板块图片标签[pic0-pic8]
					'param_title_name'=>'drivernum',				//获取板块数据标签***
					'text_title_name_title'=> L('dashboard_wel_driver_title'),	//数据介绍
					'text_title_name'=> L('dashboard_wel_driver_info'),		//板块名字
					'text_title_name_subhead'=>L('dashboard_wel_driver_fu'),	//板块副标题
					'array'=>$showlistarray
					);
		/******板块结束*****/
		/** 
		 *	板块开始4
		 *  运单
		 */
		$showlistarray = array();
		$showlistarray[] = array(
				'param_show_type'=>'normal',					//小模块数据提醒显示 normal(表示普通不发亮),high（表示红色发亮）
				'param_url'=>'index.php?act=wjp_order&op=list_see',	//小模块跳转连接
				'text_title_name'=> L('dashboard_wel_order_see'),	//小模块名字
				'param_title_name'=>'ordersee'			//获取数据的标签***
			);
		$showlist[] = array(
					'param_picture_name'=>'pic0',				//板块图片标签[pic0-pic8]
					'param_title_name'=>'ordernum',				//获取板块数据标签***
					'text_title_name_title'=> L('dashboard_wel_order_title'),	//数据介绍
					'text_title_name'=> L('dashboard_wel_order_info'),		//板块名字
					'text_title_name_subhead'=>L('dashboard_wel_order_fu'),	//板块副标题
					'array'=>$showlistarray
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
        // 公司总数
        $this->paramList['companynum'] = $model_stat->count_table('company');
        // 人员总数
        $this->paramList['personelnum'] = $model_stat->count_table('personel')-1;//减去未设置这个人员
        // 司机总数
        $this->paramList['drivernum'] = $model_stat->count_table('driver');
        // 订单总数
        $this->paramList['ordernum'] = $model_stat->count_table('order');

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
