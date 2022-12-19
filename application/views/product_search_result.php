    <div class="ps-breadcrumb">
        <div class="container">
            <div class="ps-container padding0">
                <ul class="breadcrumb ">
                    <li><a href="{base_url}">Главная</a></li>
                    <li>Поиск</li>
                    <li><?= $srch_inp ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header__filter">
        <aside class="widget widget_shop">
            <h4 class="widget-title">По цене</h4>
            <div class="nonlinear_mobile_aside"></div>
            <p class="ps-slider__meta">
                <span class="ps-slider__value slider__value_min"><span class="ps-slider__min_mobile"></span> смн.</span>
                <span class="ps-slider__value slider__value_max"><span class="ps-slider__max_mobile"></span> смн.</span>
            </p>
            <div style="text-align: center serch-result_btn">
                <button class="btn btn-info btn-lg sort_by_price_mobile" style="display: flex; justify-content: center;" type="button">Показать</button>
            </div>
        </aside>
    </div>

    <div class="ps-page--shop" id="shop-sidebar">
        <div class="container">
            <div class="ps-layout--shop">
                <div class="ps-layout__left">
                    <aside class="widget widget_shop srch_sort_pr_aside">
                        <figure class="srch_sort_pr_figure">
                            <h4 class="widget-title">По цене</h4>
                            <div class="nonlinear"></div>
                            <p class="ps-slider__meta mb-5">
                                <span class="ps-slider__value slider__value_min">
                                    <span class="ps-slider__min srch-ps-slider__min"></span> смн.</span>
                                <span class="ps-slider__value slider__value_max">
                                    <span class="ps-slider__max srch-ps-slider__max"></span> смн.</span>
                            </p>
                            <div style="text-align: center mt-5">
                                <button class="btn btn-info btn-lg srch_res_sort_by_price" style="width: 100%;" type="button">Показать</button>
                            </div>
                        </figure>
                    </aside>
                    <?php if (sizeof($ad_mini) != 0) : ?>
                        <a class="ps-collection" href="<?= $ad_mini[0]['advertisement_link'] ?>">
                            <img class="ad_mini_img" src="<?= $ad_mini[0]['base_url'] ?>upload_banner/<?= $ad_mini[0]['advertisement_pic'] ?>" alt="">
                        </a>
                        <?php if (isset($ad_mini[1])) : ?>
                            <a class="ps-collection margin-top20" href="<?= $ad_mini[1]['advertisement_link'] ?>">
                                <img class="ad_mini_img" src="<?= $ad_mini[1]['base_url'] ?>upload_banner/<?= $ad_mini[1]['advertisement_pic'] ?>" alt="">
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="ps-layout__right">
                    <div class="ps-shopping-product srch_res_products">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loading" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
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
    <!-- <div class="max_limit_reached" style="display: none;">
    <i class="fa fa-cancel" aria-hidden="true"></i>
    <span class="prod_add_notification_text">"<span class="span_added_prod_name"></span>" успешно добавлен в вашу корзину.</span>
</div> -->


    <script>
        var max_count_reached = false;

        function add_to_cart(id, name, old_price, price, brand,brand_name, pic, total_count, product_articule) {
            const me = Object.create(null)
            me.id = brand; // "name" is a property set on "me", but not on "person"
            me.brand_name = brand_name;
            max_count_reached = false;
            var array = [];
            var count = 1;
            var obj = {
                product_id: id,
                product_name: name,
                product_count: count,
                product_old_price: old_price,
                product_price: price,
                product_brand: me,
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
                            elem.product_count += count;
                            // if (elem.product_count > total_count) {
                            //     elem.product_count = total_count;
                            //     alert('Максимальное количество товаров');
                            //     max_count_reached = true;
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
                    localStorage.setItem("product_list", JSON.stringify(mydata));
                    onAddBorder();
                } else {
                    array.push(obj);
                    // $.cookie("product_list", JSON.stringify(array), {
                    //     path: '/'
                    // });
                    localStorage.setItem("product_list", JSON.stringify(array));
                    onAddBorder();

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

        function get_srch_product_list(min_price = '', max_price = '') {
            $('#loading').css('display', 'block');

            $.getJSON("{base_url}index.php/main/get_srch_results?" +
                "srch_pr_inp=<?= $srch_inp ?>" +
                "&min_price=" + min_price +
                "&max_price=" + max_price,
                function(data, status) {
                    $(".srch_res_products").html(data.html);
                    $('#loading').css('display', 'none');
                    rating();
                    // tabs();
                    // tabLoad();
                    // select2Cofig();
                });
        }

        function srch_sort_by_price() {

            min_pr = $(".ps-slider__min").text();
            max_pr = $(".ps-slider__max").text();

            $('.srch_res_sort_by_price').on('click', function() {
                page = 1;
                min_pr = $(".ps-slider__min").text();
                max_pr = $(".ps-slider__max").text();
                get_srch_product_list(min_pr, max_pr);
            });
        }

        function srch_sort_by_price_mobile() {

            min_pr = $(".ps-slider__min_mobile").text();
            max_pr = $(".ps-slider__max_mobile").text();

            $('.sort_by_price_mobile').on('click', function() {
                page = 1;
                min_pr = $(".ps-slider__min_mobile").text();
                max_pr = $(".ps-slider__max_mobile").text();
                get_srch_product_list(min_pr, max_pr);
                if ($('.ps-filter--sidebar') && $('.ps-filter--sidebar').hasClass("active")) {
                    if ($('.ps-site-overlay') && $('.ps-site-overlay').hasClass("active")) {
                        $('.ps-site-overlay').removeClass("active");
                    }
                    $('.ps-filter--sidebar').removeClass("active");
                }
            });
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
                if (price != null) {
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

                if (price != null) {
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
            filterSlider('<?= $srch_prod_max_price ?>');
            filterSliderMobileAside('<?= $srch_prod_max_price ?>');
            get_srch_product_list();
            srch_sort_by_price();
            srch_sort_by_price_mobile();
        });
    </script>