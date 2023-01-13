<div id="homepage-3">
    <div class="ps-breadcrumb">
        <div class="container">
            <div class="ps-container category-products_breadcrumb padding">
                <ul class="breadcrumb ">
                    <li><a href="{base_url}index.php/main">Главная </a></li>
                    <li>
                        <a href="{base_url}main/blogpopular">Блог </a>
                    </li>
                    <li>
                        Семь основных причин, почему вакцинироваться должен каждый </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="ps-section--gray">

        <div class="container">
            <div class="ps-block--products-of-category blog-articles bg-blog_transparent">
                <div class="bi-left-sidebar sticky col-lg-2 col-md-10 col-sm-12 col-xs-12 pt-3" id='js-bi-left-sidebar'>
                    <h2>Похожие статьи</h2>

                </div>
                <div class="bi-right-sidebar col-lg-10 col-md-9 col-sm-12 col-xs-12 p-4">
                    <div class="bloginfo-imgs ">

                    </div>
                    <h3 class="blog_title"> </h3>
                    <span class="blog_created_at"></span>
                    <p class="text-justify blog_about-full"> </p>
                    <div class="blog-articles-btn">
                        <a href="https://www.t.me/Salomat9990" target="_blank">
                            <img src="{base_url}img/telegram.svg" alt=""></a>
                        <a href="salomat.tj" target="_blank">
                            <img src="{base_url}img/facebook.svg" alt=""></a>
                        <a href="https://www.instagram.com/salomat.tj" target="_blank">
                            <img src="{base_url}img/instagram.svg" alt=""></a>

                        <a href="https://salomat.tj" target="_blank">
                            <img src="{base_url}img/link.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container bi_recomend-product" style="background-color: #fff; padding: 20px; margin-bottom: 3rem; border-radius: 5px; min-height: 520px;">
            <div class="ps-section__header pb-5">
                <h3>Рекоммендуемые товары</h3>
                <hr>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($prods_suggestions as $prod_sugg) : ?>
                        <div class="main-ps-product " data-id="<?php echo  $prod_sugg['id'] ?>">
                            <div class=" ps-product ps-product--inner ps-product_of_the_day">
                                <label class="main-like_btn">
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
                                        <p class="ps-product__price sale prods_slider"> <span class="ps-product__price-span ">
                                                <input class="form-control height50" id="count_input" type="number" value="1" style="display: none;">
                                                <?php if ($prod_sugg['product_old_price'] != 0) : ?><del><?= $prod_sugg['product_old_price'] ?> </del><?php endif; ?>
                                                <?= $prod_sugg['product_price'] ?>c. </span><button onclick='addToCart(res = <?= json_encode($prod_sugg) ?>)' class="ps-btn btn-cart_cat">В корзину</button>
                                        </p>
                                        <p class="ps-product__price sale prods_slider">
                                                <button onclick='addToCart(res = <?= json_encode($prod_of_the_day) ?>)' class="btn-cart_cat-none" style="background-color: #ef5d70; height: 36px; color: #fff; border: none; border-radius: 5px; width: 85%;">Нет в наличии</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
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

    function getBlog() {
        const blog_id = window.location.search.substr(window.location.search.length - 1, 1)
        $.ajax({
            type: "GET",
            url: `{base_url}blogs/blog?blog_id=${blog_id}`,
            headers: {
                "Accept": "application/json",
            },
            success: function(blogShow) {

                $(".blog_created_at").text(blogShow.blog.blog_created_at.slice(0,10));
                $(".blog_title").text(blogShow.blog.blog_title);
                $(".blog_about-full").html(blogShow.blog.blog_about);
                blogShow.blog.blog_pics.forEach((elem) => {
                    const img = document.createElement("img");
                    img.className += "blog_pic"
                    img.src = "{base_url}upload_blog/" + elem.blog_pic;
                    $(".bloginfo-imgs").append(img);
                    getTags(blogShow.tags[0].tag_id, blog_id);
                })
            }
        })

    }
    getBlog();

    function getTags(tag, blogId) {
        $.ajax({
            type: "POST",
            url: `{base_url}/blogs/blog_tag`,
            headers: {
                "Accept": "application/json",
            },
            data: {
                tag_id: [tag],
                page: 1
            },
            success: function(blogShow) {
                const filtered = blogShow.blogs.filter(elem => elem.id !== blogId);
                filtered.forEach(elem => {
                    document.querySelector(".bi-left-sidebar").innerHTML += `
                      <div class="blog-articles-mini">
                        <a href="{base_url}main/blogInfo?blog_id=${elem.blog_id}">
                            <h3>${elem.blog_title}</h3>
                            <span>${elem.blog_created_at.slice(0,10)}</span>
                        </a>
                    </div>
                      
                      `
                })
            }
        })
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
    .blog-articles-btn a {
        padding-right: 15px;
    }
</style>