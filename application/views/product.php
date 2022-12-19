<header class="header header--product" data-sticky="true">
    <nav class="navigation">
        <div class="container">
            <article class="ps-product--header-sticky">
                <div class="ps-product__thumbnail"><img src="{base_url}upload_product/{product_avatar}" alt="" /></div>
                <div class="ps-product__wrapper">
                    <div class="ps-product__content"><a class="ps-product__title" href="#"><?= $category_products['product_name'] ?></a>
                        <ul class="ps-tab-list header-tab_list">
                            <li class="active first"><a href="#tab-1">Инструкция</a></li>
                            <li class="second"><a href="#tab-3">Аналоги</a></li>
                            <li class="third"><a href="#tab-4">Отзывы (<?= $category_products['review_count'] ?>)</a></li>
                        </ul>
                    </div>
                    <div class="ps-product__shopping"><span class="ps-product__price-top pr-3"><span><?= $category_products['product_price'] ?> смн.</span>
                            <?php if ($category_products['product_old_price'] != 0) : ?>
                                <del><?= $category_products['product_old_price'] ?> смн.</del><?php endif; ?>
                        </span>
                        <button onclick='addToCart(prod = <?= json_encode($category_products) ?>)' class="ps-btn ">В корзину</button>
                    </div>
                </div>
            </article>
        </div>
    </nav>
</header>

<!-- MOBILE -->


