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

class friendlinkModel{
	/**
	 * 列表
	 *
	 * @param array $condition 检索条件
	 * @param obj $page 分页
	 * @return array 数组结构的返回结果
	 */
	public function getFriendlinkList($condition,$page=''){
		$condition_str = $this->_condition($condition);
		$param = array();
		$param['table'] = 'friendlink';
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= (empty($condition['order'])?'friendlink_time desc':$condition['order']);
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

        if ($condition['friendlink_id'] != ''){
            $condition_str .= " and friendlink.friendlink_id = '". $condition['friendlink_id'] ."'";
        }
        if ($condition['friendlink_title'] != ''){
            $condition_str .= " and friendlink.friendlink_title = '". $condition['friendlink_title'] ."'";
        }
        if ($condition['friendlink_show'] != ''){
            $condition_str .= " and friendlink.friendlink_show = '". $condition['friendlink_show'] ."'";
        }
		if ($condition['like_title'] != ''){
			$condition_str .= " and friendlink.friendlink_title like '%". $condition['like_title'] ."%'";
		}
		return $condition_str;
	}

	/**
	 * 取单个内容
	 *
	 * @param int $id ID
	 * @return array 数组类型的返回结果
	 */
	public function getOneFriendlink($id){
		if (intval($id) > 0){
			$param = array();
			$param['table'] = 'friendlink';
			$param['field'] = 'friendlink_id';
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
			$result = Db::insert('friendlink',$tmp);
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
			$where = " friendlink_id = '". $param['friendlink_id'] ."'";
			$result = Db::update('friendlink',$tmp,$where);
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
			$where = " friendlink_id = '". intval($id) ."'";
			$result = Db::delete('friendlink',$where);
			return $result;
		}else {
			return false;
		}
	}
}