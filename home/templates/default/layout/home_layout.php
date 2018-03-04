<?php
defined('InShopNC') or exit('Access Invalid!');
//print_r($output['friendlink']);
//print_r($output['settinglist']);
//exit;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $output['sit_name']; ?></title>
    <link rel="icon" type="image/png" href="<?php echo ROOT_SITE_URL; ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/index_files/main.css">

</head>
<body>
  <span class="mobile btn-mobile-menu">
      <div class="nav_container">
         <nav class="nav-menu-item" style="float:right">
            <i class="nav-menu-item">
              <a href="<?php echo url('index', 'index', array(), false, APP_SITE_URL); ?>" title="" class="blog-button">  博客主页
              </a>
            </i>
                <i class="nav-menu-item">
                  <a href="<?php echo url('index', 'articleList', array(), false, APP_SITE_URL); ?>" title="archive"
                     class="btn-mobile-menu__icon">
所有文章
                  </a>
                </i>
                <i class="nav-menu-item">
                  <a href="<?php echo url('index', 'articleClass', array(), false, APP_SITE_URL); ?>" title="tags"
                     class="btn-mobile-menu__icon">
分类
                  </a>
                </i>
                <i class="nav-menu-item">
                  <a href="<?php echo url('index', 'aboutMe', array(), false, APP_SITE_URL); ?>" title="about"
                     class="btn-mobile-menu__icon">
关于我
                  </a>
                </i>
          </nav>
      </div>
    </span>
  <!--  <header class="panel-cover " style="background-image: url('/images/background-cover.jpg')">-->
  <div class="panel-cover panel-cover--collapsed"
          style="background-image: url('<?php echo SHOP_TEMPLATES_URL; ?>/imgs/background-cover.jpg')">
      <div class="panel-main">
          <div class="panel-main__inner panel-inverted">
              <div class="panel-main__content">
                  <!-- 头像效果-start -->
                  <div class="ih-item circle effect right_to_left">
                      <a href="<?php echo url('index', 'index', array(), false, APP_SITE_URL); ?>"
                         title="前往 <?php echo $output['settinglist']['site_name']; ?>的主页" class="blog-button">
                          <div class="img"><img
                                      src="<?php echo UPLOAD_SITE_URL . '/' . (ATTACH_COMMON . DS . $output['settinglist']['site_logo']); ?>"
                                      alt="img"></div>
                          <div class="info">
                              <div class="info-back">
                                  <h2 style="font-size: 14px">LOGO
                                      <!--    PHP-->
                                  </h2>
                                  <p style="font-size: 6px">
                                      <!--    技术Blog-->
                                  </p>
                              </div>
                          </div>
                      </a>
                  </div>
                  <!-- 头像效果-end -->
                  <h1 class="panel-cover__title panel-title"><a
                              href="<?php echo url('index', 'index', array(), false, APP_SITE_URL); ?>"
                              title="link to homepage for <?php echo $output['settinglist']['site_name']; ?>"
                              class="blog-button"><?php echo $output['settinglist']['site_name']; ?></a></h1>
                  <hr class="panel-cover__divider">

                  <p class="panel-cover__description"><?php echo $output['settinglist']['site_intro'] ?></p>

                  <hr class="panel-cover__divider panel-cover__divider--secondary">


                  <div class="navigation-wrapper">
                      <div>
                          <nav class="cover-navigation cover-navigation--primary">
                              <ul class="navigation">
                                  <li class="navigation__item">
                                      <a href="<?php echo APP_SITE_URL; ?>"
                                         title="" class="blog-button">博客主页</a>
                                  </li>

                                  <li class="navigation__item"><a
                                              href="<?php echo url('index', 'articleList', array(), false, APP_SITE_URL); ?>"
                                              title="">所有文章</a></li>

                                  <li class="navigation__item"><a
                                              href="<?php echo url('index', 'articleClass', array(), false, APP_SITE_URL); ?>"
                                              title="tags">分类</a></li>

                                  <li class="navigation__item"><a
                                              href="<?php echo url('index', 'aboutMe', array(), false, APP_SITE_URL); ?>"
                                              title="about">关于我</a></li>

                              </ul>
                          </nav>
                      </div>
                  </div>

                  <div style="display:flex;justify-content:center;-webkit-justify-content:center">
                      <div style="display:flex;flex-direction:column;align-items:center;-webkit-flex-direction:column;-webkit-align-items:center;margin-right:10px">
                          <img src="<?php echo UPLOAD_SITE_URL . '/' . (ATTACH_COMMON . DS . $output['settinglist']['member_logo']); ?>"
                               style="width:100px;height:100px;margin-top:30px;margin-bottom:10px">
                          <span class="panel-cover__subtitle panel-subtitle" style="font-size: 12px">微信公众号</span>
                      </div>
                      <div style="display:flex;flex-direction:column;align-items:center;-webkit-flex-direction:column;-webkit-align-items:center;margin-left:10px">
                          <img src="<?php echo UPLOAD_SITE_URL . '/' . (ATTACH_COMMON . DS . $output['settinglist']['seller_center_logo']); ?>"
                               style="width:100px;height:100px;margin-top:30px;margin-bottom:10px">
                          <span class="panel-cover__subtitle panel-subtitle" style="font-size: 12px">微信小程序</span>
                      </div>
                  </div>

              </div>
          </div>
      </div>
      <div class="panel-cover--overlay cover-clear"></div>
  </div>
  <?php require_once($tpl_file); ?>s

  <?php require_once template('footer'); ?>

  <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL ?>/index_files/jquery-1.js"></script>
  <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL ?>/index_files/main.js"></script>

  <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL ?>/index_files/highlight.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>


</body>
</html>

