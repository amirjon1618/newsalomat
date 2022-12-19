<div class="ps-page--blog">
    <div class="ps-post--detail">
        <div class="ps-post__header">
            <div class="container">
                <h1><?= $blog['blog_title'] ?></h1>
                <p><?= $blog['blog_date'] ?></p>
            </div>
        </div>
        <div class="container">
            <div class="ps-post__carousel">
                <div class="ps-carousel--nav-inside second owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($blog['blog_pics'] as $blog_pic) : ?>
                        <img style="width: inherit;" src="<?= $blog_pic['base_url'] ?>upload_blog/<?= $blog_pic['blog_pic'] ?>" alt="">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="ps-post__content">
                <?= $blog['blog_about'] ?>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><img class="mb-30" src="img/blog/detail/2.jpg" alt="">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 "><img class="mb-30" src="img/blog/detail/3.jpg" alt="">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 "><img class="mb-30" src="img/blog/detail/4.jpg" alt="">
                    </div>
                </div>
                <?php if (sizeof($prods_of_the_day) != 0) : ?>
                    <h4>Рекомендованные товары</h4>
                <?php endif; ?>
            </div>

            <?php if (sizeof($prods_of_the_day) != 0) : ?>
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($prods_of_the_day as $prod_of_the_day) : ?>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail">
                                <a href="<?= $prod_of_the_day['base_url'] ?>index.php/main/product/<?= $prod_of_the_day['id'] ?>">
                                    <img class="prods_sugg_imgs" src="<?= $prod_of_the_day['base_url'] ?>upload_product/<?= $prod_of_the_day['product_pic'] ?>" alt="">
                                </a>
                                <!-- <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                </ul> -->
                            </div>
                            <div class="ps-product__container">
                                <a class="ps-product__vendor" href="#"><?= $prod_of_the_day['product_brand']['brand_name'] ?></a>
                                <div class="ps-product__content">
                                    <a class="ps-product__title product_title_new" href="<?= $prod_of_the_day['base_url'] ?>index.php/main/product/<?= $prod_of_the_day['id'] ?>">
                                        <?= $prod_of_the_day['product_name'] ?>
                                    </a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <?php if ($prod_of_the_day['review_count'] != 0) : ?>
                                                <?php for ($i = 1; $i <= $prod_of_the_day['prod_rating_average']; $i++) : ?>
                                                    <option value="1"></option>
                                                <?php endfor; ?>
                                                <?php for ($i = ($prod_of_the_day['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            <?php else : ?>
                                                <!-- <option value="" selected disabled hidden></option> -->
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            <?php endif; ?>
                                        </select><span>(<?= $prod_of_the_day['review_count'] ?>)</span>
                                    </div>
                                    <p class="ps-product__price sale"><?= $prod_of_the_day['product_price'] ?> смн. <del><?= $prod_of_the_day['product_price'] ?> смн.</del></p>
                                </div>
                                <div class="ps-product__content hover">
                                    <a class="ps-product__title product_title_new" href="<?= $prod_of_the_day['base_url'] ?>index.php/main/product/<?= $prod_of_the_day['id'] ?>">
                                        <?= $prod_of_the_day['product_name'] ?>
                                    </a>
                                    <p class="ps-product__price sale"><?= $prod_of_the_day['product_price'] ?> смн. <del><?= $prod_of_the_day['product_price'] ?> смн.</del></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>