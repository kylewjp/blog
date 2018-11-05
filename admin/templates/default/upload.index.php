<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>文件管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>列表</span></a></li>
          <li><input type="file" multiple="multiple" id="fileupload" name="fileupload" style="width: 70px;"/></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" value="<?php echo $_GET['act'];?>" name="act">
    <input type="hidden" value="<?php echo $_GET['op'];?>" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_file_name">文件名</label></th>
          <td><input type="text" value="<?php echo $_GET['search_file_name'];?>" name="search_file_name" id="search_file_name" class="txt"></td>

          <th><label for="search_upload_type"><?php echo $lang['article_index_class'];?></label></th>
          <td><select name="search_upload_type" id="search_upload_type" class="">
              <option value="">请选择...</option>
              <option <?php if($_GET['search_upload_type'] == '0'){ ?>selected='selected'<?php } ?> value="0">默认图片</option>
              <option <?php if($_GET['search_upload_type'] == '1'){ ?>selected='selected'<?php } ?> value="1">文章图片</option>
              <option <?php if($_GET['search_upload_type'] == '2'){ ?>selected='selected'<?php } ?> value="2">文件管理</option>
              </select></td>

          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
            <?php if($_GET['search_file_name'] != '' or $_GET['search_upload_type'] != ''){?>
            <a href="index.php?act=upload&op=index" class="btns " title="<?php echo $lang['nc_cancel_search'];?>"><span><?php echo $lang['nc_cancel_search'];?></span></a>
            <?php }?></td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>文件列表</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>排序越小越靠前</li>
            <li>文件类别编号，0为无，1为文章图片，2为上传的文件，默认为0</li>
<!--            <li>排序小的前5篇文章将作为推荐文章</li>-->
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_article">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48">编号</th>
          <th>文件名</th>
          <th>大小</th>
          <th>文件类型编号</th>
          <th>上传时间</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['upload_list']) && is_array($output['upload_list'])){ ?>
        <?php foreach($output['upload_list'] as $k => $v){ ?>
        <tr class="hover">
          <td><input type="checkbox" name='del_id[]' value="<?php echo $v['upload_id']; ?>" class="checkitem"></td>
          <td><?php echo $v['upload_id']; ?></td>
          <td><a target="_blank" href="<?php echo UPLOAD_SITE_URL.DS.ATTACH_ARTICLE.DS.$v['file_name'];?>"><?php echo $v['file_name']; ?></a> </td>
          <td><?php echo $v['file_size']; ?></td>
          <td><?php echo $v['upload_type']; ?></td>
          <td><?php echo date('Y-m-d H:i:s',$v['upload_time']); ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['upload_list']) && is_array($output['upload_list'])){ ?>
        <tr class="tfoot">
            <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16">
            <label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            <a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#form_article').submit();}">
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
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script>
<script language="JavaScript">

    $(document).ready(function(){
        // 图片上传
        $('#fileupload').each(function(){
            $(this).fileupload({
                dataType: 'json',
                url: 'index.php?act=upload&op=file_upload&item_id=0',
                done: function (e,data) {
                    data = data.result;
                    if(data['status'] === 1 || data['status'] === '1'){
                        window.location.reload();    //刷新
                        alert(data['msg']);
                    }else{
                        alert(data['msg']);
                    }
                }
            });
        });
    });
</script>
