<div class="ps-tabs">
    <div class="ps-tab active" id="tab-1">
        <div class="ps-shopping-product">
            <div class="row gap-dn" style="gap: 10px;">
                <?php foreach ($total_products['total_prods'] as $cat_p) : ?>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 p-0 ps-product--inner-sales" data-id="<?php echo  $cat_p['id'] ?>">
                        <div class=" ps-product ps-product--inner ps-product_of_the_day">
                            <label class="main-like_btn">
                                <input value="<?php $cat_p['id'] ?>" <?php echo $cat_p['is_favorite'] == 1 ?  'checked' : null  ?> type="checkbox" id="red">
                                <svg id="shape" fill="none" data-id="<?= $cat_p['id']   ?>" data-like="0" class="likeClick" width="24" height="24" style="cursor: pointer; float: right;" viewBox="0 0 22 19" xmlns="http://www.w3.org/2000/svg">
                                    <path class="seat" d="M6.20208 0.884277C3.51425 0.884277 1.33459 3.04155 1.33459 5.70309C1.33459 7.85159 2.1864 12.9508 10.5711 18.1054C10.7213 18.1968 10.8938 18.2452 11.0696 18.2452C11.2454 18.2452 11.4178 18.1968 11.568 18.1054C19.9527 12.9508 20.8045 7.85159 20.8045 5.70309C20.8045 3.04155 18.6249 0.884277 15.937 0.884277C13.2492 0.884277 11.0696 3.80477 11.0696 3.80477C11.0696 3.80477 8.8899 0.884277 6.20208 0.884277Z" stroke="#A8A8A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label>
                            <div class="ps-product__thumbnail ps-product__thumbnail_img_div  hover01">
                                <a href="<?= $base_url ?>index.php/main/product/<?= $cat_p['id'] ?>?from=main">
                                    <img class="imgs" src="<?= $base_url ?>upload_product/<?= $cat_p['product_pic'] ?>" alt="Product IMG">
                                </a>
                            </div>
                            <div class="ps-product__container">
                                <div class="ps-product__content"><a class="ps-product__title product_title_new" href="<?= $base_url ?>index.php/main/product/<?= $cat_p['id'] ?>">
                                        <?= $cat_p['product_name'] ?></a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <?php if ($cat_p['review_count'] != 0) : ?>
                                                <?php for ($i = 1; $i <= $cat_p['prod_rating_average']; $i++) : ?>
                                                    <option value="1"></option>
                                                <?php endfor; ?>
                                                <?php for ($i = ($cat_p['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                        </select><span>(<?= $cat_p['review_count'] ?>)</span>
                                    </div>
                                    <p class="ps-product__price sale prods_slider"> <span class="ps-product__price-span ">
                                            <input class="form-control height50" id="count_input" type="number" value="1" style="display: none;">
                                            <?php if ($cat_p['product_old_price'] != 0) : ?><del><?= $cat_p['product_old_price'] ?> </del><?php endif; ?>
                                            <?= $cat_p['product_price'] ?>c. </span><button onclick='addToCart(res = <?= json_encode($cat_p) ?>)' class="ps-btn btn-cart_cat">В корзину</button>

                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
        <div class="ps-pagination">
            <ul class="pagination">
                <?php if (isset($total_products['prev_page'])) : ?>
                    <li><a href="javascript:topage(<?= $total_products['prev_page'] ?>)">
                            <i class="icon-chevron-left" style="margin-right:4px;margin-left:0;"></i><span class="dnone-text_btn">Пред. стр.</span></a></li>
                <?php endif; ?>
                <?php foreach ($total_products['pages'] as $page) : ?>
                    <li class="<?= $page['current'] ?>"><a href="javascript:topage(<?= $page['page'] ?>)"><?= $page['page'] ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($total_products['next_page'])) : ?>
                    <li><a href="javascript:topage(<?= $total_products['next_page'] ?>)"><span class="dnone-text_btn">След. стр.</span><i class="icon-chevron-right"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<script>
    $('.sort_by_price, .sort_by_price_mobile').click(function() {
        $('.sort_by_price, .sort_by_price_mobile').css({
            'cssText': 'background: #18A1A1 !important;outline:none !important'
        })
    });

    var __likeClicks = document.getElementsByClassName("likeClick")
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

    function decrease_count() {
        $('#decrease_count').on('click', function() {
            count--;
            if (count < 1) {
                count = 1;
            }
            $('#count_input').val(count);
        })
    }

    function increase_count() {
        $('#increase_count').on('click', function() {
            // if (count < total_count_global) {
            count++;
            // }
            $('#count_input').val(count);
        })
    }

    function change_count() {
        $('#count_input').change(function() {
            if ($('#count_input').val() > 0) {
                count = $('#count_input').val();
            } else {
                count = 1;
                $('#count_input').val(count);
            }
            // else if ($('#count_input').val() < 1 || Number($('#count_input').val()) == 0)
        })
    }

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
        var total_count = res.product_total_count;
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
                        elem.product_count += count;

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
                onAddBorder()

            } else {
                array.push(obj);
                // $.cookie("product_list", JSON.stringify(array), {
                //     path: '/'
                // });
                localStorage.setItem("product_list", JSON.stringify(array))
                onAddBorder()

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
    document.getElementsByClassName('blog_about').offsetWidth / 100;
    if (document.querySelector(".ps-product__content i")) document.querySelector(".ps-product__content i").addEventListener("click", onAddBorder())


    onAddBorder();
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