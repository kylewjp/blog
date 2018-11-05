<?php
/**
 * 文件管理
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
class uploadControl extends SystemControl{

	public function __construct(){
		parent::__construct();
	}
	/**
	 * 文件列表
	 */
	public function indexOp(){
        $model_upload = Model('upload');
        $condition = array();
        /**
         * 删除
         */
        if (chksubmit()){
            if (is_array($_POST['del_id']) && !empty($_POST['del_id'])){
                foreach ($_POST['del_id'] as $k => $v){
                    $file_array = $model_upload->getOneUpload(intval($v));
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE.DS.$file_array['file_name']);
                    $model_upload->del($v);
                }
                $this->log('删除文件 [ID:'.implode(',',$_POST['del_id']).']',null);
                showMessage('删除成功');
            }else {
                showMessage('删除失败');
            }
        }
		/**
		 * 检索条件
		 */
        if(trim($_GET['search_file_name'])!=''){
            $condition['like_file_name'] = $_GET['search_file_name'];
        }
        if(trim($_GET['search_upload_type']) != ''){
            $condition['upload_type'] = $_GET['search_upload_type'];
        }
		/**
		 * 分页
		 */
		$page	= new Page();
		$page->setEachNum(10);
		$page->setStyle('admin');
		/**
		 * 列表
		 */
		$upload_list = $model_upload->getUploadList($condition,$page);

		Tpl::output('upload_list',$upload_list);
		Tpl::output('page',$page->show());

		Tpl::showpage('upload.index');
	}

    /**
     * 文件上传
     */
    public function file_uploadOp(){
        /**
         * 上传图片
         */
        $upload_file = $_FILES['fileupload'];
        if ($upload_file['tmp_name'] == ""){
            echo json_encode(array('status'=>0,'msg'=>'选择文件不能为空'));
            exit;
        }
        //验证文件大小
        if ($upload_file['size']==0){
            echo json_encode(array('status'=>0,'msg'=>'选择文件不能为空'));
            exit;
        }
        $file_name = $upload_file['name'];

        if(@move_uploaded_file($upload_file['tmp_name'],BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE.DS.$file_name)){
            /**
             * 模型实例化
             */
            $model_upload = Model('upload');
            if($model_upload->getUploadList(array('file_name'=>$file_name))) {
                $result = true;
            }else{
                /**
                 * 图片数据入库
                 */
                $insert_array = array();
                $insert_array['file_name'] = $file_name;
                $insert_array['upload_type'] = '2';
                $insert_array['file_size'] = $_FILES['fileupload']['size'];
                $insert_array['upload_time'] = time();
                $insert_array['item_id'] = intval($_POST['item_id']);
                $result = $model_upload->add($insert_array);
            }
            if ($result){
                $data = array();
                $data['file_id'] = $result;
                $data['file_name'] = $file_name;
                $data['file_path'] = BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE.DS.$file_name;
                /**
                 * 整理为json格式
                 */
                echo json_encode(array('status'=>1,'msg'=>'上传成功','output'=>$data));
            }else{
                echo json_encode(array('status'=>0,'msg'=>'上传成功，保存记录失败'));
            }
            exit;
        }else{
            echo json_encode(array('status'=>0,'msg'=>'上传失败','upload_file'=>$upload_file,'filename'=>BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE.DS.$file_name));
            exit;
        }

    }
    /**
     * ajax操作
     */
    public function ajaxOp(){
        switch ($_GET['type']){
            //修改订单状态
            case 'change':
                $message_board_model = Model('message_board');

                $orderid= $_GET['message_board_id'];
                $type= $_GET['status'];
                $condition['message_board_id'] = $orderid;
                $condition['message_board_show'] = $type;
                $result = $message_board_model->update($condition);
                if ($result){
                    exit('true');
                }else {
                    exit('false');
                }
                break;
        }
    }
}