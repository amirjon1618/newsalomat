<div class="enter-btn-password" style="display: none;">
    <div class="enter-btn-modal">
        <div class="page-content">
            <div class="form-v8-content">
                <div class="enter-form_pass">
                    <div class="tab">
                        <div class="tab-inner">
                            <h3 class="tablinks text-center">Ваш пароль изменён!</h3>
                        </div>
                    </div>
                    <form class="form-detail">
                        <div class="tabcontent" id="sign-pass">
                            <div class="form-row-last d-flex justify-content-center">
                                <a href="#user-info" id="ok-btn" class="ok-btn" onclick="javascript:window.location.hash = '#user-save';window.location.reload()">OK</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="enter-btn-phone">
    <div class="enter-btn-modal">
        <div class="page-content">
            <div class="form-v8-content">
                <div class="enter-form_pass">
                    <div class="tab">
                        <div class="tab-inner">
                            <h3 class="tablinks text-center">Ваш номер изменён!</h3>
                        </div>
                    </div>
                    <form class="form-detail">
                        <div class="tabcontent" id="sign-phone">
                            <div class="form-row-last d-flex justify-content-center">
                                <a href="#user-info" id="ok-btn" class="ok-btn" onclick="javascript:window.location.hash = '#phone-number';window.location.reload()">OK</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="homepage-3">
    <div class="ps-breadcrumb">
        <div class="container">
            <div class="ps-container category-products_breadcrumb padding">
                <ul class="breadcrumb ">
                    <li><a href="{base_url}index.php/main">Главная </a></li>
                    <li>
                        Личная страница </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="forms-blocks">
        <section class="section-forms section-tabs">
            <div class="container my-5">
                <div class="user-info">
                    <div class="up-left-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12 p-0">
                        <ul class="user-info_ul nav nav-pills dragscroll" id="myTab" role="tablist">
                            <li class="nav-item5" role="presentation"><a id="webdisign-tab0" data-toggle="tab" href="#user-info" data-hash="#user-info" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-user.svg" alt="Icon">Личная информация</a></li>
                            <li class="nav-item5" role="presentation"><a id="webdisign-tab1" data-toggle="tab" href="#user-order" data-hash="#user-order" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-cart.svg" alt="Icon">Мои заказы</a></li>
                            <li class="nav-item5" role="presentation"><a id="webdisign-tab2" data-toggle="tab" href="#user-favorite" data-hash="#user-favorite" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-like.svg" alt="Icon">Избранное</a></li>
                            <li class="nav-item5" role="presentation"><a id="webdisign-tab3" data-toggle="tab" href="#user-save" data-hash="#user-save" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-save.svg" alt="Icon">Безопасность</a></li>
                            <li class="nav-item5" role="presentation"><a id="webdisign-tab4" data-toggle="tab" href="#phone-number" data-hash="#phone-number" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/header-phone.svg" alt="Icon" width="34px">Изменит телефон</a></li>
                            <li class="nav-item5" role="presentation"><a class="userinfo-exit_btn" style="color: #A8A8A8;" href="/" onclick="onRemoveLS()">Выход</a></li>
                        </ul>
                    </div>
                    <?php if (isset($auth)) : ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show" data-hash="#user-info" id="user-info" role="tabpanel" aria-labelledby="webdisign-tab">
                                <div class="up-content col-lg-6 col-md-6 col-sm-12 col-xs-12 p-4 mb-3">
                                    <div class="up-content-info">
                                        <h2 class="pb-3">Личная информация</h2>
                                        <form action="{base_url}users/update_user_web" method="post" class="up-content-info_form">
                                            <div class="form-input col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group form-col">
                                                    <label>Имя Фамилия <span class="red-star">*</span></label>
                                                    <input class="form-control" maxlength="24" required name="name" value="<?php echo $name ?>" id="order_name" type="text" placeholder="Имя Фамилия">
                                                </div>
                                                <div class="form-col">
                                                    <label for="validationCustom02">Номер телефона <span class="red-star">*</span></label>
                                                    <input type="tel" title="Изменить номер телефона на вкладке (Изменить телефон)" class="form-control" id="validationCustom02" readonly name="login" placeholder="+992 XXX XX XX XX" required value="<?php echo $phone ?>">
                                                </div>
                                                <div class="form-col">
                                                    <label for="validationCustom03">Пол</label>
                                                    <select class="custom-select" name="gender">
                                                        <?php if ($gender == 'male') : ?>
                                                            <option selected value="male">Мужской</option>
                                                            <option value="female">Женский</option>
                                                        <?php elseif ($gender == 'famale') : ?>
                                                            <option selected value="female">Женский</option>
                                                            <option value="male">Мужской</option>
                                                        <?php else : ?>
                                                            <option selected value="female">Женский</option>
                                                            <option value="male">Мужской</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-col">
                                                    <label for="validationCustom01">Дата рождения</label>
                                                    <input type="date" class="form-control" id="validationCustom01" name="birth_date" value="<?php echo $birth_date ?>">

                                                    <div class="valid-feedback">
                                                        Правильно!
                                                    </div>
                                                </div>
                                                <div class="form-col">
                                                    <label for="validationCustom02">Электронная почта</label>
                                                    <input type="text" class="form-control" id="validationTooltipUsername" name="email" placeholder="youraddress@mail.ru" aria-describedby="validationTooltipUsernamePrepend" value="<?php echo $email ?>">
                                                </div>
                                                <div class="form-col">
                                                    <label for="validationCustom03">Адресс <span class="red-star">*</span></label>
                                                    <input type="text" class="form-control" id="validationTooltiAddress" name="address" placeholder="А.Навои 34/2" aria-describedby="validationTooltipAddress" value="<?php echo $address ?>" required>
                                                </div>
                                            </div>
                                            <button class="form-btn my-4 mx-3">Сохранить</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="up-right-sidebar col-lg-2 col-md-2 col-sm-12 col-xs-12 p-4">
                                    <div class="text-center">
                                        <img src="{base_url}user_img/<?php echo $image ?? 'user.png' ?>" alt="Icon" id="user_icon1" class="rounded-circle user_icon" style="width: 100px; height: 100px;">
                                        <form class="form-del" enctype="multipart/form-data">
                                            <div class="input__wrapper">
                                                <input name="file" type="file" name="file" id="input__file" class="input input__file" onchange="uploadIMG(this)" multiple>
                                                <label for="input__file" class="input__file-button mt-5 ">
                                                    <span class="input__file-button-text ">Сменить фото</span>
                                                </label>
                                            </div>
                                            <div class="del-photo" onclick="delPhoto()">
                                                <span class="text-del text-danger btn">Удалить фото</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" data-hash="#user-order" id="user-order" role="tabpanel" aria-labelledby="webdisign-tab">
                                <div class="up-content col-lg-8 col-md-8 col-sm-12 col-xs-12 p-4">
                                    <div class="table-title">
                                        <h2 class="pb-5">Мои заказы</h2>
                                    </div>
                                    <?php if (!empty($orders)) : ?>
                                        <?php foreach ($orders as $order) : ?>
                                            <div class="table-content">
                                                <table class="table table-borderless" style="border-collapse:collapse;">
                                                    <thead>
                                                        <tr style="border-bottom: 1px solid #E5E5E5;">
                                                            <th></th>
                                                            <th>Дата</th>
                                                            <th>Статус</th>
                                                            <th>Итого</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr data-toggle="collapse" class="accordion-toggle">
                                                            <td class="table-id"><?php echo $order['order']->id; ?></td>
                                                            <td><?php echo $order['order']->created_at;
                                                                $price = 0;  ?></td>

                                                            <td style="width: 170px;"><span class="label" style="display: flex; justify-content: center; padding: 5px 0px;color: #fff; display: flex; text-align: center; background:<?php
                                                                                                                                                                                                                                        if ($order['status'][0]->status_text == 'В ожидании') {
                                                                                                                                                                                                                                            echo '#ffcc00';
                                                                                                                                                                                                                                        };
                                                                                                                                                                                                                                        if ($order['status'][0]->status_text == 'Доставлен') {
                                                                                                                                                                                                                                            echo '#18e364';
                                                                                                                                                                                                                                        };
                                                                                                                                                                                                                                        if ($order['status'][0]->status_text == 'Отменен') {
                                                                                                                                                                                                                                            echo '#eb1414';
                                                                                                                                                                                                                                        };
                                                                                                                                                                                                                                        if ($order['status'][0]->status_text == 'Не подтвержён') {
                                                                                                                                                                                                                                            echo '#c4c4c4';
                                                                                                                                                                                                                                        };
                                                                                                                                                                                                                                        if ($order['status'][0]->status_text == 'На обработку') {
                                                                                                                                                                                                                                            echo '#9814eb';
                                                                                                                                                                                                                                        };

                                                                                                                                                                                                                                        ?>; border-radius:.5em"><?= $order['status'][0]->status_text; ?></span></td>
                                                            <!-- <td><span class="status-delivered"><?php echo $order['status'][0]->status_text; ?></span></td> -->
                                                            <?php foreach ($order['products'] as $product) : ?>
                                                                <?php $price = $price + $product->product_sold_price ?>
                                                            <?php endforeach; ?>
                                                            <td class="text-success"><?php echo $order['order']->total_price ?></td>

                                                            <td><img src="{base_url}img/arrow-down.svg" alt="Icon"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" class="hiddenRow">
                                                                <div class="accordian-body collapse" id="demo1">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>

                                                                                <td colspan="6" class="hiddenRow">
                                                                                    <div class="accordian-body collapse" id="demo1">
                                                                                        <table class="table">
                                                                                            <?php foreach ($order['products'] as $product) : ?>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row"><img class="tbody-cart" style="max-width: 100px" src="{base_url}upload_product/<?php echo $product->product_pic; ?>" alt="IMG"></th>
                                                                                                        <td class="align-middle" style="color: #4839C3; font-weight: 500;"><?php echo $product->product_name; ?></td>
                                                                                                        <td class="align-middle"><?php echo $product->total_count; ?> шт</td>
                                                                                                        <td class="align-middle"><?php echo $product->product_sold_price; ?> смн.</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            <?php endforeach; ?>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                        </tbody>
                                                                        <tbody>
                                                                            <tr class="order-total-price">
                                                                                <td style="font-size: 16px; color: #000; font-weight: 500;">Стоимост товаров: </td>
                                                                                <td class="font-weight-bold" style="color: #000; font-weight: 500;"><?php echo $price; ?><span style="color: #4839C3; font-weight: 400;"> смн</span></td>
                                                                                <td style="font-size: 16px; color: #000; font-weight: 500;">Итого: </td>
                                                                                <td class="font-weight-bold" style="color: #000; font-weight: 500;"><?php echo $order['order']->total_price; ?><span style="color: #4839C3; font-weight: 400;"> смн</span></td>
                                                                            <tr>
                                                                                <td>Стоимост доставки: </td>
                                                                                <td class="font-weight-bold" style="color: #000; font-weight: 500;"><?php echo $order['delivery'][0]->delivery_price; ?><span style="color: #4839C3; font-weight: 400;"> смн</span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                </table>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tbody>
                                            <tr>
                                                <td>Заказов нет! </td>
                                            </tr>
                                        </tbody>
                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
                            </div>

                            <div class="tab-pane fade show" data-hash="#user-favorite" id="user-favorite" role="tabpanel">

                                <div class="up-content col-lg-8 col-md-8 col-sm-12 col-xs-12 p-3" id="favorite-parent">

                                    <div class="favorite-title pb-5">
                                        <h2 class="border-bottom pb-4">Избранное</h2>
                                    </div>

                                    <?php if (isset($auth) && !empty($favorites)) : ?>
                                        <?php foreach ($favorites as $favorite) : ?>

                                            <div class="favorite-content" data-favoriteid="<?= $favorite['id'] ?>">
                                                <div class="col-xs-3 col-lg-3 col-md-6 col-sm-6 favorite-cc ps-product--inner-sales" data-id="<?php echo  $favorite['id'] ?>" style="margin: 0 10px 10px 0;">
                                                    <div class="ps-product ps-product--inner ps-product_of_the_day user-info_favorite">
                                                        <label>
                                                            <input onclick="deleteProduct(<?= $favorite['id'] ?>)" value="<?php $favorite['id'] ?>" <?php echo $favorite['id']  ?  'checked' : null  ?> type="checkbox" id="red">
                                                            <svg class="confirmation" id="shape" fill="none" data-id="<?= $favorite['id']   ?>" data-like="0" class="likeClick" width="24" height="24" style="cursor: pointer; float: right;" viewBox="0 0 22 19" xmlns="http://www.w3.org/2000/svg">
                                                                <path class="seat" d="M6.20208 0.884277C3.51425 0.884277 1.33459 3.04155 1.33459 5.70309C1.33459 7.85159 2.1864 12.9508 10.5711 18.1054C10.7213 18.1968 10.8938 18.2452 11.0696 18.2452C11.2454 18.2452 11.4178 18.1968 11.568 18.1054C19.9527 12.9508 20.8045 7.85159 20.8045 5.70309C20.8045 3.04155 18.6249 0.884277 15.937 0.884277C13.2492 0.884277 11.0696 3.80477 11.0696 3.80477C11.0696 3.80477 8.8899 0.884277 6.20208 0.884277Z" stroke="#A8A8A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </label>

                                                        <div class="ps-product__thumbnail ps-product__thumbnail_img_div  hover01">
                                                            <a href="{base_url}index.php/main/product/2997?from=main">
                                                                <img class="imgs" src="{base_url}upload_product/<?php echo $favorite['product_pic'] ?>" alt="">
                                                            </a>
                                                        </div>

                                                        <div class="ps-product__container">
                                                            <div class="ps-product__content"><a class="ps-product__title product_title_new" href="{base_url}index.php/main/product/2997">
                                                                    <?php echo $favorite['product_name'] ?></a>
                                                                <div class="ps-product__rating">
                                                                    <select class="ps-rating" data-read-only="true">

                                                                        <?php if (!isset($favorite['review_count'])) : ?>
                                                                            <?php for ($i = 1; $i <= $favorite['prod_rating_average']; $i++) : ?>
                                                                                <option value="1"></option>
                                                                            <?php endfor; ?>
                                                                            <?php for ($i = ($favorite['prod_rating_average'] + 1); $i <= 5; $i++) : ?>
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
                                                                    </select><span>(1)</span>
                                                                </div>
                                                                <p class="ps-product__price sale prods_slider"> <span class="ps-product__price-span price-span_favorite">
                                                                        <input class="form-control height50" id="count_input" type="number" value="1" style="display: none;">
                                                                        <?php if ($favorite['product_old_price'] != 0) : ?><del><?= $favorite['product_old_price'] ?> </del><?php endif; ?>
                                                                        <?= $favorite['product_price'] ?>c. </span><button onclick='addToCart(res = <?= json_encode($favorite) ?>)' class="ps-btn btn-cart_cat">В корзину</button></p>

                                                            </div>
                                                            <div class="product_add_notification_div" style="display: none;">
                                                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                                <span class="prod_add_notification_text">"<span class="span_added_prod_name"></span>" успешно добавлен в вашу корзину.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade show" data-hash="#user-save" id="user-save" role="tabpanel">
                                <div class="up-content col-lg-8 col-md-8 col-sm-12 col-xs-12 p-3">
                                    <div class="user-save-title mb-5">
                                        <h2>Безопасность</h2>
                                    </div>
                                    <?php if (isset($auth)) : ?>
                                        <div class="user-save-content">
                                            <form class="up-content-info_pass" id="changePass">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-col col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                                        <label for="exampleInputPassword1">Пароль*</label>
                                                        <input type="password" class="form-control form-control-save error" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" title="только английские буквы и цифры" name="password" id="first-validate" placeholder="Введите новый пароль" required>
                                                    </div>
                                                    <div class="form-col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <label for="exampleInputPassword2">Повторите пароль*</label>
                                                        <input type="password" class="form-control form-control-save error" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" title="только английские буквы и цифры" name="password_confirm" id="second-validate" placeholder="Введите повторно пароль" required>
                                                    </div>
                                                    <p class="validate-text validate-text4"></p>

                                                    <button class="form-btn my-4 mx-3">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade show" data-hash="#phone-number" id="phone-number" role="tabpanel">
                                <div class="up-content col-lg-5 col-md-5 col-sm-12 col-xs-12 p-3">
                                    <div class="user-phone-title mb-5">
                                        <h2>Изменит телефон</h2>
                                    </div>
                                    <div class="user-phone-content">
                                        <form class="up-content-info_form" id="changePhone">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-col col-lg-12 col-md-12 col-sm-12 col-xs-12" id="save-form">
                                                    <label for="validationCustom02">Новый номер*</label>
                                                    <span class="phone-mask-cabinet">+992</span>
                                                    <input type="number" style="padding-left: 50px" maxlength="9" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" id="validationPhone" name="login" placeholder="Введите свой номер без +992" required value="<?php echo $phone ?>">
                                                    <button class="form-btn my-4">Изменить</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script defer src="/js/dragscroll.js"></script>
