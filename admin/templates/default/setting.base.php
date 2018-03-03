<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['web_set'];?></h3>
      <?php echo $output['top_link'];?>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_name">博客名称</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_name" name="site_name" value="<?php echo $output['list_setting']['site_name'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['web_name_notice'];?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo $lang['site_logo'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<span class="type-file-box">
				<input type='text' name='textfield' id='textfield1' class='type-file-text' />
				<input name="site_logo" type="file" class="type-file-file" id="site_logo" size="30" hidefocus="true" nc_type="change_site_logo">
				<input type='button' name='button' id='button1' value='' class='type-file-button' />
			</span>
			<span class="type-file-show">
<!--				<img class="show_image" src="--><?php //echo ADMIN_TEMPLATES_URL;?><!--/images/preview.png">-->
				 <img class="show_image" width="25px" height="25px" src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['site_logo']);?>">
                <div class="type-file-preview">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['site_logo']);?>">
				</div>
			</span>
		  </td>
          <td class="vatop tips"><span class="vatop rowform">180px * 50px</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo $lang['member_logo'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
              <span class="type-file-show">
<!--                  <img class="show_image" src="--><?php //echo ADMIN_TEMPLATES_URL;?><!--/images/preview.png">-->
                <img class="show_image" width="25px"  height="25px" src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['member_logo']);?>">
            <div class="type-file-preview"><img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['member_logo']);?>"></div>
            </span><span class="type-file-box"><input type='text' name='textfield2' id='textfield2' class='type-file-text' /><input type='button' name='button2' id='button2' value='' class='type-file-button' />
            <input name="member_logo" type="file" class="type-file-file" id="member_logo" size="30" hidefocus="true" nc_type="change_member_logo">
            </span></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['member_logo_notice'];?></span></td>
        </tr>
        <!-- 商家中心logo -->
        <tr>
            <td colspan="2" class="required"><label for="seller_center_logo">小程序二维码:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
            <span class="type-file-show">
<!--                <img class="show_image" src="--><?php //echo ADMIN_TEMPLATES_URL;?><!--/images/preview.png">-->
                <img class="show_image" width="25px" height="25px" src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['seller_center_logo']);?>">
                <div class="type-file-preview">
                    <img src="<?php echo UPLOAD_SITE_URL.'/'.(ATTACH_COMMON.DS.$output['list_setting']['seller_center_logo']);?>">
                </div>
            </span>
                <span class="type-file-box">
                  <input type='text' name='textfield' id='textfield3' class='type-file-text' />
                  <input type='button' name='button' id='button1' value='' class='type-file-button' />
            <input name="seller_center_logo" type="file" class="type-file-file" id="seller_center_logo" size="30" hidefocus="true" nc_type="change_seller_center_logo">
            </span>
            </td>
            <td class="vatop tips"><span class="vatop rowform">100px * 100px</span></td>
        </tr>
        <!-- 商家中心logo -->


         <tr>
          <td colspan="2" class="required"><label for="statistics_code"><?php echo $lang['flow_static_code'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="site_intro" rows="6" class="tarea" id="statistics_code"><?php echo $output['list_setting']['site_intro'];?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['flow_static_code_notice'];?></span></td>
        </tr>


      </tbody>
      <tfoot id="submit-holder">
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
// 模拟网站LOGO上传input type='file'样式
$(function(){
	$("#site_logo").change(function(){
		$("#textfield1").val($(this).val());
	});
	$("#member_logo").change(function(){
		$("#textfield2").val($(this).val());
	});
	$("#seller_center_logo").change(function(){
		$("#textfield3").val($(this).val());
	});
// 上传图片类型
$('input[class="type-file-file"]').change(function(){
	var filepatd=$(this).val();
	var extStart=filepatd.lastIndexOf(".");
	var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();		
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("<?php echo $lang['default_img_wrong'];?>");
				$(this).attr('value','');
			return false;
		}
	});
$('#time_zone').attr('value','<?php echo $output['list_setting']['time_zone'];?>');	
});
</script>
