
    <!-- 关于我们 -->
    <div class="intop">
	    <h2>
	        <a href="javascript:history.back();"><span>返回</span></a>
	        <a href="#">关于我们</a>
	    </h2>
	</div>
	<div class="intext">
		<div class="about_div">
		　　
            <?php
            if (!empty($output['article_list']) && !empty($output['article_list'][0]) ) {
                $value = $output['article_list'][0];
                echo $value['article_content'];
            }else{
                echo '未编写，请到后台添加';
            }
            ?>
        </div>
	</div>
	<!-- 页脚 -->