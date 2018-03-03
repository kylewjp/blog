<?php
/**
 * Created by PhpStorm.
 * User: wjp_kyle
 * Date: 2018/2/2
 * Time: 12:50
 */

class Index{
    public function indexOp(){
        $model_article = Model('article');
        $condition = array();
        $article_list = $model_article->getArticleList($condition);

        $article = array();
        foreach ($article_list as $k=>$v){
            $v['message'] = mb_substr(preg_replace('#\s|\r|\n|\t#','',strip_tags($v['article_content'])),0,15,'utf-8');
            unset($v['article_content']);
            $article[] = $v;
        }
        $classmodel = Model('article_class');
        $condition = array();
        $articleclass = $classmodel->getClassList($condition);
//        print_r($articleclass);
        $articlelist = array();
        foreach($article as $k => $v){
            foreach ($articleclass as $key => $value){
                if($v['ac_id'] == $value['ac_id']){
                    $v['classname'] = $value['ac_name'];
                }
            }
            array_push($articlelist,$v);
        }
        print_r($articlelist);
    }
    public function mainOp(){
        $list = array();
        $picturelist = array(
            array(
                'name' => '1',
                'url' => '../../images/php.png',
            ),
            array(
                'name' => '2',
                'url' => '../../images/java.png',
            ),
            array(
                'name' => '3',
                'url' => 'http://img06.tooopen.com/images/20160818/tooopen_sy_175833047715.jpg',
            ),
        );

        $modellist = array(
            array(
                'id'=>1,
                'title' => '最近更新',
                'icon'=>"../../images/nav_icon_01.png",
                'url' => 'articlelist',
                'color' => 'red'
            ),
            array(
                'id'=>2,
                'title' => '所有文章',
                'icon'=>"../../images/nav_icon_02.png",
                'url' => 'articlelist',
                'color' => 'orange'
            ),
            array(
                'id'=>3,
                'title' => '所有分类',
                'icon'=>"../../images/nav_icon_03.png",
                'url' => 'articleclass',
                'color' => 'yellow'
            ),

            array(
                'id'=>4,
                'title' => '建议留言',
                'icon'=>"../../images/nav_icon_04.png",
                'url' => 'articlelist',
                'color' => 'green'
            ),
            array(
                'id'=>5,
                'title' => '关于我',
                'icon'=>"../../images/nav_icon_05.png",
                'url' => 'articlelist',
                'color' => 'green'
            ),

        );

        $model_article = Model('article');
        $condition['limit'] = 5;
        $condition['article_show'] = 1;
        $article_list = $model_article->getArticleList($condition);

        $article = array();
        if (!empty($article_list)) {

            foreach ($article_list as $k=>$v){
                $v['message'] = mb_substr(preg_replace('#\s|\r|\n|\t#','',strip_tags($v['article_content'])),0,25,'utf-8');
                $v['updatetime'] = date('Y-m-d',$v['article_time']);
                unset($v['article_content']);
                $article[] = $v;
            }
        }
        $classmodel = Model('article_class');
        $condition = array();
        $articleclass = $classmodel->getClassList($condition);

        $articlelist = array();
        foreach($article as $k => $v){
            foreach ($articleclass as $key => $value){
                if($v['ac_id'] == $value['ac_id']){
                    $v['classname'] = $value['ac_name'];
                    $v['coverpath'] = "../../images/recommend_img_" . $value['ac_name'] . ".png";
                }
            }
            $v['star'] =5;
            $articlelist[] = $v;
        }

        $list['picturelist'] = $picturelist;
        $list['modellist'] = $modellist;
        $list['articlelist'] = $articlelist;
        $list['articleclass'] = $articleclass;
        echo json_encode($list);
    }
    public function articleListOp(){
//        $articlemodel = Model('article');
//        $list = array();
//        $id =  empty($_GET['id'])?0:intval($_GET['id']);
//        if ($id == 0) {
//            array_push($list, array(
//                "id"=>0,
//                "class_id"=>$id,
//                "subject"=>"默认数据",
//                "coverpath"=>"../../images/recommend_img_java.png",
//                "star"=>3,
//                "mention"=>'5万人在线测试',
//                "message"=>'我们追求的是没有最长只有更长！'
//            ));
//        }

        $model_article = Model('article');
//        $condition['limit'] = 5;
        $condition['article_show'] = 1;
        $article_list = $model_article->getArticleList($condition);

        $article = array();
        if (!empty($article_list)) {
            foreach ($article_list as $k=>$v){
                $v['message'] = mb_substr(preg_replace('#\s|\r|\n|\t#','',strip_tags($v['article_content'])),0,25,'utf-8');
                $v['updatetime'] = date('Y-m-d',$v['article_time']);
                unset($v['article_content']);
                $article[] = $v;
            }
        }
        $classmodel = Model('article_class');
        $condition = array();
        $articleclass = $classmodel->getClassList($condition);

        $articlelist = array();
        if (!empty($article)) {
            foreach ($article as $k => $v) {
                foreach ($articleclass as $key => $value) {
                    if ($v['ac_id'] == $value['ac_id']) {
                        $v['classname'] = $value['ac_name'];
                        $v['coverpath'] = "../../images/recommend_img_" . $value['ac_name'] . ".png";
                    }
                }
                $v['star'] = 5;
                $articlelist[] = $v;
            }
        }

        echo json_encode($articlelist);
    }