<script src="{base_url}plugins/jquery.form.validation.min.js"></script>
<script src="{base_url}js/jquery.validate.min.js"></script>
<script src="{base_url}js/form_validation_messages_ru.js"></script>

<script>
    $('.confirmation').on('click', function() {

        return confirm('Вы уверены что хотите удалить?');

    });

    function validate_chekout() {


        $('.up-content-info_form').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 80,
                    minlength: 3
                }
            },

        });
    }
    validate_chekout();


    $(".up-content-info_pass").on('submit', () => {
        $(".enter-btn-password").css("display", "block")
    })

    function onRemoveLS() {
        localStorage.removeItem("userId");
        $.ajax({
            type: "GET",
            url: "{base_url}/users/web_log_out",
            headers: {
                "Accept": "application/json",
            }
        })
    }

    $("#second-validate").on('input', () => {
        if ($("#second-validate").val() !== $("#first-validate").val()) {
            $(".validate-text").text("Пароли не совпадают");
        } else {
            $(".validate-text").text("");
        }
    })
    $("#first-validate").on('input', () => {
        if ($("#first-validate").val() !== $("#second-validate").val()) {
            $(".validate-text").text("Пароли не совпадают");
        } else {
            $(".validate-text").text("");
        }
    })

    $("#changePhone").on("submit", (e) => {
        e.preventDefault()
        if ($("#validationPhone").val() !== localStorage.getItem("ver-number")) {
            onPsBlockRight();
            $(".efr1").css("display", "none");
            $(".efr8").css("display", "block");
            userTimer();
            localStorage.setItem("ver-number", Number($("#validationPhone").val()))
            $.ajax({
                type: "POST",
                url: "{base_url}/users/resend_sms",
                headers: {
                    "Accept": "application/json",
                },
                data: {
                    phone: Number(localStorage.getItem("ver-number"))
                },
                success(result) {
                    localStorage.setItem("res-sms", result);

                }
            })

        }
    })
    $("#changePass").on("submit", (e) => {
        e.preventDefault()
    })

    function deleteProduct(id) {
        const favoriteId = document.querySelector(`[data-favoriteid="${id}"]`);
        const parent = document.getElementById('favorite-parent');
        parent.removeChild(favoriteId);
    }
    // document.getElementById("user_icon").src = localStorage.getItem("user_icon");

    // if (localStorage.getItem("userId") !== null) {
    //     document.getElementById("user_icon").src = localStorage.getItem("user_icon");
    // } else document.getElementById("user_icon").src = localStorage.getItem("user_icon").src = "{base_url}img/user.png"
    let imgVal;
    async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },

            body: data // body data type must match "Content-Type" header
        });
        return await response.json(); // parses JSON response into native JavaScript objects
    }

    function uploadIMG(e) {
        // console.dir(e.files[0].path);
        // var formdata = new FormData();
        // formdata.append("img", e.files[0], "url");
        // var fReader = new FileReader();
        // fReader.readAsDataURL(e.files[0]);
        // fReader.onloadend = function(event) {
        //     localStorage.setItem("user_icon", event.target.result);
        //     document.querySelector("#user_icon").src = localStorage.getItem("user_icon");
        const myFile = document.getElementById("input__file");
        var form = new FormData();
        form.append("img", myFile.files[0], `${myFile.files[0].name}`);
        form.append("user_id", JSON.parse(localStorage.getItem("userId")).user_id);
        var requestOptions = {
            method: 'POST',
            body: form,
            redirect: 'follow'
        };
        fetch("{base_url}users/user_img?=save", requestOptions)
            .then(response => response.json())
            .then(result => {
                window.location.reload()
            })
    }
    // window.location.reload();


    function delPhoto() {
        $.ajax({
            type: "POST",
            url: "{base_url}users/deletePhoto",
            headers: {
                "Accept": "application/json",
            },
            data: {
                image: 'user.png',
                id: JSON.parse(localStorage.getItem("userId")).user_id,
            },
            success: function(data) {
                if (data == true) { // if true (1)
                    setTimeout(function() { // wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 100);
                }
            }
        })
    }

    $(document).ready(function() {
        var os = '<?php if (isset($os)) echo $os; ?>';
        if (os == 1) {
            $('.toast_success').toast({
                delay: 2500
            });
            $('.toast_success').toast('show');
        }
    });
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
                document.querySelector(".enter-btn-phone").style.display = "flex";
                document.querySelector(".enter-btn-phone").classList.add("active-animation");
                document.querySelector(".enter-btn-phone").classList.remove("disactive-animation");
            }
        })
    }
    const __toggles = document.getElementsByClassName("accordion-toggle");
    for (let i = 0; i < __toggles.length; i++) {
        __toggles[i].addEventListener('click', function() {
            this.classList.toggle("user-active");
        })
    }


    const __hash = Array.from(document.querySelectorAll(".user-info_ul a"));
    const __tab = Array.from(document.querySelectorAll(".tab-pane"));

    __tab.forEach(elem => {
        if (window.location.hash === elem.dataset.hash) {
            elem.classList.add("active");
        }
    })

    __hash.forEach(el => {
        if (window.location.hash === el.dataset.hash) {
            el.parentElement.classList.add("nav-item");
        } else {
            el.parentElement.classList.remove("nav-item");
        }
    })


    $(".user-info_ul a").on("click", function() {
        window.location.hash = this.dataset.hash;
        __hash.forEach(el => {
            if (window.location.hash === el.dataset.hash) {
                el.parentElement.classList.add("nav-item")
            }
            if (window.location.hash !== el.dataset.hash) {
                el.parentElement.classList.remove("nav-item");
            }
        })
    });

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

    .nav-item {
        background: rgba(188, 189, 255, 0.2);
        border-radius: 4px 4px 0px 0px;
        border-right: 3px solid #4839C3;
    }

    .user-active+tr div {
        display: block !important;
        background: #F9F9F9;
        border-radius: 5px;
    }

    .table-content tr {
        border-bottom: none;
    }

    .order-total-price {
        border-top: 1px solid #E5E5E5;
    }
</style>