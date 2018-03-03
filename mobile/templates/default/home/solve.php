    <!-- 解决方案 -->
    <div class="intop">
	    <h2>
	        <a href="javascript:history.back();"><span>返回</span></a>
	        <a href="#">解决方案</a>
	    </h2>
	</div>
	<div class="mnews">
		<ul>
            <?php if ( !empty($output['article_list'] )){ ?>
                <?php foreach ($output['article_list'] as $key=>$value){?>
                    <li>
                        <span></span>
                        <a href="<?php echo url('index', 'articleDetail',array('id'=>$value['article_id']), false,APP_SITE_URL);?>">
                            <?php echo $value['article_title'] ?>
                        </a>
                    </li>
                <?php }?>
            <?php }else{ ?>
                <li><span></span>暂无数据</li>
            <?php } ?>
		</ul>
        <div class="clear"></div>
    </div>

    <style>
        .page ul{overflow:hidden;width:100%;}
        .page ul li{display:inline;padding: 5px;}
        .page ul li .currentpage{background-color: #7dbf72; padding: 5px;}
    </style>
    <div class="page">
        <?php print_r($output['page']); ?>
    </div>