    public function article_detailOp(){
        $articlemodel = Model('article');

        if(isset($_GET['id']) && $_GET['id']!=0){
            $article = $articlemodel -> getOneArticle($_GET['id']);
            $article['article_content'] = str_replace('/data/resource/kindeditor/attached/image','http://www.tpblog.net/data/resource/kindeditor/attached/image',$article['article_content']);
            $article['article_time'] = date('Y-m-d H:m',$article['article_time']);
            echo json_encode($article);
            exit;
        }
//       echo json_encode($article);
    }

    /**
     * @output 所有文章的分类
    */
    public function articleClassOp(){

        $model_article = Model('article');
//        $condition['limit'] = 5;

        $class_id = isset($_GET['ac_id'])?$_GET['ac_id']:0;

        if($class_id == 0){
            $condition['article_show'] = 1;
            $article_list = $model_article->getArticleList($condition);

            $article = array();
            foreach ($article_list as $k=>$v){
                $v['message'] = mb_substr(preg_replace('#\s|\r|\n|\t#','',strip_tags($v['article_content'])),0,25,'utf-8');
                $v['updatetime'] = date('Y-m-d',$v['article_time']);
                unset($v['article_content']);
                $article[] = $v;
            }
            $classmodel = Model('article_class');
            $condition = array();
            $articleclass = $classmodel->getClassList($condition);

            $articlelist = array();
            foreach($article as $k => $v){
                foreach ($articleclass as $key => $value){
                    if($v['ac_id'] == $value['ac_id']){
                        $v['classname'] = $value['ac_name'];
                        $v['coverpath'] = "../../images/recommend_img_" . $value['ac_name'] . ".png";
                    }
                }
                $v['star'] =5;
                $articlelist[] = $v;
            }
        }else{
            $condition['ac_id'] = $class_id;
            $condition['article_show'] = 1;
            $article_list = $model_article->getArticleList($condition);

            $article = array();
            foreach ($article_list as $k=>$v){
                $v['message'] = mb_substr(preg_replace('#\s|\r|\n|\t#','',strip_tags($v['article_content'])),0,25,'utf-8');
                $v['updatetime'] = date('Y-m-d',$v['article_time']);
                unset($v['article_content']);
                $article[] = $v;
            }
            $classmodel = Model('article_class');
            $condition = array();
            $articleclass = $classmodel->getClassList($condition);

            $articlelist = array();
            foreach($article as $k => $v){
                foreach ($articleclass as $key => $value){
                    if($v['ac_id'] == $value['ac_id']){
                        $v['classname'] = $value['ac_name'];
                        $v['coverpath'] = "../../images/recommend_img_" . $value['ac_name'] . ".png";
                    }
                }
                $v['star'] =5;
                $articlelist[] = $v;
            }
        }

        $list['articlelist'] = $articlelist;
        echo json_encode($list);
    }

    /**
     * @parm class_id
     * @output class_id下的aritclelist
    */
    public function classArticleListOp(){

    }


}
