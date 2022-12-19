<?php if (sizeof($search_result) != 0) : ?>
    <?php foreach ($search_result as $cat_p) : ?>
        <div class="ps-product ps-product--wide" data-id="<?php echo  $cat_p['id'] ?>">
            <div class="ps-product__thumbnail">
                <a href="{base_url}main/product/<?= $cat_p['id'] ?>">
                    <img class="prod_img_in_categ_by_list" src="<?= $cat_p['base_url'] ?>upload_product/<?= $cat_p['product_pic'] ?>" alt="">
                </a>
            </div>
            <div class="ps-product__container">
                <div class="ps-product__content"><a class="ps-product__title product_info_long" href="{base_url}main/product/<?= $cat_p['id'] ?>"><?= $cat_p['product_name'] ?></a>

                    <ul class="ps-product__desc">
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
                            </select><span class="review_count_bold"><b>(<?= $cat_p['review_count'] ?>)</b></span>
                            <div class="product_articule">
                                <p class="text-muted">Арт. <?= $cat_p['product_articule'] ?></p>
                            </div>
                        </div>
                        <ul class="ps-list--dot nobull">
                            <li> Действующее вещество (МНН):
                                <?php for ($i = 0; $i < sizeof($cat_p['active_substance']); $i++) : ?>
                                    <a href="#">
                                        <?= $cat_p['active_substance'][$i]['tag_name'] ?>
                                    </a><?php if (($i + 1) != sizeof($cat_p['active_substance'])) : ?>,
                                <?php endif; ?>
                            <?php endfor; ?>
                            </li>
                            <li> Производитель: <?= $cat_p['product_brand']['brand_name'] ?>
                            </li>
                            <li> Категория:
                                <?php for ($i = 0; $i < sizeof($cat_p['categories']); $i++) : ?>
                                    <a href="{base_url}main/categoryProducts/<?= $cat_p['categories'][$i]['id'] ?>">
                                        <?= $cat_p['categories'][$i]['category_name'] ?>
                                    </a><?php if (($i + 1) != sizeof($cat_p['categories'])) : ?>,
                                <?php endif; ?>
                            <?php endfor; ?>
                            </li>
                        </ul>
                    </ul>
                </div>
                <div class="ps-product__shopping">
                    <p class="ps-product__price product_long_format_price">
                        <span><?= $cat_p['product_price'] ?> <span>смн.</span></span>
                        <?php if ($cat_p['product_old_price'] != 0) : ?>
                            <del><?= $cat_p['product_old_price'] ?> смн.</del>
                        <?php endif; ?>
                    </p>
                    <?php
                    $char = "\"";
                    $charHtml = "&quot;";
                    ?>
                    <div class="favorite-cart_btn">
                        <label class="like-button likeClick">
                            <input value="<?php $cat_p['id'] ?>" <?php echo $cat_p['is_favorite'] == 1 ?  'checked' : null  ?> type="checkbox" id="red">
                            <svg id="shape" fill="none" data-id="<?= $cat_p['id']   ?>" data-like="0" class="likeClick" width="24" height="24" style="cursor: pointer; float: right;" viewBox="0 0 22 19" xmlns="http://www.w3.org/2000/svg">
                                <path class="seat" d="M6.20208 0.884277C3.51425 0.884277 1.33459 3.04155 1.33459 5.70309C1.33459 7.85159 2.1864 12.9508 10.5711 18.1054C10.7213 18.1968 10.8938 18.2452 11.0696 18.2452C11.2454 18.2452 11.4178 18.1968 11.568 18.1054C19.9527 12.9508 20.8045 7.85159 20.8045 5.70309C20.8045 3.04155 18.6249 0.884277 15.937 0.884277C13.2492 0.884277 11.0696 3.80477 11.0696 3.80477C11.0696 3.80477 8.8899 0.884277 6.20208 0.884277Z" stroke="#A8A8A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg><span class="like-span">в избранное</span>
                        </label>
                        <button class="ps-btn ps-btn-products" onclick="add_to_cart(
                                                '<?= $cat_p['id'] ?>',
                                                `<?= str_replace($char, $charHtml, $cat_p['product_name']) ?>`,
                                                '<?= $cat_p['product_old_price'] ?>',
                                                '<?= $cat_p['product_price'] ?>',
                                                '<?= $cat_p['product_brand']['id'] ?>',
                                                '<?= $cat_p['product_brand']['brand_name'] ?>',
                                                '<?= $cat_p['product_pic'] ?>',
                                                '<?= $cat_p['total_count_in_store'] ?>',
                                                '<?= $cat_p['product_articule'] ?>'
                                            )" style="background: #4a4ac3;">В корзину</button>
                    </div>

                    <ul class="ps-product__actions">
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h4 class="text-muted">Ничего не найдено...</h4>
<?php endif; ?>
<script>
    const __likeClicks = document.getElementsByClassName("likeClick")
    for (let i = 0; i < __likeClicks.length; i++) {
        __likeClicks[i].addEventListener('click', function() {
            this.setAttribute('id', 'shape');
            this.dataset.like === "0" ? (this.dataset.like = "1") : (this.dataset.like = "0");
            let isLike = Boolean(Number(this.dataset.like));
            let _like = window.getComputedStyle(this);
            console.log(_like.fill);
            if (localStorage.getItem("userId")) {
                if (_like.fill === "rgb(0, 0, 0)") {
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

                } else  if(_like.fill !== "rgb(0, 0, 0)"){
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

    document.getElementsByClassName('blog_about').offsetWidth / 100;
    if (document.querySelector(".ps-product__content i")) document.querySelector(".ps-product__content i").addEventListener("click", onAddBorder())


    onAddBorder();
</script>
<style>
    .like-button {
        border: 2px solid #A8A8A8;
        border-radius: 4px;
        background-color: #fff;
        display: flex;
        width: 186px;
        text-align: center;
        font-weight: 600;
        height: 45px;
        align-items: center;
        margin-bottom: 10px;
        cursor: pointer;
        justify-content: center;
    }

    .like-button svg {
        margin: 5px;
    }

    .like-span {
        font-size: 18px;
        font-weight: 500;
        color: #A8A8A8;
        padding: 0 5px;
    }

    label {
        display: block;
        background-color: none;
    }

    #red {
        display: none;
    }

    svg {
        width: 24px;
        display: block;

    }

    #shape {
        fill: "green";
        stroke: "black";
        stroke-width: 2;
    }

    #red:checked+svg #shape {
        fill: #DD2E44;
        stroke: #DD2E44;
    }

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