<?php
/**
 * 清理缓存
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
class cacheControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('cache');
	}

	/**
	 * 清理缓存
	 */
	public function clearOp(){
		$lang	= Language::getLangContent();

		if (chksubmit()){

			//清理所有缓存
			if($_POST['cls_full']==1){
				H('setting',true);H('goods_class',true);H('seo',true);H('goods_class_seo',true);
				H('class_tag',true);H('groupbuy',true);H('nav',true);H('express',true);
				H('store_class',true);
				H('store_grade',true);
				H('circle_level',true);
				delCacheFile('fields');
				delCacheFile('index');
		        showMessage($lang['cache_cls_ok']);exit;
			}

			//清理基本缓存
			if (@in_array('setting',$_POST['cache'])){
				H('setting',true);
			}

			//清理底部导航 缓存
			if (@in_array('nav',$_POST['cache'])){
				H('nav',true);
			}

			//清理TABLE缓存
			if (@in_array('table',$_POST['cache'])){
		        delCacheFile('fields');
			}
			
			$this->log(L('cache_cls_operate'));
			showMessage($lang['cache_cls_ok']);
		}

		Tpl::showpage('cache.clear');
	}

}
