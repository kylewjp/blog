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
defined('InShopNC') or exit('Access Invalid!');
class indexControl extends BaseHomeControl{
    public $list_setting;
    public function __construct(){
        parent::__construct();
        $model_setting = Model('setting');
        $this->list_setting = $model_setting->getListSetting();
    }
    private function htmlToText($str){
        $search = array ("'<script[^>]*?>.*?</script>'si", // 去掉 javascript
            "'<[\/\!]*?[^<>]*?>'si",      // 去掉 HTML 标记
            "'([\r\n])[\s]+'",         // 去掉空白字符
            "'&(quot|#34);'i",         // 替换 HTML 实体
            "'&(amp|#38);'i",
            "'&(lt|#60);'i",
            "'&(gt|#62);'i",
            "'&(nbsp|#160);'i",
            "'&(iexcl|#161);'i",
            "'&(cent|#162);'i",
            "'&(pound|#163);'i",
            "'&(copy|#169);'i",
            "'&#(\d+);'e");          // 作为 PHP 代码运行

        $replace = array ("",
            "",
            "\\1",
            "\"",
            "&",
            "<",
            ">",
            " ",
            chr(161),
            chr(162),
            chr(163),
            chr(169),
            "chr(\\1)");

        $str = preg_replace ($search, $replace, $str);
        return $str;
    }
    private function getArticle($condition,$page,$cut_content=true){

        $model_article = Model('article');
        $model_upload = Model('upload');
        $condition['article_show'] = 1;
        $article_list = $model_article->getArticleList($condition,$page);
        foreach ($article_list as $k=>$v){
            $pic_condition = array(
                'upload_type'=>1,
                'item_id'=>$v['article_id'],
            );
            $article_list[$k]['images'] = $model_upload->getUploadList($pic_condition);
            if ($cut_content){
                $article_list[$k]['article_content'] = $this->htmlToText($article_list[$k]['article_content'] );
            }
        }
        return $article_list;
    }

    //获取产品介绍列表
    private function getProductsArticle(){

        $model_class = Model('article_class');
        $model_article = Model('article');
        /**
         * 父ID
         */
        $parent_id = 1;
        /**
         * 列表
         */
        $tmp_list = $model_class->getTreeClassList(2);
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
        foreach ($class_list as $k=>$v){
            $condition = array();
            $condition['ac_id'] = $v['ac_id'];
            $condition['article_show'] = 1;
            $article_list = $model_article->getArticleList($condition);
            $class_list[$k]['artiles'] = $article_list;
        }
        return $class_list;
    }

    public function indexOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $condition = array();
//        $condition['ac_id'] = 1;
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);


        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //滚动图列表
        $model = Model('mb_home');
        $picture_list = $model->getMbHomeList(array('h_type'=>'显示'));
        Tpl::output('ad_pictures',$picture_list );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('index');
    }

    // 文章详情
    public function articleDetailOp(){
        $model_article = Model('article');
        $id = isset($_GET['id'])?$_GET['id']:0;

//        $showtype = isset($_GET['showtype'])?$_GET['showtype']:0;

        $article_info = $model_article->getOneArticle(intval($id));

        Tpl::output('article_info',$article_info );
//        Tpl::output('showtype',$showtype);
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('articleDetail');
    }

    // 关于我们6
    public function aboutOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 6;
        $condition['article_title'] ='关于我们';
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page,false);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('about');
    }
    //新闻中心2
    public function newsOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(6);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 2;
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('news');
    }
    // 解决方案3
    public function solveOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(5);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 3;
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('solve');
    }
    //成功案例4
    public function caseOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(18);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 4;
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('case');
    }
    //媒体中心5
    public function mediaOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 5;
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('media');
    }
    //环保咨询7
    public function consultOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 7;
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('consult');
    }
    //联系我们6
    public function contactOp(){
        /**
         * 分页
         */
        $page	= new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        $condition = array();
        $condition['ac_id'] = 6;
        $condition['article_title'] ='联系我们';
        /**
         * 列表
         */
        $article_list = $this->getArticle($condition,$page);

        Tpl::output('article_list',$article_list );
        Tpl::output('page',$page->show());
        Tpl::output('list_setting',$this->list_setting );

        //获取产品介绍列表
        $class_list = $this->getProductsArticle();
        Tpl::output('product_list',$class_list );

        Tpl::showpage('contact');
    }

}
