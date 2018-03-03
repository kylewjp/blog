    <!-- 联系我们 -->
    <div class="intop">
	    <h2>
	        <a href="javascript:history.back();"><span>返回</span></a>
	        <a href="#">联系我们</a>
	    </h2>
	</div>
	<div class="intext contact_info">
		<ul>
            <li class="string_info">
                <strong>
                    <?php
                    if (!empty($output['article_list']) && !empty($output['article_list'][0]) ) {
                        $value = $output['article_list'][0];
                        echo $value['article_content'];
                    }else{
                        echo '未编写，请到后台添加';
                    }
                    ?>
                </strong>
            </li>
            <li class="string_tel">公司电话：<?php echo $output['list_setting']['site_phone'];?></li>
            <li class="string_phone">联系人手机：<?php echo $output['list_setting']['site_admin_phone'];?></li>
            <li class="string_contact">联系人：<?php echo $output['list_setting']['site_admin_name'];?></li>
            <li class="string_send">传　真：<?php echo $output['list_setting']['site_fax'];?></li>
            <li class="string_qq">客服QQ：<?php echo $output['list_setting']['site_qq'];?></li>
            <li class="string_email">邮　箱：<?php echo $output['list_setting']['site_email'];?></li>
            <li class="string_address">地　址：<?php echo $output['list_setting']['site_address'];?></li>

		</ul>
		<div class="clear"></div>
	</div>
