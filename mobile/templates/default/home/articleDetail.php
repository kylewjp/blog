
    <!-- 关于我们 -->
    <div class="intop">
	    <h2>
	        <a href="javascript:history.back();"><span>返回</span></a>
            <?php echo $output['article_info']['article_title'];?>
	    </h2>
	</div>
	<div class="intext">
		<div class="about_div">
		　　
            <?php
            if (!empty($output['article_info']) ) {
                $value = $output['article_info'];
                echo $value['article_content'];
            }
            ?>
        </div>
	</div>
	<!-- 页脚 -->