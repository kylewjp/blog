
<div class="recommend">
    <h3>为您推荐</h3>
    <ul class="list_group">

        <?php if ( !empty($output['recommend']) ){ ?>
            <?php foreach ($output['recommend'] as $artiles_key=>$artiles_value){ ?>
                <li>
                    <a href="<?php echo url('index', 'articleDetail',array('id'=>$artiles_value['article_id']), false,APP_SITE_URL);?>"
                       title="<?php echo $artiles_value['article_title']; ?>" target="_self">
                        <?php echo $artiles_value['article_title']; ?>
                    </a>
                </li>
            <?php }?>
        <?php }else{ ?>
            <li>
                暂无推荐数据
            </li>
        <?php } ?>
    </ul>
</div>