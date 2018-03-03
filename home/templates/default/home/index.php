<?php
defined('InShopNC') or exit('Access Invalid!');
//print_r($output['pagelist']);
//exit;
?>
<div class="content-wrapper">
    <div class="content-wrapper__inner">
        <!--<div class="main-post-list hidden">-->
        <div class="main-post-list">
            <ol class="post-list">
                <?php if(!empty($output['article_list'])) {?>
                    <?php foreach($output['article_list'] as $k=>$v) { ?>
                        <?php  if($v['article_show'] == 1){ ?>
                            <li>
                                <h2 class="post-list__post-title post-title">
                                    <a href="<?php echo url('index', 'articleDetail',array('article_id'=>$v['article_id']), false,APP_SITE_URL);?>"
                                       title="<?php echo $v['article_title'];?>">
                                        <?php echo $v['article_title'];?>
                                    </a>
                                </h2>
                                <p class="excerpt">
                                    <?php echo mb_substr(str_replace(' ','',strip_tags($v['article_content'])),0,300,'utf-8');?>
                                    ，…</p>
                                <div class="post-list__meta">
                                    <time datetime="2018-01-05 00:00:00 +0800" class="post-list__meta--date date">
                                        <img src="<?php echo SHOP_TEMPLATES_URL?>/index_files/calendar.png" width="20px"><?php echo date("Y-m-d",$v['article_time']);?></time>
                                    <div class="tag-img-icon">
                                        <img src="<?php echo SHOP_TEMPLATES_URL?>/index_files/tag-icon.svg" width="20px">
                                    </div>
                                    <a href="<?php echo url('index', 'articleClass',array(), false,APP_SITE_URL);?>">
                                        <div class="post-list-icon-mate">
                                            <span class="post-list__meta--tags-right"><?php echo $v['ac_name'];?></span>
                                        </div>
                                    </a><div class="post-list-small-mate"><a href="#">
                                        </a><a class="btn-border-small" href="<?php echo url('index', 'articleDetail',array('article_id'=>$v['article_id']), false,APP_SITE_URL);?>" title="<?php echo $v['article_title'];?>">阅读全文 » </a>
                                    </div>
                                </div>
                                <hr class="post-list__divider">
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php }else{ ?>
                    <li>暂无文章数据</li>
                <?php } ?>
            </ol>
            <!-- <hr class="post-list__divider ">-->
            <div class="pagination"><p><?php echo $output['pagelist'];?></p></div>
        </div>
    </div>
</div>

<?php $output['pagelist'];?>

