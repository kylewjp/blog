<?php
/**
 * 统计
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
class statModel extends Model{
	public function __construct(){
		parent::__construct();
	}
    /**
     * 更新司机数据
     * 
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function count_table($table) {
        return $this->table($table)->where($condition)->count();
    }
	
	/**
	 * 获取页码数
	 *
	 */
	public function getPage() {
        return $this->showpage();
    }
	
}