<div class="ps-breadcrumb">
    <div class="container">
        <div class="ps-container padding0">
            <ul class="breadcrumb ">
                <li><a href="{base_url}">Главная</a></li>
                <?php if ($category_with_parents != []) : ?>
                    <?php if ($is_second_categ == '') : ?>
                        <li><?= $category_with_parents['parent_cat']['parent_cat']['category_name'] ?></li>
                        <li>
                            <a href="{base_url}index.php/main/categoryProducts/<?= $category_with_parents['parent_cat']['id'] ?>">
                                <?= $category_with_parents['parent_cat']['category_name'] ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="{base_url}index.php/main/categoryProducts/<?= $category_with_parents['id'] ?>">
                            <?= $category_with_parents['category_name'] ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li><?= $category_products['product_name'] ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="ps-page--product">
    <div class="container">
        <div class="product_title">
            <h1><?= $category_products['product_name'] ?></h1>
        </div>
        <div class="ps-page__container">
            <div class="ps-page__left">
                <div class="ps-product--detail">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="false">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="true">
                                        <?php foreach ($category_products['product_pics'] as $pic) : ?>
                                            <div class="item">
                                                <a href="{base_url}upload_product/<?= $pic['product_pic'] ?>">
                                                    <img class="main_pic_in_prod" src="{base_url}upload_product/<?= $pic['product_pic'] ?>" alt="">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="3" data-sm="3" data-arrow="false">
                                <?php foreach ($category_products['product_pics'] as $pic) : ?>
                                    <div class="item"><img src="{base_url}upload_product/<?= $pic['product_pic'] ?>" alt=""></div>
                                <?php endforeach; ?>
                            </div>

                            <p class="margin-top20"> Внешний вид товара может отличаться от изображённого на
                                фотографии </p>

                        </div>
                        <div class="ps-product__info">

                            <div class="ps-product__meta">
                                <div class="ps-product__rating m-t-0">
                                    <select class="ps-rating" data-read-only="true">
                                        <?php if ($category_products['review_count'] != 0) : ?>
                                            <?php for ($i = 1; $i <= $category_products['prod_rating_average']; $i++) : ?>
                                                <option value="1"></option>
                                            <?php endfor; ?>
                                            <?php for ($i = ($category_products['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                    </select><span>(<?= $category_products['review_count'] ?>)</span>
                                </div>
                                <div class="product_articule">
                                    <p class="text-muted">Арт. <span><?= $category_products['product_articule'] ?></span></p>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: flex-end;">
                                <?php if ($category_products['product_old_price'] != 0) : ?>
                                    <del class="ps-pp_db-del"><?= $category_products['product_old_price'] ?> смн.</del><?php endif; ?>
                                <div class="like-icon">
                                    <label>
                                        <input value="<?php $category_products['id'] ?>" <?php echo $category_products['is_favorite'] == 1 ?  'checked' : null  ?> type="checkbox" id="red">
                                        <svg id="shape" fill="none" data-id="<?= $category_products['id']   ?>" data-like="0" class="likeClick" width="24" height="24" style="cursor: pointer; float: right;" viewBox="0 0 22 19" xmlns="http://www.w3.org/2000/svg">
                                            <path class="seat" d="M6.20208 0.884277C3.51425 0.884277 1.33459 3.04155 1.33459 5.70309C1.33459 7.85159 2.1864 12.9508 10.5711 18.1054C10.7213 18.1968 10.8938 18.2452 11.0696 18.2452C11.2454 18.2452 11.4178 18.1968 11.568 18.1054C19.9527 12.9508 20.8045 7.85159 20.8045 5.70309C20.8045 3.04155 18.6249 0.884277 15.937 0.884277C13.2492 0.884277 11.0696 3.80477 11.0696 3.80477C11.0696 3.80477 8.8899 0.884277 6.20208 0.884277Z" stroke="#A8A8A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </label>
                                </div>
                            </div>

                            <h4 class="ps-product__price ps-pp_db"><?= $category_products['product_price'] ?> смн.</h4>
                            <h4 class="ps-product__price ps-pp_dn">_ _._ _ смн.</h4>
                            <div class="ps-product__desc">
                                <?php if ($category_products['total_count_in_store'] > 0) : ?>
                                    <p class="global-product-exist"><strong>В наличии</strong></p>
                                <?php else : ?>
                                    <p class="global-product-not-exist"><strong>Нет в наличии</strong></p>
                                <?php endif; ?>
                                <?php if ($category_products['product_type']) : ?>
                                    <p><strong><?= $category_products['product_type'] ?> ПРЕПАРАТ</strong></p>
                                <?php endif; ?>
                                <ul class="ps-list--dot nobull">
                                    <li> Действующее вещество (МНН):
                                        <?php for ($i = 0; $i < sizeof($category_products['active_substance']); $i++) : ?>
                                            <a href="#">
                                                <?= $category_products['active_substance'][$i]['tag_name'] ?>
                                            </a><?php if (($i + 1) != sizeof($category_products['active_substance'])) : ?>,
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    </li>
                                    <li> Производитель: <?= $category_products['product_brand']['brand_name'] ?>
                                    </li>
                                    <li> Категория:
                                        <?php for ($i = 0; $i < sizeof($category_products['categories']); $i++) : ?>
                                            <a href="{base_url}main/categoryProducts/<?= $category_products['categories'][$i]['id'] ?>">
                                                <?= $category_products['categories'][$i]['category_name'] ?>
                                            </a><?php if (($i + 1) != sizeof($category_products['categories'])) : ?>,
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="ps-product__shopping extend">
                                <div class="ps-product__btn-group">
                                    <figure>
                                        <div class="form-group--number" data-id="<?= $category_products['id'] ?>">
                                            <button class=" up" id="increase_count">+</button>
                                            <button class="down" id="decrease_count">-</i>
                                            </button>
                                            <input class="form-control height50" id="count_input" type="number" value="1">
                                        </div>
                                    </figure>
                                    <button onclick='addToCart(prod = <?= json_encode($category_products) ?>)' class="product-group_btn">Купить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-product__content ps-tab-root">
                        <ul class="ps-tab-list body_tab_list">
                            <li class="active first"><a href="#tab-1">Инструкция</a></li>
                            <li class="second"><a href="#tab-3">Аналоги</a></li>
                            <li class="third"><a href="#tab-4">Отзывы (<?= $category_products['review_count'] ?>)</a></li>
                        </ul>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-document product_about">
                                    <?= $category_products['product_about'] ?>
                                </div>
                                <a class="product_more">Ещё
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                            </div>
                            <div class="ps-tab" id="tab-3">
                                <?php if (sizeof($similar_products) > 1) : ?>
                                    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                                        <?php foreach ($similar_products as $sm_prod) : ?>
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail hover01">
                                                    <a href="{base_url}main/product/<?= $sm_prod['id'] ?>">
                                                        <img class="similar_prods_imgs" src="<?= $sm_prod['base_url'] ?>upload_product/<?= $sm_prod['product_pic'] ?>" alt=""></a>

                                                </div>
                                                <div class="ps-product__container">
                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title product_title_new" href="{base_url}main/product/<?= $sm_prod['id'] ?>"><?= $sm_prod['product_name'] ?></a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <?php if ($sm_prod['review_count'] != 0) : ?>
                                                                    <?php for ($i = 1; $i <= $sm_prod['prod_rating_average']; $i++) : ?>
                                                                        <option value="1"></option>
                                                                    <?php endfor; ?>
                                                                    <?php for ($i = ($sm_prod['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                                            </select><span>(<?= $sm_prod['review_count'] ?>)</span>
                                                        </div>
                                                        <p class="ps-product__price sale prods_slider"><?= $sm_prod['product_price'] ?> <?php if ($sm_prod['product_old_price'] != 0) : ?> смн. <del><?= $sm_prod['product_old_price'] ?> </del><?php endif; ?></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title product_title_new" href="{base_url}main/product/<?= $sm_prod['id'] ?>"><?= $sm_prod['product_name'] ?></a>
                                                        <p class="ps-product__price sale"><span><?= $sm_prod['product_price'] ?></span> <?php if ($sm_prod['product_old_price'] != 0) : ?> смн. <del><?= $sm_prod['product_old_price'] ?> </del><?php endif; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php elseif (sizeof($similar_products) == 1) :  ?>
                                    <div class="ps-product similar_product1">
                                        <div class="ps-product__thumbnail hover01">
                                            <a href="{base_url}main/product/<?= $similar_products[0]['id'] ?>">
                                                <img class="similar_prods_imgs" src="<?= $similar_products[0]['base_url'] ?>upload_product/<?= $similar_products[0]['product_pic'] ?>" alt=""></a>

                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content">
                                                <a class="ps-product__title product_title_new" href="{base_url}main/product/<?= $similar_products[0]['id'] ?>"><?= $similar_products[0]['product_name'] ?></a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <?php if ($similar_products[0]['review_count'] != 0) : ?>
                                                            <?php for ($i = 1; $i <= $similar_products[0]['prod_rating_average']; $i++) : ?>
                                                                <option value="1"></option>
                                                            <?php endfor; ?>
                                                            <?php for ($i = ($similar_products[0]['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                                    </select><span>(<?= $similar_products[0]['review_count'] ?>)</span>
                                                </div>
                                                <p class="ps-product__price sale prods_slider"><?= $similar_products[0]['product_price'] ?> <?php if ($similar_products[0]['product_old_price'] != 0) : ?> смн. <del><?= $similar_products[0]['product_old_price'] ?> </del><?php endif; ?></p>
                                            </div>
                                            <!-- <div class="ps-product__content hover"><a class="ps-product__title" href="{base_url}main/product/<?= $similar_products[0]['id'] ?>"><?= $similar_products[0]['product_name'] ?></a>
                                                <p class="ps-product__price sale"><span><?= $similar_products[0]['product_price'] ?></span> <?php if ($similar_products[0]['product_old_price'] != 0) : ?> смн. <del><?= $similar_products[0]['product_old_price'] ?> </del><?php endif; ?></p>
                                            </div> -->
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <h4 class="text-muted similar_prods_empty">У данного товара не найдено аналогов </h4>
                                <?php endif;  ?>
                            </div>
                            <div class="ps-tab" id="tab-4">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                        <div class="ps-block--average-rating">
                                            <div class="ps-block__header">
                                                <h3><?= $category_products['prod_rating_average'] ?></h3>
                                                <select class="ps-rating" data-read-only="true">
                                                    <?php if ($category_products['review_count'] != 0) : ?>

                                                        <?php for ($i = 1; $i <= $category_products['prod_rating_average']; $i++) : ?>
                                                            <option value="1"></option>
                                                        <?php endfor; ?>
                                                        <?php for ($i = ($category_products['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                                </select><span><?= $category_products['review_count'] ?> Отзыв</span>
                                            </div>
                                            <?php if ($category_products['review_count'] != 0) : ?>
                                                <div class="ps-block__star"><span>5 Звёзд</span>
                                                    <div class="ps-progress" data-value="<?= $category_products['prod_rating_each']['fives']['percentage'] ?>"><span></span></div>
                                                    <span><?= $category_products['prod_rating_each']['ones']['percentage'] ?>%</span>
                                                </div>
                                                <div class="ps-block__star"><span>4 Звёзд</span>
                                                    <div class="ps-progress" data-value="<?= $category_products['prod_rating_each']['fours']['percentage'] ?>"><span></span></div>
                                                    <span><?= $category_products['prod_rating_each']['fours']['percentage'] ?>%</span>
                                                </div>
                                                <div class="ps-block__star"><span>3 Звёзд</span>
                                                    <div class="ps-progress" data-value="<?= $category_products['prod_rating_each']['threes']['percentage'] ?>"><span></span></div>
                                                    <span><?= $category_products['prod_rating_each']['threes']['percentage'] ?>%</span>
                                                </div>
                                                <div class="ps-block__star"><span>2 Звёзд</span>
                                                    <div class="ps-progress" data-value="<?= $category_products['prod_rating_each']['twos']['percentage'] ?>"><span></span></div>
                                                    <span><?= $category_products['prod_rating_each']['twos']['percentage'] ?>%</span>
                                                </div>
                                                <div class="ps-block__star"><span>1 Звёзд</span>
                                                    <div class="ps-progress" data-value="<?= $category_products['prod_rating_each']['ones']['percentage'] ?>"><span></span></div>
                                                    <span><?= $category_products['prod_rating_each']['ones']['percentage'] ?>%</span>
                                                </div>
                                            <?php else : ?>
                                                <div class="ps-block__star"><span>5 Звёзд</span>
                                                    <div class="ps-progress" data-value="0"><span></span></div>
                                                    <span>0%</span>
                                                </div>
                                                <div class="ps-block__star"><span>4 Звёзд</span>
                                                    <div class="ps-progress" data-value="0"><span></span></div>
                                                    <span>0%</span>
                                                </div>
                                                <div class="ps-block__star"><span>3 Звёзд</span>
                                                    <div class="ps-progress" data-value="0"><span></span></div>
                                                    <span>0%</span>
                                                </div>
                                                <div class="ps-block__star"><span>2 Звёзд</span>
                                                    <div class="ps-progress" data-value="0"><span></span></div>
                                                    <span>0%</span>
                                                </div>
                                                <div class="ps-block__star"><span>1 Звёзд</span>
                                                    <div class="ps-progress" data-value="0"><span></span></div>
                                                    <span>0%</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                        <div style="display: none;" id="review_successful">
                                            <p style="font-size: 24px;color:green">Успешно отправлен <i class="fa fa-check"></i></p>
                                        </div>
                                        <form class="ps-form--review" id="ps_rating_form">
                                            <h4>Отправьте ваш отзыв</h4>
                                            <div class="form-group form-group__rating">
                                                <label>Ваша оценка</label>
                                                <select name="rating_star" id="rating_star" class="ps-rating" data-read-only="false">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea id="review_comment" maxlength="250" name="review_comment" required class="form-control" rows="6" placeholder="Здесь Вы можете написать свой отзыв (Не более 250 символов)"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                    <div class="form-group">
                                                        <input id="review_name" maxlength="50" name="review_name" required class="form-control" type="text" placeholder="Ваше имя">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                    <div class="form-group">
                                                        <input id="review_email" maxlength="50" name="review_email" required class="form-control" type="email" placeholder="Ваша электронная почта">
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="form-group submit">
                                                <button name="review_submit_btn" id="review_submit_btn" type="submit" class="btn ps-btn" onclick="send_review()">
                                                    Отправить
                                                    <div class="spinner-border text-light" id="review_spinner" style="margin-left:10px;display:none" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php if (sizeof($comments) != 0) : ?>
                                    <h3>Комментарии</h3>
                                    <hr>
                                    <div class="comments_list">
                                        <?php foreach ($comments as $comment) : ?>
                                            <div class="each_comment_div">
                                                <div class="each_comment_div_info">
                                                    <div class="ps-product__rating m-t-0">
                                                        <select class="ps-rating" data-read-only="true">
                                                            <?php for ($i = 0; $i < $comment['star_rating']; $i++) : ?>
                                                                <option value="1"></option>
                                                            <?php endfor; ?>
                                                            <?php for ($j = ($comment['star_rating'] + 1); $j <= 5; $j++) : ?>
                                                                <option value="<?= $j ?>"><?= $j ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="product-comment_p"><?= $comment['user_comment'] ?></p>
                                                <p class="product-comment_p"><span class="text-muted">Автор отзыва:</span> <?= $comment['user_name'] ?></p>
                                                <p class="product-comment_p"><span class="text-muted">Дата отзыва:</span> <?= $comment['created_at'] ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-page__right widget_page_right">
                <aside class="widget widget_product widget_features">
                    <div class="widget_pr_div">
                        <img class="pr_side_icons" src="/img/icons/delivery.svg">
                        <span>ДОСТАВКА</span>
                    </div>
                    <p class="widget_pr_p">
                        Доставка до Вашего дома по г. Душанбе
                    </p>
                    <p class="widget_pr_p">
                        Стоимость доставки от 5 сомони
                    </p>
                    <div class="widget_pr_div widget_pr_div2">
                        <img class="pr_side_icons" src="/img/icons/coins.svg">
                        <span>ОПЛАТА</span>
                    </div>
                    <p class="widget_pr_p">
                        Минимальная сумма заказа 35 сомони
                    </p>
                    <p class="widget_pr_p">
                        Оплата наличними или онлайн
                    </p>
                </aside>
                <aside>
                    <?php if ($ad_img != []) : ?>
                        <a class="ps-collection" href="<?= $ad_img[0]['advertisement_link'] ?>">
                            <img class="ad_mini_img" src="{base_url}upload_banner/<?= $ad_img[0]['advertisement_pic'] ?>" alt="">
                        </a>
                        <?php if (isset($ad_img[1])) : ?>
                            <a class="ps-collection margin-top20" href="<?= $ad_img[1]['advertisement_link'] ?>">
                                <img class="ad_mini_img" src="<?= $ad_img[1]['base_url'] ?>upload_banner/<?= $ad_img[1]['advertisement_pic'] ?>" alt="">
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <!-- **************************************************** -->
        <div class="container bi_recomend-product" style="background-color: #fff; padding: 20px; margin-bottom: 5rem; border-radius: 5px;">
            <div class="ps-section__header pb-5">
                <h3>Вам может пригодиться</h3>
                <hr>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($prods_suggestions as $prod_sugg) : ?>
                        <div class="ps-product ps-product--inner ps-product_of_the_day">
                            <label>
                                <input value="<?php $prod_sugg['id'] ?>" <?php echo $prod_sugg['is_favorite'] == 1 ?  'checked' : null  ?> type="checkbox" id="red">
                                <svg id="shape" fill="none" data-id="<?= $prod_sugg['id']   ?>" data-like="0" class="likeClick" width="24" height="24" style="cursor: pointer; float: right;" viewBox="0 0 22 19" xmlns="http://www.w3.org/2000/svg">
                                    <path class="seat" d="M6.20208 0.884277C3.51425 0.884277 1.33459 3.04155 1.33459 5.70309C1.33459 7.85159 2.1864 12.9508 10.5711 18.1054C10.7213 18.1968 10.8938 18.2452 11.0696 18.2452C11.2454 18.2452 11.4178 18.1968 11.568 18.1054C19.9527 12.9508 20.8045 7.85159 20.8045 5.70309C20.8045 3.04155 18.6249 0.884277 15.937 0.884277C13.2492 0.884277 11.0696 3.80477 11.0696 3.80477C11.0696 3.80477 8.8899 0.884277 6.20208 0.884277Z" stroke="#A8A8A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label>
                            <div class="ps-product__thumbnail ps-product__thumbnail_img_div  hover01">
                                <a href="<?= $base_url ?>index.php/main/product/<?= $prod_sugg['id'] ?>?from=main">
                                    <img class="imgs" src="<?= $base_url ?>upload_product/<?= $prod_sugg['product_pic'] ?>" alt="Product IMG">
                                </a>
                            </div>
                            <div class="ps-product__container">
                                <div class="ps-product__content"><a class="ps-product__title product_title_new" href="<?= $base_url ?>index.php/main/product/<?= $prod_sugg['id'] ?>">
                                        <?= $prod_sugg['product_name'] ?></a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <?php if ($prod_sugg['review_count'] != 0) : ?>
                                                <?php for ($i = 1; $i <= $prod_sugg['prod_rating_average']; $i++) : ?>
                                                    <option value="1"></option>
                                                <?php endfor; ?>
                                                <?php for ($i = ($prod_sugg['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                        </select><span>(<?= $prod_sugg['review_count'] ?>)</span>
                                    </div>
                                    <p class="ps-product__price sale prods_slider"> <span class="ps-product__price-span">
                                            <?php if ($prod_sugg['product_old_price'] != 0) : ?><del><?= $prod_sugg['product_old_price'] ?> </del><?php endif; ?>
                                            <?= $prod_sugg['product_price'] ?> c. </span><button onclick='addToCart(res = <?= json_encode($prod_sugg) ?>)' class="ps-btn btn-cart_cat">В корзину</button></p>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="product_add_notification_div" style="display: none;">
    <i class="fa fa-check-circle" aria-hidden="true"></i>
    <span class="prod_add_notification_text">"<span class="span_added_prod_name"></span>" успешно добавлен в вашу корзину.</span>
</div>

<div class="product_add_notification_div_error" style="display: none;">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
    <span class="prod_add_notification_text">К сожалению товар нет в наличии. Помощь по телефону 9990</span>
</div>
<div class="product_add_notification_div_max_count" style="display: none;">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
    <span class="prod_add_notification_text">Максимальное количество товаров уже добавлено в корзину</span>
</div>



<script src="{base_url}plugins/jquery.form.validation.min.js"></script>
<script src="{base_url}js/jquery.validate.min.js"></script>
<script src="{base_url}js/form_validation_messages_ru.js"></script>
<script>
    const idCount = count_input.parentElement.dataset.id
    const _elem = JSON.parse(localStorage.getItem("product_list"))
    let resCount;
    try {
        resCount = _elem.filter(elem => elem.product_id === idCount)[0].product_count;
    } catch (error) {
        resCount = 1
    }
    $('#count_input').val(resCount)

    var count = 1;
    var max_count_reached = false;
    var total_count_global = '<?= $category_products['total_count_in_store']; ?>';

    function decrease_count() {
        $('#decrease_count').on('click', function() {
            resCount--;
            if (resCount < 1) {
                resCount = 1;
            }
            $('#count_input').val(resCount);
        })
    }

    function increase_count() {
        $('#increase_count').on('click', function() {
            // if (count < total_count_global) {
            resCount++;
            // }
            $('#count_input').val(resCount);
        })
    }

    function change_count() {
        $('#count_input').change(function() {

            if ($('#count_input').val() > 0) {
                resCount = $('#count_input').val();
            } else {
                resCount = 1;
                $('#count_input').val(resCount);
            }
            // else if ($('#count_input').val() < 1 || Number($('#count_input').val()) == 0)
        })
    }
    if (document.querySelector(".global-product-not-exist") === null) {
        $('.ps-pp_dn').css("display", "none");
        $('.ps-pp_db').css("display", "block");
        $('.ps-pp_db-del').css("display", "block")
    } else {
        $('.ps-pp_db').css("display", "none");
        $('.ps-pp_db-del').css("display", "none")
        $('.ps-product__price-top').css("display", "none")
    }
    // if ($('.global-product-not-exist')){
    //     $('.ps-product__price').hide();
    //     $('.ps-pp_dn').css("display", "block");
    // }else if($('.global-product-exist')){
    // }


    function rating_form_validate() {
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $('#ps_rating_form').validate({
            rules: {
                rating_star: {
                    required: true
                },
                review_comment: {
                    required: true,
                    maxlength: 250
                },
                review_name: {
                    required: true,
                    maxlength: 50
                },
                // review_email: {
                //     required: true,
                //     email: true,
                //     maxlength: 50,
                //     remote: {
                //         url: '<?= base_url() ?>api/checkEmailForRating',
                //         type: 'POST',
                //         data: {
                //             email: function() {
                //                 return $('#review_email').val();
                //             },
                //             product_id: <?= $category_products['id'] ?>
                //         }
                //     }
                // },
            },


            messages: {
                // review_email: {
                //     remote: "Отзыв уже принят с этой почты"
                //     // required: "Пожалуйста ввeдите вашу почту",
                //     // email: "Ваша почта должна быть в формате name@domain.com"
                // },
            },
            errorPlacement: function(error, element) {
                if (element.is(":radio")) {
                    error.appendTo(element.parents('.ps-block__shipping'));
                } else { // This is the default behavior 
                    error.insertAfter(element);
                }
            }
        });
    }

    function send_review() {
        var form = $('#ps_rating_form');
        form.validate();
        var isValid = form.valid();
        var isPending = form.validate().pendingRequest;

        if ($('#rating_star').val() != 0) {
            $('.form-group__rating').find('p.rating_empty').remove();

            if (form.valid()) {
                $('#review_spinner').show();
                $('#review_submit_btn').attr('disabled', true);
                $.ajax({
                    url: "<?= $base_url; ?>index.php/api/sendReview",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "prod_id": <?= $category_products['id'] ?>,
                        "review_rating": $('#rating_star').val(),
                        // "review_email": $('#review_email').val(),
                        "review_name": $('#review_name').val(),
                        "review_comment": $('#review_comment').val(),
                    },
                    success: function(data) {
                        if (data == 1) {
                            $('#ps_rating_form').hide();
                            $('#review_successful').show();
                            $("body,html").animate({
                                    scrollTop: $("#review_successful").parent().offset().top
                                },
                                300 //speed
                            );
                        } else {
                            $('#review_spinner').hide();
                            $('#review_submit_btn').attr('disabled', false);
                        }
                    },
                    error: function(data) {}
                });
            }
        } else {

            if ($('.form-group__rating').find('p.rating_empty').length == 0) {
                $('.form-group__rating').append(
                    '<p class="rating_empty" style="color:red">Пожалуйста выберите оценку</p>'
                );
            }
            $("body,html").animate({
                    scrollTop: $(".form-group__rating").parent().offset().top
                },
                300 //speed
            );
        }
    }

    function clear() {
        $('#rating_star').val('0');
        // $('#review_email').val('');
        $('#review_name').val('');
        $('#review_comment').val('');
    }

    function scrollToTabs() {
        $('.header-tab_list li a').click(function() {
            $("body,html").animate({
                    scrollTop: $(".body_tab_list").parent().offset().top
                },
                300 //speed
            );
        });
    }

    function showFullText() {
        $('.product_more').on('click', function() {
            $('.product_more').hide();
            $('.product_about').addClass('without_before_element');
            $('.product_about').css({
                'cssText': 'overflow: normal; max-height:max-content;'
            });
        })
    }

    $(document).ready(function() {
        if ($('.form-group__rating').find('p.rating_empty').length) {
            $('.form-group__rating').find('p.rating_empty').remove();
        }
        $('.ps-tab-list  li > a ').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            var liClass = $(this).parent().attr("class").split(/\s+/);

            liClass.filter((el) => {
                el != 'active'
            });

            // $(this)
            //     .closest('li')
            //     .siblings('li')
            //     .removeClass('active');
            $('.ps-tab-list li').siblings('li').removeClass('active')

            // $(this)
            //     .closest('li')
            //     .addClass('active');
            $('.ps-tab-list li.' + liClass).addClass('active')

            $(target).addClass('active');
            $(target)
                .siblings('.ps-tab')
                .removeClass('active');

            tabsObj = target;
        });
        $('#count_input').val(resCount);
        showFullText();
        rating_form_validate();
        decrease_count();
        increase_count();
        change_count();
        scrollToTabs();
        clear();
        set_prods_header();
        // remove_from_cart();
    })

    const __likeClicks = document.getElementsByClassName("likeClick")
    for (let i = 0; i < __likeClicks.length; i++) {
        __likeClicks[i].addEventListener('click', function() {
            this.setAttribute('id', 'shape');
            this.dataset.like === "0" ? (this.dataset.like = "1") : (this.dataset.like = "0");
            let isLike = Boolean(Number(this.dataset.like));
            let _like = window.getComputedStyle(this);
            if (localStorage.getItem("userId")) {
                if (_like.fill === "none") {
                    $.ajax({
                        type: "POST",
                        url: "{base_url}favorites",
                        headers: {
                            "Accept": "application/json",
                        },
                        data: {
                            user_id: JSON.parse(localStorage.getItem("userId")).user_id,
                            product_id: Number(this.getAttribute("data-id")),
                        },
                    })

                } else {
                    $.ajax({
                        type: "POST",
                        url: "{base_url}favorites/delete",
                        headers: {
                            "Accept": "application/json",
                        },
                        data: {
                            user_id: JSON.parse(localStorage.getItem("userId")).user_id,
                            product_id: Number(this.getAttribute("data-id")),
                        },
                    })
                }
            } else {
                this.removeAttribute('id');
                $(".enter-form").css("display", "block");
                document.querySelector(".enter-btn-bg").style.display = "flex";
                document.querySelector(".enter-btn-bg").classList.add("active-animation");
                document.querySelector(".enter-btn-bg").classList.remove("disactive-animation");
            }
        })
    }
    var count = 1;
    var max_count_reached = false;
    var total_count_global = '<?= $category_products['total_count_in_store']; ?>';

    function addToCart(res) {
        max_count_reached = false;
        var array = [];
        var id = res.id;
        var count = Number($('#count_input').val());
        var price = res.product_price;
        var old_price = res.product_old_price;
        var brand = res.product_brand;
        var pic = res.product_pic;
        var name = res.product_name;
        var total_count = res.total_count_in_store;
        var product_articule = res.product_articule;
        var obj = {
            product_id: id,
            product_name: name,
            product_count: count,
            product_old_price: old_price,
            product_price: price,
            product_brand: brand,
            product_pic: pic,
            product_total_count: total_count,
            prod_articule: product_articule
        };
        var found = false;
        if (total_count <= 0) {
            $('.product_add_notification_div_error').css({
                'cssText': 'display: flex !important'
            });
            setTimeout(function() {
                $('.product_add_notification_div_error').hide();
            }, 2500)
        } else {
            if (localStorage.getItem("product_list")) {
                var mydata = $.parseJSON(localStorage.getItem("product_list"));
                mydata.forEach(function(elem, index) {
                    if (elem.product_id == id) {
                        elem.product_count = resCount;

                        // if (elem.product_count > total_count) {
                        //     elem.product_count = total_count;
                        // $('.product_add_notification_div_error').css({
                        //     'cssText': 'display: flex !important'
                        // });
                        // setTimeout(function() {
                        //     $('.product_add_notification_div_error').hide();
                        // }, 2500)
                        // max_count_reached = true;
                        // }
                        mydata[index] = elem;
                        found = true;
                    }
                });
                if (!found) {
                    mydata.push(obj);
                }
                // $.cookie("product_list", JSON.stringify(mydata), {
                //     path: '/'
                // });
                localStorage.setItem("product_list", JSON.stringify(mydata))
            } else {
                array.push(obj);
                // $.cookie("product_list", JSON.stringify(array), {
                //     path: '/'
                // });
                localStorage.setItem("product_list", JSON.stringify(array))
            }
            if (!max_count_reached) {
                $('.span_added_prod_name').text('' + name);
                $('.product_add_notification_div').css({
                    'cssText': 'display: flex !important'
                });
                setTimeout(function() {
                    $('.product_add_notification_div').hide();
                }, 1000)
            }
            set_prods_header();
        }
    }
</script>
<style>
    label {
        display: block;
    }

    #red {
        display: none;
    }

    #red:checked+#shape {
        fill: #DD2E44;
        stroke: #DD2E44 !important;
    }

    #red:checked+#shape path {
        fill: #DD2E44;
        stroke: #DD2E44 !important;
    }
</style>