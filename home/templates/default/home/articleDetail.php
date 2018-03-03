<?php

?>


<div class="content-wrapper">
    <div class="content-wrapper__inner">
      <article class="post-container post-container--single" itemscope="" itemtype="http://schema.org/BlogPosting">
  <header class="post-header">
    <h1 class="post-title"><?php echo $output['article_info']['article_title'];?></h1>
    <div class="post-meta">
      <img src="<?php echo SHOP_TEMPLATES_URL?>/imgs/calendar.png" width="20px">
      <time datetime="2017-12-04 00:00:00 +0800" itemprop="datePublished" class="post-meta__date date"><?php echo date('Y-m-d',$output['article_info']['article_time']);?></time>

<!--      <span id="busuanzi_container_page_pv" style="display: inline;"> | 阅读：<span id="busuanzi_value_page_pv">693</span>次</span>-->
    <p></p>
    </div>
  </header>

  <section class="post" deep="3">

    <?php echo $output['article_info']['article_content'];?>

  </section>
  <h2 style="color:red"><strong>版权声明：博客中的文章版权归博主所有，未经授权，禁止转载，转载请注明出处，合作请联系：LINBE</strong></h2>
</article>
    </div>
</div>
