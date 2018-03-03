<?php defined('InShopNC') or exit('Access Invalid!');

/*$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";
if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
{
    $Loaction = '/wap/';
    if (!empty($Loaction))
    {
       header("Location: $Loaction\n");
        exit;
    }
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL?>/css/base.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL?>/css/swiper.min.css">
    <script src="<?php echo SHOP_TEMPLATES_URL?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo SHOP_TEMPLATES_URL?>/js/swiper.min.js"></script>
    <script src="<?php echo SHOP_TEMPLATES_URL?>/js/main.js"></script>
</head>
<body>
<!-- 头部 -->
<header>
    <a href="<?php echo url('index', 'index',array(), false,APP_SITE_URL);?>" class="logo">
        <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['site_logo']);?>" >
    </a>
</header>


<!-- 导航 -->
<nav class="menu">
    <ul>
        <li><a href="<?php echo url('index', 'index',array(), false,APP_SITE_URL);?>">首页</a></li>
        <li><a href="<?php echo url('index', 'about',array(), false,APP_SITE_URL);?>">关于我们</a></li>
        <li><a href="<?php echo url('index', 'news',array(), false,APP_SITE_URL);?>">新闻中心</a></li>
        <li><a href="<?php echo url('index', 'solve',array(), false,APP_SITE_URL);?>">解决方案</a></li>
        <li><a href="<?php echo url('index', 'case',array(), false,APP_SITE_URL);?>">成功案例</a></li>
        <li><a href="<?php echo url('index', 'media',array(), false,APP_SITE_URL);?>">媒体中心</a></li>
        <li><a href="<?php echo url('index', 'consult',array(), false,APP_SITE_URL);?>">环保咨询</a></li>
        <li><a href="<?php echo url('index', 'contact',array(), false,APP_SITE_URL);?>">联系我们</a></li>

    </ul>
    <div class="clear"></div>
</nav>

<!-- PublicNavLayout End-->
<?php require_once($tpl_file);?>
<?php require_once template('footer');?>

</body>
</html>
