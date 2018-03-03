<?php


?>


<div class="content-wrapper">
    <div class="content-wrapper__inner">
        <article class="post-container post-container--single" itemscope="" itemtype="http://schema.org/BlogPosting">
            <header class="post-header">
                <div class="post-meta">
                    <time datetime="" itemprop="datePublished" class="post-meta__date date"></time>
                    <span class="post-meta__tags tags"></span>
                </div>
                <h1 class="post-title">关于我</h1>
            </header>

            <section class="post">
                <p><?php echo $output['aboutmelist']['aboutme'];?></p>

                <h2 id="联系我">联系我</h2>

                <ul>
                    <li>微信：<?php echo $output['aboutmelist']['wechat'];?></li>
                    <li>QQ：<?php echo $output['aboutmelist']['QQ'];?></li>
                </ul>

            </section>
        </article>
    </div>
</div>

