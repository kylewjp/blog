<?php
/**
 * Created by PhpStorm.
 * User: wjp_kyle
 * Date: 2018/2/2
 * Time: 12:50
 */

class Pay
{
    public function indexOp(){
        print_r('welcome op to index!');
        $model_article = Model('article');
        $condition = array();
        $article_list = $model_article->getArticleList($condition);
        print_r($article_list);
    }
    public function mainOp(){
        $list = array();
        $picturelist = array(
            array(
                'name' => '1',
                'url' => 'http://img02.tooopen.com/images/20150928/tooopen_sy_143912755726.jpg',
            ),
            array(
                'name' => '2',
                'url' => 'http://img06.tooopen.com/images/20160818/tooopen_sy_175866434296.jpg',
            ),
            array(
                'name' => '3',
                'url' => 'http://img06.tooopen.com/images/20160818/tooopen_sy_175833047715.jpg',
            ),
        );

        $modellist = array(
            array(
                'id'=>1,
                'title' => '热门文章',
                'icon'=>"../../images/nav_icon_01.png",
                'url' => 'articlelist',
                'color' => 'red'
            ),
            array(
                'id'=>2,
                'title' => '电脑技巧',
                'icon'=>"../../images/nav_icon_02.png",
                'url' => 'articlelist',
                'color' => 'orange'
            ),
            array(
                'id'=>3,
                'title' => '沟通技巧',
                'icon'=>"../../images/nav_icon_03.png",
                'url' => 'articlelist',
                'color' => 'yellow'
            ),

            array(
                'id'=>4,
                'title' => '心里素质',
                'icon'=>"../../images/nav_icon_04.png",
                'url' => 'articlelist',
                'color' => 'green'
            ),
            array(
                'id'=>5,
                'title' => '形象礼仪',
                'icon'=>"../../images/nav_icon_05.png",
                'url' => 'articlelist',
                'color' => 'purple'
            ),
            array(
                'id'=>6,
                'title' => '团队管理',
                'icon'=>"../../images/nav_icon_01.png",
                'url' => 'articlelist',
                'color' => 'red'
            ),

            array(
                'id'=>7,
                'title' => '口才演讲',
                'icon'=>"../../images/nav_icon_02.png",
                'url' => 'articlelist',
                'color' => 'orange'
            ),
            array(
                'id'=>8,
                'title' => '记忆思维',
                'icon'=>"../../images/nav_icon_03.png",
                'url' => 'articlelist',
                'color' => 'yellow'
            ),
            array(
                'id'=>9,
                'title' => '知己知彼',
                'icon'=>"../../images/nav_icon_04.png",
                'url' => 'test',
                'color' => 'green'
            ),
        );
        $list['picturelist'] = $picturelist;
        $list['modellist'] = $modellist;
        echo json_encode($list);
    }
    public function articleListOp(){
        $list = array();
        $id =  empty($_GET['id'])?0:intval($_GET['id']);
        if ($id == 0) {
            array_push($list, array(
                "id"=>0,
                "class_id"=>$id,
                "subject"=>"默认数据",
                "coverpath"=>"../../images/recommend_img_01.png",
                "star"=>3,
                "mention"=>'5万人在线测试',
                "message"=>'我们追求的是没有最长只有更长！'
            ));
        }else {
            $list =
                array(
                    array(
                        "id"=>1,
                        "class_id"=>$id,
                        "subject"=>"依据颜色提示我内心的真实年龄",
                        "coverpath"=>"../../images/recommend_img_01.png",
                        "star"=>5,
                        "mention"=>'8万人在线测试',
                        "message"=>'根据科学研究，不同年龄会有...'
                    ),
                    array(
                        "id"=>2,
                        "class_id"=>$id,
                        "subject"=>"你的内心有多孤单",
                        "coverpath"=>"../../images/recommend_img_01.png",
                        "star"=>4,
                        "mention"=>'4万人在线测试',
                        "message"=>'你又没有在热闹的长京中突然感到果实...'
                    ),
                );
        }
        echo json_encode($list);
    }
}
