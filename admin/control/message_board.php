<?php
/**
 * 文章管理
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
class message_boardControl extends SystemControl{

	public function __construct(){
		parent::__construct();
		Language::read('article');
	}
	/**
	 * 留言列表
	 */
	public function listOp(){
        $lang	= Language::getLangContent();
		$model_message_board = Model('message_board');
		/**
		 * 删除
		 */
		if (chksubmit()){
			if (is_array($_POST['del_id']) && !empty($_POST['del_id'])){
				foreach ($_POST['del_id'] as $k => $v){
					$v = intval($v);
					$model_message_board->del($v);
				}
				$this->log(L('article_index_del_succ').'[ID:'.implode(',',$_POST['del_id']).']',null);
				showMessage($lang['article_index_del_succ']);
			}else {
				showMessage($lang['article_index_choose']);
			}
		}
		/**
		 * 检索条件
		 */
        if(!empty($_GET['message_board_content'])){
            $condition['message_board_content'] = $_GET['message_board_content'];
        }
        if($_GET['message_board_show'] == 1 || $_GET['message_board_show'] == 0){
            $condition['message_board_show'] = $_GET['message_board_show'];
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
		$message_board_list = $model_message_board->getmessage_boardList($condition,$page);

		Tpl::output('message_board_list',$message_board_list);
		Tpl::output('page',$page->show());

		Tpl::showpage('message_board.index');
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