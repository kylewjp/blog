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

class articleModel{
	/**
	 * 列表
	 *
	 * @param array $condition 检索条件
	 * @param obj $page 分页
	 * @return array 数组结构的返回结果
	 */
	public function getArticleList($condition,$page=''){
		$condition_str = $this->_condition($condition);
		$param = array();
		$param['table'] = 'article';
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= (empty($condition['order'])?'article_sort asc,article_time desc':$condition['order']);
		$result = Db::select($param,$page);
		return $result;
	}


    /**
     * 列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果，以article_time desc为条件
     */
    public function getAllArticleList($condition,$page=''){
        $condition_str = $this->_condition($condition);
        $param = array();
        $param['table'] = 'article';
        $param['where'] = $condition_str;
        $param['limit'] = $condition['limit'];
        $param['order']	= (empty($condition['order'])?'article_time desc':$condition['order']);
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
		$param['table'] = 'article,article_class';
		$param['field']	= empty($condition['field'])?'*':$condition['field'];;
		$param['join_type']	= empty($condition['join_type'])?'left join':$condition['join_type'];
		$param['join_on']	= array('article.ac_id=article_class.ac_id');
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= empty($condition['order'])?'article.article_sort':$condition['order'];
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

        if ($condition['big_article_id'] != ''){
            $condition_str .= " and article.article_id > ". $condition['big_article_id'] ." ";
        }
        if ($condition['small_article_id'] != ''){
            $condition_str .= " and article.article_id < ". $condition['small_article_id'] ." ";
        }
        if ($condition['article_id'] != ''){
            $condition_str .= " and article.article_id = '". $condition['article_id'] ."'";
        }
        if ($condition['article_title'] != ''){
            $condition_str .= " and article.article_title = '". $condition['article_title'] ."'";
        }
        if ($condition['article_show'] != ''){
            $condition_str .= " and article.article_show = '". $condition['article_show'] ."'";
        }
		if ($condition['ac_id'] != ''){
			$condition_str .= " and article.ac_id = '". $condition['ac_id'] ."'";
		}
        if ($condition['ac_ids'] != ''){
            //if(is_array($condition['ac_ids']))$condition['ac_ids']	= implode(',',$condition['ac_ids']);
            $condition_str .= " and article.ac_id in(". $condition['ac_ids'] .")";
        }
        if ($condition['ac_id_childs'] != ''){
            $article_class = Model('article_class');
            $childs = $article_class->getChildClass($condition['ac_id_childs']);
            $condition_str .= " and article.ac_id in(";
            $index = 0;
            foreach ($childs as $key=>$value){
                if ($index==0){
                    $index++;
                }else{
                    $condition_str .= ",";
                }
                $condition_str .= $value['ac_id'];
            }
            $condition_str .= ")";
        }
		if ($condition['like_title'] != ''){
			$condition_str .= " and article.article_title like '%". $condition['like_title'] ."%'";
		}
		if ($condition['home_index'] != ''){
			$condition_str .= " and (article_class.ac_id <= 7 or (article_class.ac_parent_id > 0 and article_class.ac_parent_id <= 7))";
		}

		return $condition_str;
	}

	/**
	 * 取单个内容
	 *
	 * @param int $id ID
	 * @return array 数组类型的返回结果
	 */
	public function getOneArticle($id){
		if (intval($id) > 0){
			$param = array();
			$param['table'] = 'article';
			$param['field'] = 'article_id';
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
			$result = Db::insert('article',$tmp);
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
			$where = " article_id = '". $param['article_id'] ."'";
			$result = Db::update('article',$tmp,$where);
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
			$where = " article_id = '". intval($id) ."'";
			$result = Db::delete('article',$where);
			return $result;
		}else {
			return false;
		}
	}
}