<div class="ps-breadcrumb">
    <div class="container">
        <div class="ps-container category-products_breadcrumb padding">
            <ul class="breadcrumb ">
                <li><a href="{base_url}index.php/main">Главная</a></li>
                <?php if (isset($category_with_parents['parent_cat']['parent_cat'])) : ?>
                    <li><?= $category_with_parents['parent_cat']['parent_cat']['category_name'] ?></li>
                    <li>
                        <a href="{base_url}index.php/main/categoryProducts/<?= $category_with_parents['parent_cat']['id'] ?>">
                            <?= $category_with_parents['parent_cat']['category_name'] ?>
                        </a>
                    </li>
                    <li><?= $category_with_parents['category_name'] ?></li>
                <?php else : ?>
                    <li>
                        <?= $category_with_parents['parent_cat']['category_name'] ?>
                    </li>
                    <li>
                        <?= $category_with_parents['category_name'] ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<header class="header header--mobile header--mobile-categories header_class_sort" data-sticky="true">
    <aside class="widget widget_shop srch_sort_pr_aside">
        <aside class="widget widget_shop widget_shop_price_sort">
            <figure>
                <h4 class="widget-title">По цене</h4>
                <div class="nonlinear_mobile_aside"></div>
                <p class="ps-slider__meta">
                    <span class="ps-slider__value slider__value_min"><span class="ps-slider__min_mobile"></span> смн.</span>
                    <span class="ps-slider__value slider__value_max"><span class="ps-slider__max_mobile"></span> смн.</span>
                </p>
                <div style="text-align: center" class="mt-5">
                    <button class="btn btn-info btn-lg sort_by_price" type="button">Показать</button>
                </div>
            </figure>
        </aside>
    </aside>
</header>

