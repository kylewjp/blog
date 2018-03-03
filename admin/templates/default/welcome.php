<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['dashboard_wel_system_info'];?>【<?php echo $lang['dashboard_wel_lase_login'].$lang['nc_colon'];?><?php echo $output['admin_info']['admin_login_time'];?>】</h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <div class="info-panel">

	<?php foreach($output['showlist'] as $k => $v){ ?>
    <dl class="<?php echo $v['param_picture_name']; ?>">
      <dt>
        <div class="ico">
        <i></i><sub title="<?php echo $v['text_title_name_title']; ?>">
        <span><em id="statistics_<?php echo $v['param_title_name']; ?>">0</em></span></sub>
        </div>
        <h3><?php echo $v['text_title_name']; ?></h3>
        <h5><?php echo $v['text_title_name_subhead']; ?></h5>
      </dt>
      <dd>
        <ul>
            <?php foreach($v['array'] as $array_k => $array_v){ ?>
              <li class="w50pre <?php echo $array_v['param_show_type']; ?>">
                  <a href="<?php echo $array_v['param_url']; ?>">
                      <?php echo $array_v['text_title_name']; ?>
                      <sub><em id="statistics_<?php echo $array_v['param_title_name']; ?>">0</em></sub>
                  </a>
              </li>
            <?php } ?>
        </ul>
      </dd>
    </dl>
    <?php } ?>
    
    
    <dl class="pic8">
      <dt>
        <div class="ico"><i></i><a id="UPDATE" style="visibility:hidden;" title="" target="_blank" href="javascript:void(0);"><sub><span>new</em></span></sub></a></div>
        <h3><?php echo $lang['dashboard_welcome_sys_info'];?></h3>
        <div id="system-info">
          <ul>
            <li>Vshop <?php echo $lang['dashboard_welcome_version'];?><span><?php echo $output['statistics']['shop_version'];?></span></li>
            <li><?php echo $lang['dashboard_welcome_install_date'];?><span><?php echo $output['statistics']['setup_date'];?></span></li>
            <li><?php echo $lang['dashboard_welcome_server_os'];?><span><?php echo $output['statistics']['os'];?></span></li>
            <li>WEB <?php echo $lang['dashboard_welcome_server'];?><span><?php echo $output['statistics']['web_server'];?></span></li>
            <li>PHP <?php echo $lang['dashboard_welcome_version'];?><span><?php echo $output['statistics']['php_version'];?></span></li>
            <li>MYSQL <?php echo $lang['dashboard_welcome_version'];?><span><?php echo $output['statistics']['sql_version'];?></span></li>
          </ul>
        </div>
      </dt>
      <dd>
        <ul>
          <li class="w50pre none"><a href="<?php echo APP_SITE_URL; ?>" target="_blank">博客首页<sub></sub></a></li>
          <li class="w50pre none"><a href="<?php echo APP_SITE_URL; ?>" target="_blank">博客首页<sub></sub></a></li>
        </ul>
      </dd>
    </dl>
    <div class=" clear"></div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$.getJSON("index.php?act=dashboard&op=statistics", function(data){
	  $.each(data, function(k,v){
		  $("#statistics_"+k).html(v);
		  if (v == 0){
			$("#statistics_"+k).parent().parent().parent().removeClass('high').removeClass('normal').addClass('none');
		  }
	  });
	});
	//自定义滚定条
	$('#system-info').perfectScrollbar();
});
</script>
