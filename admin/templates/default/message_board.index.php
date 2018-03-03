<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>留言列表</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" value="message_board" name="act">
    <input type="hidden" value="list" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_title">内容</label></th>
          <td><input type="text" value="<?php echo $_GET['message_board_content'];?>" name="message_board_content" id="message_board_content" class="txt"></td>

          <th><label for="message_board_show">是否显示</label></th>
          <td>
              <select name="message_board_show" id="message_board_show" class="">
              <option value=""><?php echo $lang['nc_please_choose'];?>...</option>
              <option <?php if($_GET['search_ac_id'] == 0){ ?>selected='selected'<?php } ?> value="0">否</option>
              <option <?php if($_GET['search_ac_id'] == 1){ ?>selected='selected'<?php } ?> value="1">是</option>

            </select></td>

          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
            <?php if($output['search_title'] != '' or $output['search_ac_id'] != ''){?>
            <a href="index.php?act=article&op=article" class="btns " title="<?php echo $lang['nc_cancel_search'];?>"><span><?php echo $lang['nc_cancel_search'];?></span></a>
            <?php }?></td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>留言列表</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_message_board">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48"><?php echo $lang['nc_sort'];?></th>
          <th>留言者</th>
            <th>留言手机</th>
            <th>留言邮箱</th>
          <th>留言内容</th>
            <th  class="w48">显示</th>
          <th class="align-center"><?php echo $lang['article_index_addtime'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['message_board_list']) && is_array($output['message_board_list'])){ ?>
        <?php foreach($output['message_board_list'] as $k => $v){ ?>
        <tr class="hover">
          <td><input type="checkbox" name='del_id[]' value="<?php echo $v['message_board_id']; ?>" class="checkitem"></td>
          <td><?php echo $v['message_board_sort']; ?></td>
            <td><?php echo $v['message_board_name']; ?></td>
            <td><?php echo $v['message_board_phone']; ?></td>
            <td><?php echo $v['message_board_email']; ?></td>
            <td><?php echo $v['message_board_content']; ?></td>
          <td onclick="change_type('<?php echo $v['message_board_id']; ?>','<?php echo $v['message_board_show']; ?>')"><?php if($v['message_board_show'] == '0'){echo $lang['nc_no'];}else{echo $lang['nc_yes'];} ?></td>
          <td class="nowrap align-center"><?php echo date('Y-m-d',$v['message_board_time']); ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['message_board_list']) && is_array($output['message_board_list'])){ ?>
        <tr class="tfoot">
                <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16">
                <label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
                <a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#form_message_board').submit();}">
                    <span><?php echo $lang['nc_del'];?></span>
                </a>
            <div class="pagination"> <?php echo $output['page'];?> </div>
          </td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>

<script type="text/javascript">
    function change_type(message_board_id,type){
        var status= type;
        if (type == 0){
            type =1;
        }else if (type == 1){
            type =0;
        }
        if (confirm('是否确定修改编号为'+message_board_id+'的留言显示状态')){
            myurl = "index.php?act=message_board&op=ajax&type=change";
            myurl +=  '&message_board_id='+message_board_id ;
            myurl +=  '&status='+type ;
            $.ajax({
                type: "get",
                url: myurl,
                dataType: 'json',
                success: function (data) {
                    if ( data ){
                        alert('修改成功');
                        window.location.href = "index.php?act=message_board&op=list&order_status="+status;
                    }else{
                        alert('修改失败');
                    }
                }
            });

        }
    }
</script>