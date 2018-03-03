<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>友情链接</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
          <li><a href="index.php?act=friendlink&op=friendlink_add" ><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" value="friendlink" name="act">
    <input type="hidden" value="friendlink" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_title">标题</label></th>
          <td><input type="text" value="<?php echo $_GET['search_title'];?>" name="search_title" id="search_title" class="txt" ></td>

          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
            <?php if($_GET['search_title'] != '' ){?>
            <a href="index.php?act=friendlink&op=friendlink" class="btns " title="<?php echo $lang['nc_cancel_search'];?>"><span><?php echo $lang['nc_cancel_search'];?></span></a>
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
            <li>友情连接（最好设置显示10个）</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_friendlink">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th>标题</th>
          <th>连接</th>
          <th class="align-center">显示</th>
          <th class="align-center">添加时间</th>
          <th class="w60 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['friendlink_list']) && is_array($output['friendlink_list'])){ ?>
        <?php foreach($output['friendlink_list'] as $k => $v){ ?>
        <tr class="hover">
          <td><input type="checkbox" name='del_id[]' value="<?php echo $v['friendlink_id']; ?>" class="checkitem"></td>
          <td><?php echo $v['friendlink_title']; ?></td>
          <td><?php echo $v['friendlink_url']; ?></td>
          <td class="align-center"><?php if($v['friendlink_show'] == '0'){echo $lang['nc_no'];}else{echo $lang['nc_yes'];} ?></td>
          <td class="nowrap align-center"><?php echo date('Y-m-d H:i:s',$v['friendlink_time']); ?></td>
          <td class="align-center"><a href="index.php?act=friendlink&op=friendlink_edit&friendlink_id=<?php echo $v['friendlink_id']; ?>"><?php echo $lang['nc_edit'];?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['friendlink_list']) && is_array($output['friendlink_list'])){ ?>
        <tr class="tfoot">
            <?php if(empty($output['friendlink_type'])){ ?>
                <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
            <?php } ?>
          <td colspan="16">
            <label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            <a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#form_friendlink').submit();}">
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
