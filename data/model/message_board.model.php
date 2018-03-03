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

class message_boardModel{
	/**
	 * 列表
	 *
	 * @param array $condition 检索条件
	 * @param obj $page 分页
	 * @return array 数组结构的返回结果
	 */
	public function getmessage_boardList($condition,$page=''){
		$condition_str = $this->_condition($condition);
		$param = array();
		$param['table'] = 'message_board';
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= (empty($condition['order'])?'message_board_sort asc,message_board_time desc':$condition['order']);
		$result = Db::select($param,$page);
		return $result;
	}

	/**
	 * 连接查询列表
	 *
	 * @param array $condition 检索条件
	 * @param obj $page 分页
	 * @return array 数组结构的返回结果
	 */
	public function getJoinList($condition,$page=''){
		$result	= array();
		$condition_str	= $this->_condition($condition);
		$param	= array();
		$param['table'] = 'message_board,message_board_class';
		$param['field']	= empty($condition['field'])?'*':$condition['field'];;
		$param['join_type']	= empty($condition['join_type'])?'left join':$condition['join_type'];
		$param['join_on']	= array('message_board.ac_id=message_board_class.ac_id');
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= empty($condition['order'])?'message_board.message_board_sort':$condition['order'];
		$result = Db::select($param,$page);
		return $result;
	}

	/**
	 * 构造检索条件
	 *
	 * @param int $id 记录ID
	 * @return string 字符串类型的返回结果
	 */
	private function _condition($condition){
		$condition_str = '';

        if ($condition['message_board_show'] != ''){
            $condition_str .= " and message_board.message_board_show = '". $condition['message_board_show'] ."'";
        }
        if ($condition['message_board_phone'] != ''){
            $condition_str .= " and message_board.message_board_phone = '". $condition['message_board_phone'] ."'";
        }
        if ($condition['like_message_board_phone'] != ''){
            $condition_str .= " and message_board.message_board_phone like '%". $condition['like_message_board_phone'] ."%'";
        }
        if ($condition['message_board_name'] != ''){
            $condition_str .= " and message_board.message_board_phone = '". $condition['message_board_phone'] ."'";
        }
        if ($condition['like_message_board_name'] != ''){
            $condition_str .= " and message_board.message_board_name like '%". $condition['like_message_board_name'] ."%'";
        }
        if ($condition['message_board_content'] != ''){
            $condition_str .= " and message_board.message_board_content like '%". $condition['message_board_content'] ."%'";
        }

		return $condition_str;
	}

	/**
	 * 取单个内容
	 *
	 * @param int $id ID
	 * @return array 数组类型的返回结果
	 */
	public function getOnemessage_board($id){
		if (intval($id) > 0){
			$param = array();
			$param['table'] = 'message_board';
			$param['field'] = 'message_board_id';
			$param['value'] = intval($id);
			$result = Db::getRow($param);
			return $result;
		}else {
			return false;
		}
	}

	/**
	 * 新增
	 *
	 * @param array $param 参数内容
	 * @return bool 布尔类型的返回结果
	 */
	public function add($param){
		if (empty($param)){
			return false;
		}
		if (is_array($param)){
			$tmp = array();
			foreach ($param as $k => $v){
				$tmp[$k] = $v;
			}
			$result = Db::insert('message_board',$tmp);
			return $result;
		}else {
			return false;
		}
	}

	/**
	 * 更新信息
	 *
	 * @param array $param 更新数据
	 * @return bool 布尔类型的返回结果
	 */
	public function update($param){
		if (empty($param)){
			return false;
		}
		if (is_array($param)){
			$tmp = array();
			foreach ($param as $k => $v){
				$tmp[$k] = $v;
			}
			$where = " message_board_id = '". $param['message_board_id'] ."'";
			$result = Db::update('message_board',$tmp,$where);
			return $result;
		}else {
			return false;
		}
	}

	/**
	 * 删除
	 *
	 * @param int $id 记录ID
	 * @return bool 布尔类型的返回结果
	 */
	public function del($id){
		if (intval($id) > 0){
			$where = " message_board_id = '". intval($id) ."'";
			$result = Db::delete('message_board',$where);
			return $result;
		}else {
			return false;
		}
	}
}