<?php
/**
 * 网站设置
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
class settingControl extends SystemControl{
	private $links = array(
		array('url'=>'act=setting&op=base','lang'=>'web_set'),
//		array('url'=>'act=setting&op=dump','lang'=>'dis_dump'),
	);
	public function __construct(){
		parent::__construct();
		Language::read('setting');
	}

	/**
	 * 基本信息
	 */
	public function baseOp(){
		$model_setting = Model('setting');
		if (chksubmit()){
			//上传网站Logo
			if (!empty($_FILES['site_logo']['name'])){
				$upload = new UploadFile();
				$upload->set('default_dir',ATTACH_COMMON);
				$result = $upload->upfile('site_logo');
				if ($result){
					$_POST['site_logo'] = $upload->file_name;
				}else {
					showMessage($upload->error,'','exception','error');
				}
			}
			if (!empty($_FILES['member_logo']['name'])){
				$upload = new UploadFile();
				$upload->set('default_dir',ATTACH_COMMON);
				$result = $upload->upfile('member_logo');
				if ($result){
					$_POST['member_logo'] = $upload->file_name;
				}else {
					showMessage($upload->error,'','exception','error');
				}
			}
            if (!empty($_FILES['seller_center_logo']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_COMMON);
                $result = $upload->upfile('seller_center_logo');
                if ($result){
                    $_POST['seller_center_logo'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','exception','error');
                }
            }
			$list_setting = $model_setting->getListSetting();
			$update_array = array();
//			$update_array['time_zone'] = $this->setTimeZone($_POST['time_zone']);
			$update_array['site_name'] = $_POST['site_name'];
            $update_array['site_intro'] = $_POST['site_intro'];
			if (!empty($_POST['site_logo'])){
				$update_array['site_logo'] = $_POST['site_logo'];
			}
			if (!empty($_POST['member_logo'])){
				$update_array['member_logo'] = $_POST['member_logo'];
			}
			if (!empty($_POST['seller_center_logo'])){
				$update_array['seller_center_logo'] = $_POST['seller_center_logo'];
			}
			$result = $model_setting->updateSetting($update_array);
			if ($result === true){
				//判断有没有之前的图片，如果有则删除
			    if (!empty($list_setting['site_logo']) && !empty($_POST['site_logo'])){
			        @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['site_logo']);
			    }
			    if (!empty($list_setting['member_logo']) && !empty($_POST['member_logo'])){
			        @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['member_logo']);
			    }
			    if (!empty($list_setting['seller_center_logo']) && !empty($_POST['seller_center_logo'])){
			        @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['seller_center_logo']);
			    }
				$this->log(L('nc_edit,web_set'),1);
				showMessage(L('nc_common_save_succ'));
			}else {
				$this->log(L('nc_edit,web_set'),0);
				showMessage(L('nc_common_save_fail')); 
			}
		}
		$list_setting = $model_setting->getListSetting();
		foreach ($this->getTimeZone() as $k=>$v) {
			if ($v == $list_setting['time_zone']){
				$list_setting['time_zone'] = $k;break;
			}
		}
		Tpl::output('list_setting',$list_setting);

		//输出子菜单
		Tpl::output('top_link',$this->sublink($this->links,'base'));
		
		Tpl::showpage('setting.base');
	}
	
	/**
	 * 防灌水设置
	 */
	public function dumpOp(){
		$model_setting = Model('setting');
		if (chksubmit()){
			$update_array = array();
			$update_array['guest_comment'] = $_POST['guest_comment'];				
			$update_array['captcha_status_login'] = $_POST['captcha_status_login'];
			$update_array['captcha_status_register'] = $_POST['captcha_status_register'];
			$update_array['captcha_status_goodsqa'] = $_POST['captcha_status_goodsqa'];
			$result = $model_setting->updateSetting($update_array);
			if ($result === true){
				$this->log(L('nc_edit,dis_dump'),1);
				showMessage(L('nc_common_save_succ'));
			}else {
				$this->log(L('nc_edit,dis_dump'),0);
				showMessage(L('nc_common_save_fail'));
			}
		}
		$list_setting = $model_setting->getListSetting();
		Tpl::output('list_setting',$list_setting);
		Tpl::output('top_link',$this->sublink($this->links,'dump'));
		Tpl::showpage('setting.dump');
	}

    /**
     * 网站功能模块开启或者关闭
     *
     */
	public function website_settingOp(){
		$model_setting = Model('setting');
		//保存信息
		if (chksubmit()){
			//构造更新数据数组
			$update_array = array();
			//站外分享功能
			$update_array['share_isuse'] = trim($_POST['share_isuse']);
			$result = $model_setting->updateSetting($update_array);
			if ($result === true){
				showMessage(Language::get('nc_common_save_succ'));
			}else {
				showMessage(Language::get('nc_common_save_fail'));
			}
		}
		//读取设置内容 $list_setting
		$list_setting = $model_setting->getListSetting();
		//模板输出
		Tpl::output('list_setting',$list_setting);
		Tpl::showpage('setting.website_setting');
	}
	
	/**
	 * 设置时区
	 *
	 * @param int $time_zone 时区键值
	 */
	private function setTimeZone($time_zone){
		$zonelist = $this->getTimeZone();
		return empty($zonelist[$time_zone]) ? 'Asia/Shanghai' : $zonelist[$time_zone];
	}

	private function getTimeZone(){
		return array(
		'-12' => 'Pacific/Kwajalein',
		'-11' => 'Pacific/Samoa',
		'-10' => 'US/Hawaii',
		'-9' => 'US/Alaska',
		'-8' => 'America/Tijuana',
		'-7' => 'US/Arizona',
		'-6' => 'America/Mexico_City',
		'-5' => 'America/Bogota',
		'-4' => 'America/Caracas',
		'-3.5' => 'Canada/Newfoundland',
		'-3' => 'America/Buenos_Aires',
		'-2' => 'Atlantic/St_Helena',
		'-1' => 'Atlantic/Azores',
		'0' => 'Europe/Dublin',
		'1' => 'Europe/Amsterdam',
		'2' => 'Africa/Cairo',
		'3' => 'Asia/Baghdad',
		'3.5' => 'Asia/Tehran',
		'4' => 'Asia/Baku',
		'4.5' => 'Asia/Kabul',
		'5' => 'Asia/Karachi',
		'5.5' => 'Asia/Calcutta',
		'5.75' => 'Asia/Katmandu',
		'6' => 'Asia/Almaty',
		'6.5' => 'Asia/Rangoon',
		'7' => 'Asia/Bangkok',
		'8' => 'Asia/Shanghai',
		'9' => 'Asia/Tokyo',
		'9.5' => 'Australia/Adelaide',
		'10' => 'Australia/Canberra',
		'11' => 'Asia/Magadan',
		'12' => 'Pacific/Auckland'
		);		
	}


}
