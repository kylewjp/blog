<?php
/**
 * 默认展示页面
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
//defined('InShopNC') or exit('Access Invalid!');
class indexControl extends BaseHomeControl{
    public $list_setting;
    public function __construct(){
        parent::__construct();
        $model_setting = Model('setting');
        $this->list_setting = $model_setting->getListSetting();

        // 加入5篇推荐文章
        $recommend_condition = array();
        $recommend_condition['order'] = 'article.article_sort';
        $recommend_condition['limit'] = 5;
        $recommend = $this->getArticle($recommend_condition,'');
        Tpl::output('recommend', $recommend);


        //取出配置信息
        $setting = Model('setting');
        $settinglist = $setting ->getListSetting();
        Tpl::output('settinglist',$settinglist);

        //取出链接
        $friend = Model('friendlink');
        $friendlink = $friend->getFriendlinkList(0);
        Tpl::output('friendlink',$friendlink);



    }

    private function getArticle($condition,$page,$cut_content=true){

        $model_article = Model('article');
        $model_upload = Model('upload');
        $condition['article_show'] = 1;
        $article_list = $model_article->getArticleList($condition,$page);
        if(!empty($article_list)){
            foreach ($article_list as $k=>$v){
                $pic_condition = array(
                    'upload_type'=>1,
                    'item_id'=>$v['article_id'],
                );
                $article_list[$k]['images'] = $model_upload->getUploadList($pic_condition);
                $article_list[$k]['article_content_all'] = $article_list[$k]['article_content'] ;
                if ($cut_content){
                    $article_list[$k]['article_content'] = htmlToText($article_list[$k]['article_content'] );
                }
            }
        }
        return $article_list;
    }
    //获取产品介绍列表
    private function getProductsArticle($parent_id=1,$condition1 = array(),$page=''){
        $class_list = array();
        $model_class = Model('article_class');
        $model_article = Model('article');
        $model_upload = Model('upload');
        /**
         * 列表
         */
        $tmp_list = $model_class->getTreeClassList(2,$condition1);
//        print_r($tmp_list);
        if (is_array($tmp_list)){
            foreach ($tmp_list as $k => $v){
                if ($v['ac_parent_id'] == $parent_id){
                    /**
                     * 判断是否有子类
                     */
                    if ($tmp_list[$k+1]['deep'] > $v['deep']){
                        $v['have_child'] = 1;
                    }
                    $class_list[] = $v;
                }
            }
        }
//        print_r($class_list);
        if (is_array($class_list)) {
            foreach ($class_list as $k => $v) {
                $condition = array();
                $condition['ac_id'] = $v['ac_id'];
                $condition['article_show'] = 1;
                $condition_page  = $page;
                $article_list = $model_article->getArticleList($condition,$condition_page);
                $has_picture = false;
                $has_url = false;
                if(!empty($article_list)){
                    foreach ($article_list as $key=>$value){
                        $pic_condition = array(
                            'upload_type'=>1,
                            'item_id'=>$value['article_id'],
                        );
                        $picture_list = $model_upload->getUploadList($pic_condition);
                        if(count($picture_list)>0){
                            $has_picture = true;
                        }
                        if(!empty($value['article_url'])){
                            $has_url = true;
                        }
                        $article_list[$key]['pictures'] = $picture_list;
                    }
                }

                $class_list[$k]['artiles'] = $article_list;
                if ($condition_page != ''){
                    $class_list[$k]['page'] = $condition_page->show();
                }
                $class_list[$k]['has_picture'] = $has_picture;
                $class_list[$k]['has_url'] = $has_url;
            }
        }
        return $class_list;
    }

    public function indexOp(){
        $article = Model('article');
        $condition['order'] = 'article_time desc';

        $page = new Page();
        $page->setEachNum(10);
        $page->setTotalNum(count($article->getArticleList($condition)));
//        $page->setStyle('admin');
        $pagelist = $page->show();
        $article_list = $article->getArticleList($condition,$page);
        $article_class = Model('article_class');
        if(!empty($article_list)){
            foreach($article_list as $k=>$v){
                $data = array();
                $data = $article_class->getOneClass($v['ac_id']);
                $article_list[$k]['ac_name'] = $data['ac_name'];
            }
        }

        Tpl::output('pagelist',$pagelist);
        Tpl::output('article_list',$article_list);
        Tpl::showpage('index');
    }

    // 通用文章框架
    private function articleModel($pageName='articleModel'){
        $condition = array();
        $class_id = 0 ;
        if(isset($_GET['class_id'])){
            $class_id = $_GET['class_id'];
        }
        $condition['ac_id_childs'] = $class_id;
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        //获取文章列表
        $article_list = $this->getArticle($condition,$page);
        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());

        $model_class = Model('article_class');

        $class_now_info = $model_class->getOneClass($class_id);
        // 子栏目列表
        $condition1 = array();
        $condition1['ac_parent_id'] = $class_now_info['ac_parent_id'];
        $class_list = $model_class->getClassList($condition1);
        Tpl::output('class_list',$class_list );

        // 父栏目信息
        $class_info = $model_class->getOneClass($class_now_info['ac_parent_id']);
        Tpl::output('class_info',$class_info );

        Tpl::showpage($pageName);
    }



    //所有文章
