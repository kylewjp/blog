<?php
/**
 * 友情连接管理
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
class friendlinkControl extends SystemControl{

	public function __construct(){
		parent::__construct();
	}
	/**
	 * 友情连接管理
	 */
	public function friendlinkOp(){
		$model_friendlink = Model('friendlink');
		/**
		 * 删除
		 */
		if (chksubmit()){
			if (is_array($_POST['del_id']) && !empty($_POST['del_id'])){
				foreach ($_POST['del_id'] as $k => $v){
					$v = intval($v);
					$model_friendlink->del($v);
				}
				showMessage('操作成功');
			}else {
				showMessage('操作失败');
			}
		}
		/**
		 * 检索条件
		 */
		$condition['like_title'] = trim($_GET['search_title']);
		/**
		 * 分页
		 */
		$page	= new Page();
		$page->setEachNum(10);
		$page->setStyle('admin');
		/**
		 * 列表
		 */
		$friendlink_list = $model_friendlink->getFriendlinkList($condition,$page);


		Tpl::output('friendlink_list',$friendlink_list);
		Tpl::output('page',$page->show());
		Tpl::showpage('friendlink.index');
	}
	
	/**
	 * 友情连接添加
	 */
	public function friendlink_addOp(){
		$model_friendlink = Model('friendlink');
		/**
		 * 保存
		 */
		if (chksubmit()){
			/**
			 * 验证
			 */
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
                array("input"=>$_POST["friendlink_title"], "require"=>"true", "message"=>'友情连接标题不能为空'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error);
			}else {
				
				$insert_array = array();
				$insert_array['friendlink_title'] = trim($_POST['friendlink_title']);
				$insert_array['friendlink_url'] = trim($_POST['friendlink_url']);
				$insert_array['friendlink_show'] = trim($_POST['friendlink_show']);
				$insert_array['friendlink_time'] = time();
				$result = $model_friendlink->add($insert_array);
				if ($result){
					$url = array(
						array(
							'url'=>'index.php?act=friendlink&op=friendlink',
							'msg'=>"返回列表",
						),
						array(
							'url'=>'index.php?act=friendlink&op=friendlink_add',
							'msg'=>"继续添加",
						),
					);
					showMessage("添加成功",$url);
				}else {
					showMessage("添加失败");
				}
			}
		}

        $condition = array();
        $friendlink = $model_friendlink->getFriendlinkList($condition);

		Tpl::output('friendlink',$friendlink);
		Tpl::showpage('friendlink.add');
	}
	
	/**
	 * 友情连接编辑
	 */
	public function friendlink_editOp(){
		$model_friendlink = Model('friendlink');
		
		if (chksubmit()){
			/**
			 * 验证
			 */
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
                array("input"=>$_POST["friendlink_title"], "require"=>"true", "message"=>'友情连接标题不能为空'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error);
			}else {
				
				$update_array = array();
				$update_array['friendlink_id'] = intval($_POST['friendlink_id']);
				$update_array['friendlink_title'] = trim($_POST['friendlink_title']);
				$update_array['friendlink_url'] = trim($_POST['friendlink_url']);
				$update_array['friendlink_show'] = trim($_POST['friendlink_show']);
				
				$result = $model_friendlink->update($update_array);
				if ($result){
					$url = array(
						array(
                            'url'=>'index.php?act=friendlink&op=friendlink',
							'msg'=>'返回列表',
						),
						array(
							'url'=>'index.php?act=friendlink&op=friendlink_edit&friendlink_id='.intval($_POST['friendlink_id']),
							'msg'=>'继续编辑',
						),
					);
					showMessage('编辑成功',$url);
				}else {
					showMessage('编辑失败');
				}
			}
		}

        $friendlink = $model_friendlink->getOneFriendlink(intval($_GET['friendlink_id']));
        if (empty($friendlink)){
            showMessage('友情连接不存在');
        }
        Tpl::output('friendlink',$friendlink);

		Tpl::showpage('friendlink.edit');
	}
}