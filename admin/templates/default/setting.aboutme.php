<?php defined('InShopNC') or exit('Access Invalid!');

//print_r($output['aboutmelist']);
//exit;


?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>About Me 设置</h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" id="aboutme_form" action="index.php?act=aboutme&op=aboutMeUpdate">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>

      <tr>
          <td colspan="2" class="required"><label for="aboutme">关于我:</label></td>
      </tr>
      <tr class="noborder">
          <td class="vatop rowform"><textarea name="aboutme" rows="6" class="tarea" id="aboutme"><?php echo $output['aboutmelist']['aboutme'];?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['flow_static_code_notice'];?></span></td>
      </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label for="wechat">微信:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="wechat" name="wechat" value="<?php echo $output['aboutmelist']['wechat'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['web_name_notice'];?></span></td>
        </tr>

        <tr class="noborder">
            <td colspan="2" class="required"><label for="QQ">QQ:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><input id="QQ" name="QQ" value="<?php echo $output['aboutmelist']['QQ'];?>" class="txt" type="text" /></td>
            <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['web_name_notice'];?></span></td>
        </tr>
      </tbody>
      <tfoot id="submit-holder">
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" id="submitBtn" class="btn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script>
    //按钮先执行验证再提交表单
    $(function(){$("#submitBtn").click(function(){
        if($("#aboutme_form").valid()){
            $("#aboutme_form").submit();
        }
    });
    });
    //
    $(document).ready(function(){
        $('#aboutme_form').validate({
            errorPlacement: function(error, element){
                error.appendTo(element.parent().parent().prev().find('td:first'));
            },
            rules : {
                aboutme:{
                    required:true
                },
                wechat : {
                    required   : true
                },
                QQ : {
                    required : true
                }
            },
            messages : {
                aboutme:{
                    required:'不能为空'
                },
                wechat : {
                    required   : '微信不能为空'
                },
                QQ : {
                    required : 'QQ不能为空'
                }
            }
        });
    });

</script>


