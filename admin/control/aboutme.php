<?php


class aboutmeControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('setting');
    }


    //关于我
    public function aboutMeOp(){

        $aboutme = Model('aboutme');
        $aboutmelist = $aboutme->getListSetting();

        Tpl::output('aboutmelist',$aboutmelist);


        Tpl::showpage('setting.aboutme');
    }


    //修改选项
    public function aboutMeUpdateOp(){

        $aboutme = Model('aboutme');
        $condition = array();

        if(isset($_POST) && !empty($_POST)){
            $condition['aboutme'] = $_POST['aboutme'];
            $condition['wechat'] = $_POST['wechat'];
            $condition['QQ'] = $_POST['QQ'];

            $result = $aboutme ->updateSetting($condition);
            if ($result){
                $url = array(
                    array(
                        'url'=>'index.php?act=aboutme&op=aboutMe',
                        'msg'=>"返回列表",
                    ),
                    array(
                        'url'=>'index.php?act=aboutme&op=aboutMe',
                        'msg'=>"继续修改",
                    ),
                );
                showMessage("添加成功",$url);
            }else {
                showMessage("添加失败");
            }
        }
    }

}