//    public function articleListOp(){
//        $this->articleListsModelOp();
//    }

    //所有文章题目
    public function articleListOp($pageName = 'articleList'){
        $articleTitle = array();
        $article = Model('article');
        $articleList = $article->getALLArticleList(0);
        if (!empty($articleList)) {
            foreach ($articleList as $k =>$v){
                $data = array();
                $keys = date('Y',$v['article_time']);
                $data['article_time'] = date('Y-m-d',$v['article_time']);
                $data['article_title'] = $v['article_title'];
                $data['article_id'] = $v['article_id'];
                $articleTitle[$keys][] = $data;
            }
        }

        Tpl::output('articleTitle',$articleTitle);
        Tpl::showpage($pageName);
    }

    //文章分类
    public function articleClassOp($pageName = 'articleClass'){
//        $articleTitle = array();
        $article = Model('article');
        $articleList = $article->getALLArticleList(0);

        Tpl::output('articleList',$articleList);

        $article_class = Model('article_class');

        $condition['order'] = 'ac_id asc';
        $articleclass = $article_class->getClassList($condition);



        Tpl::output('articleclass',$articleclass);

        Tpl::showpage($pageName);
    }




    //二维数组进行排序
    /**
     * 二维数组根据字段进行排序
     * @params array $array 需要排序的数组
     * @params string $field 排序的字段
     * @params string $sort 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
     */
    private function arraySequence($array, $field, $sort = 'SORT_DESC')
    {
        $arrSort = array();
        foreach ($array as $uniqid => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        array_multisort($arrSort[$field], constant($sort), $array);
        return $array;
    }




    //联系我们
    public function contactOp(){
        if ($_GET['class_id'] == 35){
            if (isset($_GET['chksubmit'])){
                $message_board_model = Model('message_board');
                $condition = array(
                    'message_board_name'=>$_POST['name'],
                    'message_board_phone'=>$_POST['phone'],
                    'message_board_email'=>$_POST['email'],
                    'message_board_content'=>$_POST['information'],
                    'message_board_time'=>time(),
                    'message_board_show'=>0,
                );
                $result = $message_board_model->add($condition);

                if ($result){
                    print_r('留言发送成功');
                }else {
                    print_r('留言发送失败');
                }
                exit;
            }
            Tpl::showpage('contact');
        }else{
            $this->articleModel();
        }

    }

    // 文章详情
    public function articleDetailOp(){
        $model_article = Model('article');
        $id = isset($_GET['article_id'])?$_GET['article_id']:0;
        $article_info = $model_article->getOneArticle(intval($id));
        Tpl::output('article_info',$article_info );

//        $condition = array();
//        $condition['limit'] = 1 ;
//        $condition['small_article_id'] = $id ;
//        $condition['ac_id'] = $article_info['ac_id'] ;
//        $condition1 = array();
//        $condition1['limit'] = 1 ;
//        $condition1['big_article_id'] = $id ;
//        $condition1['ac_id'] = $article_info['ac_id'] ;
//        $article_left_list = $model_article->getArticleList($condition);
//        $article_right_list = $model_article->getArticleList($condition1);
//        if(count($article_left_list)>0){
//            $article_left = $article_left_list[0];
//        }else {
//            $article_left = array();
//        }
//        if(count($article_right_list)>0){
//            $article_right = $article_right_list[0];
//        }else {
//            $article_right = array();
//        }
//        Tpl::output('article_left',$article_left );
//        Tpl::output('article_right',$article_right );

        Tpl::showpage('articleDetail');
    }

    // 文章搜索结果
    public function searchOp(){
        $condition = array();
        if(isset($_GET['keyword'])){
            $condition['like_title']  = trim($_GET['keyword']);
        }
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        //获取文章列表
        $article_list = $this->getArticle($condition,$page);
        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());


        Tpl::showpage('articleModel');
    }


    //关于我
    public function aboutMeOp($pageName='aboutMe'){

        $aboutme = Model('aboutme');
        $aboutmelist = $aboutme->getListSetting();

        Tpl::output('aboutmelist',$aboutmelist);


        Tpl::showpage($pageName);
    }


    //分页


}

