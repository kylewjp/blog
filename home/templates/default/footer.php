<?php
defined('InShopNC') or exit('Access Invalid!');

?>


<div class="content-wrapper">
    <div class="content-wrapper__inner" style="padding-top: 0px">
        <section class="footer">
            <footer>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                    <tr id="bar_head">
                        <th colspan="11">友情链接</th>
                    </tr>
                    </thead>


                    <tbody>

                    <tr align="center" valign="middle">
                        <?php foreach ($output['friendlink'] as $k=>$v){ if($k<=4){ ?>
                        <td><a href="<?php echo $v['friendlink_url'];?>"><?php echo $v['friendlink_title'];?></a></td>
                        <?php }} ?>
                    </tr>
                    <tr align="center" valign="middle">
                        <?php foreach ($output['friendlink'] as $k=>$v){ if(4<$k && $k<=9){ ?>
                            <td><a href="<?php echo $v['friendlink_url'];?>"><?php echo $v['friendlink_title'];?></a></td>
                        <?php }} ?>
                    </tr>
                    </tbody></table>

                <div class="footer_div">
                    <p class="copyright text-muted">
                        Copyright © 2018 LINBE的Blog
                    </p>
                    <div align="right">
                        <link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL?>/index_files/font-awesome_002.css">
                        <!-- 访问统计 -->
                        <span id="busuanzi_container_site_pv" style="display: inline;">
            本站总访问量
            <span>121</span><span id="busuanzi_value_site_pv">70520</span>次
        </span>

                    </div>
                    <div>
                    </div></div></footer>
        </section>


    </div>
</div>