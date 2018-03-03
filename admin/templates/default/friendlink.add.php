<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>友情链接</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=friendlink&op=friendlink"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="friendlink_form" method="post" name="friendlinkForm">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="friendlink_title" id="friendlink_title" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label for="friendlinkForm">友情链接:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="friendlink_url" id="friendlink_url" class="txt"></td>
          <td class="vatop tips">格式：http://xxxxxx</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>是否显示:</label></td>
        </tr>

        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="friendlink_show1" class="cb-enable selected" ><span><?php echo $lang['nc_yes'];?></span></label>
            <label for="friendlink_show0" class="cb-disable" ><span><?php echo $lang['nc_no'];?></span></label>
            <input id="friendlink_show1" name="friendlink_show" checked="checked" value="1" type="radio">
            <input id="friendlink_show0" name="friendlink_show" value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>

      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#friendlink_form").valid()){
     $("#friendlink_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#friendlink_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            friendlink_title : {
                required   : true
            },
			friendlink_url : {
				url : true
            }
        },
        messages : {
            friendlink_title : {
                required   : '标题必填'
            },
			friendlink_url : {
				url : '连接格式错误'
            }
        }
    });

});
</script>