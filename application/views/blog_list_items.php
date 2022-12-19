    <div class="row">
        <?php foreach ($blog_list_items as $blog_list_item) : ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                <div class="ps-post">
                    <div class="ps-post__thumbnail">
                        <a class="ps-post__overlay" href="<?= $base_url ?>index.php/main/blog/<?= $blog_list_item['id'] ?>"></a>
                        <?php if ($blog_list_item['blog_pic'] != '') : ?>
                            <img src="<?= $blog_list_item['base_url'] ?>upload_blog/<?= $blog_list_item['blog_pic'] ?>" alt="">
                        <?php else : ?>
                            <img src="<?= $blog_list_item['base_url'] ?>img/default_prod_pic.png" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="ps-post__content">
                        <div class="ps-post__meta">
                            <?php foreach ($blog_list_item['blog_tags'] as $blog_tag) : ?>
                                <a href="#">#<?= $blog_tag['tag_name'] ?></a>
                            <?php endforeach; ?>
                        </div>
                        <a class="ps-post__title" href="<?= $base_url ?>index.php/main/blog/<?= $blog_list_item['id'] ?>">
                            <?= $blog_list_item['blog_title'] ?>
                        </a>
                        <p><?= $blog_list_item['blog_date'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="ps-pagination">
        <ul class="pagination">
            <?php if (isset($pages['prev_page'])) : ?>
                <li><a href="javascript:blogtopage(<?= $pages['prev_page'] ?>)">
                        <i class="icon-chevron-left" style="margin-right:4px;margin-left:0;"></i><span class="dnone-text_btn">Пред. стр.</span></a></li>
            <?php endif; ?>
            <?php foreach ($pages['pages'] as $page) : ?>
                <li class="<?= $page['current'] ?>"><a href="javascript:blogtopage(<?= $page['page'] ?>)"><?= $page['page'] ?></a></li>
            <?php endforeach; ?>
            <?php if (isset($pages['next_page'])) : ?>
                <li><a href="javascript:blogtopage(<?= $pages['next_page'] ?>)"><span class="dnone-text_btn">След. стр.</span><i class="icon-chevron-right"></i></a></li>
            <?php endif; ?>
        </ul>
    </div>