<div class="ps-page--shop" id="shop-sidebar">
    <div class="container">
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <?php if (!$isOnlySecondCategory) : ?>
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">Категории</h4>
                        <ul class="ps-list--categories">
                            <?php foreach ($category['sub_cat'] as $sub_cat) : ?>
                                <li id="sub_cat<?= $sub_cat['id'] ?>" class="current-menu-item menu-item-has-children">
                                    <a href="<?= $base_url ?>index.php/main/categoryProducts/<?= $sub_cat['id'] ?>">
                                        <?php if ($sub_cat['id'] == $category_id) : ?>
                                            <b><?= $sub_cat['category_name'] ?></b>
                                        <?php else : ?>
                                            <?= $sub_cat['category_name'] ?>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>
                <aside class="widget widget_shop widget_shop_price_sort">
                    <figure>
                        <h4 class="widget-title">По цене</h4>
                        <div class="nonlinear"></div>
                        <p class="ps-slider__meta">
                            <span class="ps-slider__value slider__value_min"><span class="ps-slider__min"></span> смн.</span>
                            <span class="ps-slider__value slider__value_max"><span class="ps-slider__max"></span> смн.</span>
                        </p>
                        <div style="text-align: center" class="mt-5">
                            <button class="btn btn-info btn-lg sort_by_price" type="button">Показать</button>
                        </div>
                    </figure>
                </aside>
            </div>
            <div class="ps-layout__right">
                <div class="ps-page__header category_page_header">
                    <h1><?= $category_with_parents['category_name'] ?></h1>
                    <?php if (sizeof($ad_slider) != 0) : ?>
                        <div class="ps-carousel--nav-inside owl-slider category_ad_slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                            <?php foreach ($ad_slider as $ad) : ?>
                                <a href="<?= $ad['advertisement_link'] ?>">
                                    <img class="slider_img img-fluid" src="<?= $ad['base_url'] ?>upload_banner/<?= $ad['advertisement_pic'] ?>" alt="">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div id="product_list" class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p><strong id="tot_prod"> {total_products} </strong> товаров</p>
                        <div class="ps-shopping__actions">
                            <select class="ps-select sorting" data-placeholder="Sort Items">
                                <option value="asc">От дешёвых к дорогим</option>
                                <option value="desc">От дорогих к дешёвым</option>
                                <option value="pr">По рейтингу</option>
                            </select>
                            <div class="ps-shopping__view">
                                <p>Показать</p>
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                    <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="products">

                    </div>

                </div>
                <!-- <script src="{base_url}plugins/nouislider/nouislider.min.js"></script> -->

                <script>
                    var category_id = '{category_id}';
                    var page = '{page}';
                    var sort = '{sort}';
                    var selectedSort = '';
                    var selected_act_sub = [];
                    var selected_ind = [];
                    var min_pr = null;
                    var max_pr = null;


                    function get_product_list(sortt, c_page = page, min_price = null, max_price = null) {
                        $('#loading').css('display', 'block');
                        selectedSort = sortt;

                        if (min_price == null || max_price == null) {
                            $.getJSON("{base_url}index.php/main/get_product_by_category_list?cat_id=" + category_id + "&page=" + c_page + "&sort=" + sortt, function(data, status) {

                                $("#products").html(data.html);

                                $('#tot_prod').text(data.total_prods);

                                $('#loading').css('display', 'none');
                                rating();
                                tabs();
                                tabLoad();
                                select2Cofig();
                            });
                        } else {
                            $.get("{base_url}index.php/main/get_product_by_category_list?cat_id=" + category_id +
                                "&page=" + c_page +
                                "&sort=" + sortt +
                                "&min_price=" + min_price +
                                "&max_price=" + max_price,
                                function(data, status) {
                                    data = JSON.parse(data);

                                    $("#products").html(data.html);
                                    $('#tot_prod').text(data.total_prods);
                                    $('#loading').css('display', 'none');
                                    rating();
                                    tabs();
                                    tabLoad();
                                    select2Cofig();
                                });
                        }
                    }

                    function sort_products() {
                        $(".sorting").on('change', function() {
                            $('.sorting').val($(this).children("option:selected").val());
                            page = 1;
                            selectedSort = $(this).children("option:selected").val();
                            get_product_list(selectedSort, 1, min_pr, max_pr);
                        });
                    }

                    function sort_by_price() {

                        min_pr = $(".ps-slider__min").text();
                        max_pr = $(".ps-slider__max").text();
                        $('.sort_by_price').on('click', function() {
                            page = 1;
                            min_pr = $(".ps-slider__min").text();
                            max_pr = $(".ps-slider__max").text();
                            get_product_list(selectedSort, 1, min_pr, max_pr);
                        });
                    }

                    function sort_by_price_mobile() {

                        min_pr = $(".ps-slider__min_mobile").text();
                        max_pr = $(".ps-slider__max_mobile").text();

                        $('.sort_by_price_mobile').on('click', function() {
                            page = 1;
                            min_pr = $(".ps-slider__min_mobile").text();
                            max_pr = $(".ps-slider__max_mobile").text();
                            get_product_list(selectedSort, 1, min_pr, max_pr);
                        });
                    }

                    function topage(p) {
                        page = p;
                        if (selectedSort == '') {
                            selectedSort = 'asc'
                        }
                        get_product_list(selectedSort, p, min_pr, max_pr);
                    }

                    function sub_toggle() {
                        $('.main_cat_class > .cat_icon_down').addClass('active');
                        $('.main_cat_class > .sub-menu').css('display', 'block');
                        $('#sub_cat<?= $second_category_id ?>').find('.cat_icon_down').addClass('active');
                        $('#sub_cat<?= $second_category_id ?>').find('.sub-menu').css('display', 'block');
                    }

                    function filterSliderMobileAside(price) {
                        var nonLinearSliderMobile = document.querySelector('.nonlinear_mobile_aside');
                        if (typeof nonLinearSliderMobile != 'undefined' && nonLinearSliderMobile != null) {
                            var obj = {
                                min: 0,
                                '10%': 999.9,
                                '20%': 1999.8,
                                '30%': 2999.7,
                                '40%': 3999.6,
                                '50%': 4999.5,
                                '60%': 5999.4,
                                '70%': 6999.3,
                                '80%': 7999.2,
                                '90%': 8999.1,
                                max: 9999
                            };
                            var arrayRng = [0, 9999];
                            if (price != null && price != 0) {
                                price = Math.ceil(price);
                                obj = {
                                    min: 0,
                                    '10%': parseInt((price * (1 / 10)).toFixed(1)),
                                    '20%': parseInt((price * (2 / 10)).toFixed(1)),
                                    '30%': parseInt((price * (3 / 10)).toFixed(1)),
                                    '40%': parseInt((price * (4 / 10)).toFixed(1)),
                                    '50%': parseInt((price * (5 / 10)).toFixed(1)),
                                    '60%': parseInt((price * (6 / 10)).toFixed(1)),
                                    '70%': parseInt((price * (7 / 10)).toFixed(1)),
                                    '80%': parseInt((price * (8 / 10)).toFixed(1)),
                                    '90%': parseInt((price * (9 / 10)).toFixed(1)),
                                    max: price
                                };
                                arrayRng = [0, price];
                            }
                            noUiSlider.create(nonLinearSliderMobile, {
                                connect: true,
                                behaviour: 'tap',
                                start: arrayRng,
                                range: obj
                            });
                            var nodes = [
                                document.querySelector('.ps-slider__min_mobile'),
                                document.querySelector('.ps-slider__max_mobile'),
                            ];
                            nonLinearSliderMobile.noUiSlider.on('update', function(values, handle) {
                                nodes[handle].innerHTML = Math.round(values[handle]);
                            });
                        }
                    }

                    function filterSlider(price) {
                        var nonLinearSlider = document.querySelector('.nonlinear');
                        if (typeof nonLinearSlider != 'undefined' && nonLinearSlider != null) {
                            var obj = {
                                min: 0,
                                '10%': 999.9,
                                '20%': 1999.8,
                                '30%': 2999.7,
                                '40%': 3999.6,
                                '50%': 4999.5,
                                '60%': 5999.4,
                                '70%': 6999.3,
                                '80%': 7999.2,
                                '90%': 8999.1,
                                max: 9999
                            };
                            var rangeArr = [0, 9999];

                            if (price != null && price != 0) {
                                price = Math.ceil(price);
                                obj = {
                                    min: 0,
                                    '10%': parseInt((price * (1 / 10)).toFixed(1)),
                                    '20%': parseInt((price * (2 / 10)).toFixed(1)),
                                    '30%': parseInt((price * (3 / 10)).toFixed(1)),
                                    '40%': parseInt((price * (4 / 10)).toFixed(1)),
                                    '50%': parseInt((price * (5 / 10)).toFixed(1)),
                                    '60%': parseInt((price * (6 / 10)).toFixed(1)),
                                    '70%': parseInt((price * (7 / 10)).toFixed(1)),
                                    '80%': parseInt((price * (8 / 10)).toFixed(1)),
                                    '90%': parseInt((price * (9 / 10)).toFixed(1)),
                                    max: price
                                }
                                rangeArr = [0, price];
                            }
                            noUiSlider.create(nonLinearSlider, {
                                connect: true,
                                behaviour: 'tap',
                                start: rangeArr,
                                range: obj
                            });
                            var nodes = [
                                document.querySelector('.ps-slider__min'),
                                document.querySelector('.ps-slider__max'),
                            ];
                            nonLinearSlider.noUiSlider.on('update', function(values, handle) {
                                nodes[handle].innerHTML = Math.round(values[handle]);
                            });
                        }
                    }
                    $(document).ready(function() {
                        filterSlider('<?= $prod_max_price ?>');
                        filterSliderMobileAside('<?= $prod_max_price ?>');
                        sub_toggle();
                        get_product_list();
                        sort_products();
                        sort_by_price();
                        sort_by_price_mobile();
                    });
                </script>
            </div>
        </div>
    </div>
</div>