<?php
/**
 * 合作伙伴管理
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2012 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class mb_homeControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('mobile');
	}

	/**
	 * 列表 
	 */
	public function mb_home_listOp(){
		$model = Model('mb_home');
        /**
         * 删除
         */
        if (chksubmit()){
            if (is_array($_POST['del_id']) && !empty($_POST['del_id'])){
                foreach ($_POST['del_id'] as $k => $v){
                    $v = intval($v);
                    $model->del($v);
                }
                showMessage('删除成功');
            }else {
                showMessage('请选择要删除项');
            }
        }

		$h_list = $model->getMbHomeList(array());
		Tpl::output('h_list',$h_list);

		//商品分类
		$goods_class = ($nav = F('goods_class'))? $nav :H('goods_class',true,'file');
		Tpl::output('goods_class',$goods_class);		

		Tpl::showpage('mb_home.list');
	}
	
	/**
	 * 编辑
	 */
	public function mb_home_editOp(){
		$model = Model('mb_home');

		if ($_POST['form_submit'] == 'ok'){
			//验证
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["h_title"], "require"=>"true", "message"=>L('home_add_null')),
				array("input"=>$_POST["h_desc"], "require"=>"true", "message"=>L('home_add_null')),
				array("input"=>$_POST["h_keyword"], "require"=>"true", "message"=>L('home_add_null')),
				array("input"=>$_POST["h_sort"], "require"=>"true", 'validator'=>'Number', "message"=>L('home_add_sort_int')),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error);
			}else {
			    $home_array = $model->getMbHomeInfoByID(intval($_POST['h_id']));
				//上传图片
				if ($_FILES['h_img']['name'] != ''){
					$upload = new UploadFile();
					$upload->set('default_dir',ATTACH_MOBILE.'/home');
					
					$result = $upload->upfile('h_img');
					if ($result){
						$_POST['h_img'] = $upload->file_name;
					}else {
						showMessage($upload->error);
					}
				}
				
				$update_array = array();
				$update_array['h_type'] = trim($_POST['h_type']);

				$update_array['h_title'] = trim($_POST['h_title']);
				$update_array['h_desc'] = trim($_POST['h_desc']);
				$update_array['h_keyword'] = trim($_POST['h_keyword']);
				$update_array['h_url'] = trim($_POST['h_url']);
                if(!empty($_POST['h_multi_keyword'])) {
                    $update_array['h_multi_keyword'] = $_POST['h_multi_keyword'];
                }
				if ($_POST['h_img']){
					$update_array['h_img'] = $_POST['h_img'];
				}
				$update_array['h_sort'] = trim($_POST['h_sort']);

                $condition = array();
				$condition['h_id'] = intval($_POST['h_id']);

				$result = $model->editMbHome($update_array, $condition);
				if ($result){
					//除图片
					if (!empty($_POST['h_img']) && !empty($home_array['h_img'])){
						@unlink(BASE_ROOT_PATH.DS.DIR_UPLOAD.DS.ATTACH_MOBILE.'/home'.DS.$home_array['h_img']);
					}
					showMessage(L('home_edit_succ'),'index.php?act=mb_home&op=mb_home_list');
				}else {
					showMessage(L('home_edit_fail'));
				}
			}
		}
		
		$home_array = $model->getMbHomeInfoByID(intval($_GET['h_id']));
		if (empty($home_array)){
			showMessage(L('wrong_argument'));
		}		
		
		Tpl::output('home_array',$home_array);
		Tpl::showpage('mb_home.edit');
	}

	/**
	 * 编辑
	 */
	public function mb_home_addOp(){
		$model = Model('mb_home');

		if ($_POST['form_submit'] == 'ok'){
			//验证
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["h_title"], "require"=>"true", "message"=>L('home_add_null')),
				array("input"=>$_POST["h_desc"], "require"=>"true", "message"=>L('home_add_null')),
				array("input"=>$_POST["h_keyword"], "require"=>"true", "message"=>L('home_add_null')),
				array("input"=>$_POST["h_sort"], "require"=>"true", 'validator'=>'Number', "message"=>L('home_add_sort_int')),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error);
			}else {
			    $home_array = array();
				//上传图片
				if ($_FILES['h_img']['name'] != ''){
					$upload = new UploadFile();
					$upload->set('default_dir',ATTACH_MOBILE.'/home');
					
					$result = $upload->upfile('h_img');
					if ($result){
						$_POST['h_img'] = $upload->file_name;
					}else {
						showMessage($upload->error);
					}
				}
				
				$insert_array = array();
				$insert_array['h_type'] = trim($_POST['h_type']);
				$insert_array['h_title'] = trim($_POST['h_title']);
				$insert_array['h_desc'] = trim($_POST['h_desc']);
				$insert_array['h_keyword'] = trim($_POST['h_keyword']);
				$insert_array['h_url'] = trim($_POST['h_url']);
                if(!empty($_POST['h_multi_keyword'])) {
                    $insert_array['h_multi_keyword'] = $_POST['h_multi_keyword'];
                }
				if ($_POST['h_img']){
					$insert_array['h_img'] = $_POST['h_img'];
				}
				$insert_array['h_sort'] = trim($_POST['h_sort']);



				$result = $model->add($insert_array);
				if ($result){

					showMessage(L('home_add_succ'),'index.php?act=mb_home&op=mb_home_list');
				}else {
					showMessage(L('home_add_fail'));
				}
			}
		}
		

		Tpl::showpage('mb_home.add');
	}

	/**
	 * ajax操作
	 */
	public function ajaxOp(){
		switch ($_GET['branch']){
			//排序
			case 'h_sort':
				$model_link = Model('mb_home');
				$update_array = array();
				$update_array[$_GET['column']] = trim($_GET['value']);
                $condition = array();
				$condition['h_id'] = intval($_GET['id']);
				$result = $model_link->update($update_array, $condition);
				echo 'true';exit;
				break;
		}
	}
}
