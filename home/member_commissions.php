<?php
/**
 * 佣金管理
 *
 * @author    feibodai@163.com
 * @addtime   2014/11/19 11:56
 */
defined('InShopNC') or exit('Access Invalid!');
class member_commissionsControl extends BaseMemberControl {
	public function indexOp(){
		$this->commissionsOp();
		exit;
	}
	public function __construct() {
		parent::__construct();
		/**
		 * 读取语言包
		 */
		Language::read('member_member_commissions');
	}
	/**
	 * 佣金日志列表
	 */
	public function commissionsOp(){
		$condition_arr = array();
		$condition_arr['member_id'] = $_SESSION['member_id'];
		$condition_arr['member_name'] = $_SESSION['member_name'];
		$condition_arr['store_id'] = $_GET['store_id'];
		$condition_arr['store_name'] = $_GET['store_name'];
		$condition_arr['buyer_id'] = $_GET['buyer_id'];
		$condition_arr['buyer_name'] = $_GET['buyer_name'];
		$condition_arr['order_id'] = $_GET['order_id'];
		$condition_arr['order_sn'] = $_GET['order_sn'];

		$condition_arr['s_add_time'] = strtotime($_GET['stime']);
		$condition_arr['e_add_time'] = strtotime($_GET['etime']);
        if($condition_arr['e_add_time'] > 0) {
            $condition_arr['e_add_time'] += 86400;
        }
		$condition_arr['pl_desc_like'] = $_GET['description'];
		//分页
		$page	= new Page();
		$page->setEachNum(10);
		$page->setStyle('admin');
		//查询佣金日志列表
		$commissions_model = Model('commissions');
		$list_log = $commissions_model->getcommissionsList($condition_arr,$page,'*','');
		//查询会员信息
		$this->get_member_info();	
		//信息输出
		self::profile_menu('commissions');
		Tpl::output('show_page',$page->show());
		Tpl::output('list_log',$list_log);
		Tpl::output('menu_sign','commissions');
		Tpl::output('menu_sign_url','index.php?act=member_commissions');		
		Tpl::showpage('member_commissions');
	}
	/**
	 * 用户中心右边，小导航
	 *
	 * @param string	$menu_type	导航类型
	 * @param string 	$menu_key	当前导航的menu_key
	 * @param array 	$array		附加菜单
	 * @return 
	 */
	private function profile_menu($menu_key='',$array=array()) {
		Language::read('member_layout');
		$lang	= Language::getLangContent();
		$menu_array		= array();
		$menu_array = array(
			1=>array('menu_key'=>'commissions',	'menu_name'=>"我的收益",	'menu_url'=>'index.php?act=member_commissions'),
		);
		if(!empty($array)) {
			$menu_array[] = $array;
		}
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}
