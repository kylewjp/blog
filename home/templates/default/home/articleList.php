<?php
defined('InShopNC') or exit('Access Invalid!');
//print_r($output['articleTitle']);
?>;

<div class="content-wrapper">
    <div class="content-wrapper__inner">
        <article class="post-container post-container--single" itemscope="" itemtype="">
            <header class="post-header">
                <div class="post-meta">
                    <time datetime="" itemprop="datePublished" class="post-meta__date date"></time>
                    <span class="post-meta__tags tags"></span>
                </div>
                <h1 class="post-title">文章</h1>
            </header>
            <section class="post">
                <div class="page card">
                    <?php if(!empty($output['articleTitle'])){ ?>
                        <?php foreach($output['articleTitle'] as $k=>$v) {?>
                            <div class="hat_title">
                                <h3><?php echo $k;?></h3>
                            </div>
                            <?php foreach($v as $key=>$value){?>
                                    <div class="hat_titleul">
                                        <ul>
                                            <li>
                                                  <span><?php echo $value['article_time'];?></span>&nbsp;»&nbsp;
                                                    <a href="<?php echo url('index', 'articleDetail',array('article_id'=>$value['article_id']), false,APP_SITE_URL);?>"><?php echo $value['article_title']; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                            <?php } ?>
                        <?php } ?>
                    <?php }else{ ?>
                        <div class="hat_title">
                            <h3>暂无文章</h3>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </article>

    </div>
</div>