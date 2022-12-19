<div class="ps-breadcrumb">
    <div class="container">
        <div class="ps-container padding0">
            <ul class="breadcrumb ">
                <li><a href="{base_url}">Главная</a></li>
                <li>{sales_tag_name}</li>
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
                <aside class="widget widget_shop srch_sort_pr_aside">
                    <figure class="srch_sort_pr_figure">
                        <h4 class="widget-title">По цене</h4>
                        <div class="nonlinear"></div>
                        <p class="ps-slider__meta">
                            <span class="ps-slider__value slider__value_min">
                                <span class="ps-slider__min sales-ps-slider__min"></span> смн.</span>
                            <span class="ps-slider__value slider__value_max">
                                <span class="ps-slider__max sales-ps-slider__max"></span> смн.</span>
                        </p>
                        <div style="text-align: center" class="mt-5">
                            <button class="btn btn-info btn-lg sales_res_sort_by_price" style="width: 100%;" type="button">Показать</button>
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
                <div class="ps-shopping-product sales_res_products">

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

<script>
    var max_count_reached = false;
    var page = 1;
    var min_pr = null;
    var max_pr = null;
    var sales_id = '{sales_id}';


    function get_sales_product_list(id, min_price = '', max_price = '') {
        $('#loading').css('display', 'block');
        $.getJSON("{base_url}index.php/main/get_sales_prods?" +
            "sales_id=" + id +
            "&page=" + page +
            "&min_price=" + min_price +
            "&max_price=" + max_price,
            function(data, status) {
                min_pr = data.prod_max_price;
                $(".sales_res_products").html(data.html);
                $('#loading').css('display', 'none');
                rating();
            });
    }

    function sales_sort_by_price() {

        min_pr = $(".ps-slider__min").text();
        max_pr = $(".ps-slider__max").text();

        $('.sales_res_sort_by_price').on('click', function() {
            page = 1;
            min_pr = $(".ps-slider__min").text();
            max_pr = $(".ps-slider__max").text();
            get_sales_product_list(sales_id, min_pr, max_pr);
        });
    }

    function sales_sort_by_price_mobile() {

        min_pr = $(".ps-slider__min_mobile").text();
        max_pr = $(".ps-slider__max_mobile").text();

        $('.sort_by_price_mobile').on('click', function() {
            page = 1;
            min_pr = $(".ps-slider__min_mobile").text();
            max_pr = $(".ps-slider__max_mobile").text();
            get_sales_product_list(sales_id, min_pr, max_pr);
        });
    }

    function topage(p) {
        page = p;
        get_sales_product_list(sales_id, min_pr, max_pr);
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
        filterSlider('<?= $prod_max_price ?>');
        filterSliderMobileAside('<?= $prod_max_price ?>');
        get_sales_product_list(sales_id, min_price = '', max_price = '');
        sales_sort_by_price();
        sales_sort_by_price_mobile();
    });
</script>