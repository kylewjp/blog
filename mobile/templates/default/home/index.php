
    <!-- 轮播图 -->
    <div class="swiper-container carousel">
        <div class="swiper-wrapper">

            <?php if ( !empty($output['ad_pictures'] )){ ?>
                <?php foreach ($output['ad_pictures'] as $key=>$value){?>
                        <?php if (!empty($value['h_img'])){?>
                        <div class="swiper-slide">
                            <a href="<?php echo $value['article_url']?>">
                                <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_MOBILE.DS.'home'.DS.$value['h_img']);?>">
                            </a>
                        </div>
                        <?php }else{ ?>
                            <div class="swiper-slide"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL?>/images/20170422101954_545489268.jpg"></a></div>
                        <?php } ?>

                <?php }?>
            <?php }else{ ?>
                <div class="swiper-slide"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL?>/images/20170414095316_1205941824.jpg"></a></div>
            <?php } ?>

        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- 关于我们 -->
    <div class="intop">
	    <h2>
	        <a href="#"><span>更多</span></a>
	        <a href="#">关于我们</a>
	    </h2>
	</div>
	<div class="intext">
		<p>
        <?php if (!empty($output['article_list'])){ ?>
            <?php foreach ($output['article_list'] as $key => $value){ ?>
                <?php if ($value['article_title'] == '关于我们'){ ?>
                    <?php if (!empty($value['images']) && !empty($value['images'][0]) && !empty($value['images'][0]['file_name'])) { ?>
                        <img src="<?php echo UPLOAD_SITE_URL . '/' . (ATTACH_ARTICLE . DS . $value['images'][0]['file_name']); ?>"
                             border="0">
                    <?php } else { ?>
                        <img title="关于我们" alt="关于我们" src="<?php echo SHOP_TEMPLATES_URL?>/images/20170616114649_89087.jpg" width="75">
                    <?php } ?>
                    <a href="<?php echo url('index', 'articleDetail', array('id' => $value['article_id']), false, APP_SITE_URL); ?>" class="whitex">
                        <?php echo mb_substr( $value['article_content'] , 0, 30, 'utf8' ); ?>...更多&gt;&gt;
                    </a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
		</p>
		<div class="clear"></div>
	</div>
    <!-- 产品中心 -->
	<div class="intop">
	    <h2>
	    	<a href="#"><span>更多</span></a>
	    	<a href="#">产品中心</a>
	    </h2>
	</div>
	<div class="mpimg">
    	<ul>

            <li>
                <a href="#">
                    <img src="<?php echo SHOP_TEMPLATES_URL?>/images/20170413200845_415287857.jpg" border="0">
                    <p>废水处理设备</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="<?php echo SHOP_TEMPLATES_URL?>/images/20170413200845_415287857.jpg" border="0">
                    <p>废水处理设备</p>
                </a>
            </li>

		</ul>
		<div class="clear"></div>
	</div>

    <!-- 成功案例 -->
	<div class="intop">
	    <h2>
	    	<a href="<?php echo url('index', 'solve',array(), false,APP_SITE_URL);?>"><span>更多</span></a>
	    	<a href="<?php echo url('index', 'solve',array(), false,APP_SITE_URL);?>">成功案例</a>
	    </h2>
	</div>
	<div class="mpimg h87">
    	<ul>

            <?php if ( !empty($output['article_list'] )){ ?>
                <?php foreach ($output['article_list'] as $key=>$value){?>
                    <?php if ( $value['ac_id'] ==4){ ?>
                        <li>
                            <a href="<?php echo url('index', 'articleDetail',array('id'=>$value['article_id']), false,APP_SITE_URL);?>">
                                <?php if (!empty($value['images']) && !empty($value['images'][0]) && !empty($value['images'][0]['file_name'])){?>
                                    <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_ARTICLE.DS.$value['images'][0]['file_name']);?>" border="0">
                                <?php }else{ ?>
                                    <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_ARTICLE.DS); ?>default_pic1.gif" border="0">
                                <?php } ?>
                                <p><?php echo $value['article_title'] ?></p>
                            </a>
                        </li>
                    <?php }?>
                <?php }?>
            <?php }else{ ?>
                <li><span></span>暂无数据</li>
            <?php } ?>

		</ul>
		<div class="clear"></div>
	</div>
	<!-- 解决方案 && 新闻中心 -->
	<div class="intop">
		<ul>
			<li class="active">解决方案</li>
			<li>新闻中心</li>
		</ul>
	</div>
	<div class="intext tab" style="display: block;">
		<ul>
            <?php if ( !empty($output['article_list'] )){ ?>
                <?php foreach ($output['article_list'] as $key=>$value){?>
                    <?php if ( $value['ac_id'] ==3){ ?>
                    <li>
                        <a href="<?php echo url('index', 'articleDetail',array('id'=>$value['article_id']), false,APP_SITE_URL);?>">
                            <?php echo $value['article_title'] ?>
                        </a>
                    </li>
                    <?php }?>
                <?php }?>
                <li><a href="<?php echo url('index', 'solve',array(), false,APP_SITE_URL);?>">更多&gt;&gt;</a></li>
            <?php }else{ ?>
                <li><span></span>暂无数据</li>
            <?php } ?>
		</ul>
	</div>
	<div class="intext tab" style="display: none;">
		<ul>
            <?php if ( !empty($output['article_list'] )){ ?>
                <?php foreach ($output['article_list'] as $key=>$value){?>
                    <?php if ( $value['ac_id'] ==2){ ?>
                    <li>
                        <a href="<?php echo url('index', 'articleDetail',array('id'=>$value['article_id']), false,APP_SITE_URL);?>">
                            <?php echo $value['article_title'] ?>
                        </a>
                    </li>
                    <?php }?>
                <?php }?>
                <li><a href="<?php echo url('index', 'news',array(), false,APP_SITE_URL);?>">更多&gt;&gt;</a></li>
            <?php }else{ ?>
                <li><span></span>暂无数据</li>
            <?php } ?>
		</ul>
	</div>