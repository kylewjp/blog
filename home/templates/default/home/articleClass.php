
<?php
defined('InShopNC') or exit('Access Invalid!');
//print_r($output['articleclass']);
//print_r($output['articleList']);
?>;

<div class="content-wrapper">
    <div class="content-wrapper__inner">
        <article class="post-container post-container--single" itemscope="" itemtype="">
            <section class="post">
                <div class="page card">
                    <?php if (!empty($output['articleclass'])) { ?>
                        <?php foreach($output['articleclass'] as $v){ ?>
                        <div class="hat_titleul">
                            <ul>
                                <li>
                                   <a href="#<?php echo $v['ac_name']; ?>"><?php echo $v['ac_name']; ?></a>
                                </li>
                            </ul>
                        </div>
                        <?php }?>
                    <?php }else{ ?>
                        <div class="hat_titleul">
                            <ul>
                                <li>
                                    <a href="#">暂无分类</a>
                                </li>
                            </ul>
                        </div>
                    <?php }?>

                    <?php if (!empty($output['articleclass'])) { ?>
                        <?php foreach($output['articleclass'] as $v){ ?>
                            <div class="hat_title" id="<?php echo $v['ac_name']; ?>">
                                <h3><?php echo $v['ac_name']; ?></h3>
                            </div>

                            <?php if (!empty($output['articleList'])) { ?>
                                <?php foreach($output['articleList'] as $value){ ?>
                                    <?php if($value['ac_id'] == $v['ac_id']){ ?>
                                    <div class="hat_titleul">
                                        <ul>
                                            <li>
                                                <a href="<?php echo url('index', 'articleDetail',array('article_id'=>$value['article_id']), false,APP_SITE_URL);?>"><?php echo $value['article_title']; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                 <?php } ?>
                             <?php } ?>
                        <?php }?>
                    <?php }?>
                </div>
            </section>
        </article>

    </div>
</div>