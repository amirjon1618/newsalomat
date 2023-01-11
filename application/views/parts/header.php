<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?php if (isset($meta_social_title)) : ?>
        <meta property="og:title" content="{meta_social_title}">
    <?php else : ?>
        <meta property="og:title" content="Купить лекарства онлайн">
    <?php endif; ?>

    <?php if (isset($meta_social_image)) : ?>
        <meta property="og:image" content="{meta_social_image}" />
    <?php else : ?>
        <meta property="og:image" content="{base_url}salomat_apteka.jpg" />
    <?php endif; ?>
    <?php if (isset($meta_social_desc)) : ?>
        <meta property="og:description" content="{meta_social_desc}">
    <?php else : ?>
        <meta property="og:description" content="Более 5 000 лицензионных препаратов имеющие соответствующие сертификаты">
    <?php endif; ?>
    <meta property="og:image:height" content="50" />
    <meta property="og:image:width" content="180" />

    <meta name="twitter:card" content="summary_large_image">
    <title>{title}</title>
    <link rel="stylesheet" href="{base_url}css/style.css">
    <link rel="stylesheet" type="text/css" href="{base_url}src/slider/css/style.css">
    <link rel="stylesheet" type="text/css" href="{base_url}css/vendor.css">
    <link rel="stylesheet" type="text/css" href="{base_url}src/fonts/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{base_url}src/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="{base_url}src/vertical-timeline/css/component.css">
    <link rel="stylesheet" type="text/css" href="{base_url}css/css/screen.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{base_url}plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{base_url}fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="{base_url}plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="{base_url}plugins/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{base_url}plugins/owl-carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{base_url}plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="{base_url}plugins/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="{base_url}plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="{base_url}plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="{base_url}plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{base_url}css/market-place-1.css">

    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/kendo.common.min.css">
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/upload.less">
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/kendo.default-v2.min.css">
    <link rel="stylesheet" href="{base_url}plugins/kendo-upload-ui/css/font-icons.less">
    <link rel="stylesheet" href="{base_url}css/custom.css">

    <script src="{base_url}plugins/jquery-3.4.1.min.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <script src="//code.jivosite.com/widget/cGu9Dr4lZj" async></script>


    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(62780059, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            ecommerce: "dataLayer"
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/62780059" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162533742-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-162533742-1');
    </script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NRB31HKF0L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NRB31HKF0L');
    </script>


    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TFMLHJS');
    </script>
    <!-- End Google Tag Manager -->


</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFMLHJS" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="enter-btn-bg">
        <div class="enter-btn-modal">
            <div class="page-content">
                <div class="form-v8-content">
                    <div class="enter-form" style="display: none;">
                        <div class="close-form_btn" onclick="onConfirm()">
                            <img src=" {base_url}img/plus-close_form.svg" alt="X">
                        </div>
                        <div class="registration-form">
                            <div class="enter-form_reg efr1">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Вход или регистрация</h3>
                                    </div>
                                </div>
                                <form id="form1" class="form-detail" method="post">
                                    <div class="tabcontent" id="sign-phone">
                                        <div class="form-row">
                                            <span class="text-label">Телефон</span>
                                            <label class="form-row-inner recipe_phone_div_inp recipe_phone_span">
                                            <span class="phone-mask">+992</span>
                                                <input type="number" style="padding-left: 50px" min="9" name="restore-sms" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" minlength="9" maxlength="9" id="tel-number" class="input-text form-detail_validate" required placeholder=" Введите свой номер">
                                                <span class="border"></span>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text4"></p>
                                        <div class="form-row-last d-grid">
                                            <a href="#" style="width: 100%;"><input type="submit" name="enter" class="enter-main ef1 enter-reg_btn main-enter_btn" value="Вход или  регистрация"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr2">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Вход</h3>
                                    </div>
                                </div>
                                <form id="form2" class="form-detail" action="#" method="post">
                                    <div class="tabcontent" id="sign-pass">
                                        <div class="form-row">
                                            <span class="text-label">Пароль</span>
                                            <label class="form-row-inner position-relative">
                                                <input type="password" data-active="0" name="password" id="enter-password" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" class="input-text hide-pass form-detail_validate" required placeholder="* * * * * * * * * *">
                                                <div class="hide-btn-pass">
                                                    <img src="{base_url}img/show-pass.svg" alt="Icon" id="hidePass1">
                                                </div>
                                            </label>
                                            <p class="validate-text validate-text2"></p>
                                        </div>
                                        <div class="forgot-pass d-flex justify-content-between align-items-center pt-4">
                                            <div class="form-check p-0">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Запомнить
                                                </label>
                                            </div>
                                            <div class="forgot-pass_a">
                                                <a href="#">Забыли пароль?</a>
                                            </div>
                                        </div>
                                        <div class="form-row-last d-flex justify-content-between">
                                            <a href="#"><input type="submit" name="register" class="enter ef2" value="Вход"></a>
                                            <a href="#"><input type="submit" name="cancel" class="register rf2" value="Отмена"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr3">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Регистрация</h3>
                                    </div>
                                </div>
                                <form id="form3" class="form-detail " action="#" method="post">
                                    <div class="tabcontent2" id="ver-in">
                                        <div class="form-row user-phone">
                                            <span class="text-label">Введите код из смс</span>
                                            <label class="form-row-inner">
                                                <input type="number" name="tel-number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" minlength="4" id="ver-sms" class="input-text" required placeholder=" __ __ __ __ ">
                                                <span class="border"></span>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text3"></p>
                                        <div class="timer-agree">
                                            <div class="showTimer">
                                                <p>Повторная отправка сообщения будет доступна через:</p>
                                                <div id="timer" class="text-center pb-4">
                                                    <span id="minutes"></span>
                                                    <span> : </span>
                                                    <span id="seconds"></span>
                                                </div>
                                            </div>
                                            <div class="hideTimer text-center justify-content-center pb-4" style="display: none;">
                                                <a href="#" class="hideTimer_a">Повторная отправка</a>
                                            </div>
                                            <svg class="mx-auto mb-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7526 19.5C7.24795 19.5 3.59625 15.8063 3.59625 11.25C3.59625 6.69365 7.24795 3 11.7526 3C16.2572 3 19.9089 6.69365 19.9089 11.25C19.9089 15.8063 16.2572 19.5 11.7526 19.5ZM2.11328 11.25C2.11328 16.6348 6.42893 21 11.7526 21C17.0762 21 21.3918 16.6348 21.3918 11.25C21.3918 5.86522 17.0762 1.5 11.7526 1.5C6.42893 1.5 2.11328 5.86522 2.11328 11.25Z" fill="#7A769D" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7526 15C12.1621 15 12.494 14.6642 12.494 14.25V11.25C12.494 10.8358 12.1621 10.5 11.7526 10.5C11.3431 10.5 11.0111 10.8358 11.0111 11.25V14.25C11.0111 14.6642 11.3431 15 11.7526 15Z" fill="#7A769D" />
                                                <path d="M12.7412 8.25C12.7412 7.69771 12.2986 7.25 11.7526 7.25C11.2065 7.25 10.7639 7.69771 10.7639 8.25C10.7639 8.80229 11.2065 9.25 11.7526 9.25C12.2986 9.25 12.7412 8.80229 12.7412 8.25Z" fill="#7A769D" />
                                            </svg>
                                            <p class="mb-0">Нажав на кнопку “Продолжить”, я принимаю <a href="{base_url}index.php/main/page/5" target="_blank" class="text-primary">условия пользования</a></p>
                                        </div>
                                        <div class="form-row-last d-flex justify-content-between">
                                            <a href="#"><input type="submit" name="register" class="enter ef3" value="Продолжить"></a>
                                            <a href="#"><input type="submit" name="register" class="register rf3" value="Отмена"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr4">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Регистрация</h3>
                                    </div>
                                </div>
                                <form id="form4" class="form-detail " action="#" method="post">
                                    <div class="tabcontent2" id="ver-in2">
                                        <div class="form-row">
                                            <span class="text-label">Пароль</span>
                                            <label class="form-row-inner position-relative">
                                                <input type="password" name="password" id="first-password" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" class="input-text hide-pass2" required placeholder="* * * * * * * * * *">
                                                <div class="hide-btn-pass" data-active="0">
                                                    <img src="{base_url}img/show-pass.svg" alt="Icon" id="hidePass2">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-row">
                                            <span class="text-label">Повторный пароль</span>
                                            <label class="form-row-inner position-relative">
                                                <input type="password" name="password" id="second-password" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$"  pattern="^[a-zA-Z0-9]+$" class="input-text hide-pass3" required placeholder="* * * * * * * * * *">
                                                <div class="hide-btn-pass" data-active="0">
                                                    <img src="{base_url}img/show-pass.svg" alt="Icon" id="hidePass3">
                                                </div>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text4"></p>
                                        <div class="timer-agree">
                                            <svg class="mx-auto mb-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7526 19.5C7.24795 19.5 3.59625 15.8063 3.59625 11.25C3.59625 6.69365 7.24795 3 11.7526 3C16.2572 3 19.9089 6.69365 19.9089 11.25C19.9089 15.8063 16.2572 19.5 11.7526 19.5ZM2.11328 11.25C2.11328 16.6348 6.42893 21 11.7526 21C17.0762 21 21.3918 16.6348 21.3918 11.25C21.3918 5.86522 17.0762 1.5 11.7526 1.5C6.42893 1.5 2.11328 5.86522 2.11328 11.25Z" fill="#7A769D" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7526 15C12.1621 15 12.494 14.6642 12.494 14.25V11.25C12.494 10.8358 12.1621 10.5 11.7526 10.5C11.3431 10.5 11.0111 10.8358 11.0111 11.25V14.25C11.0111 14.6642 11.3431 15 11.7526 15Z" fill="#7A769D" />
                                                <path d="M12.7412 8.25C12.7412 7.69771 12.2986 7.25 11.7526 7.25C11.2065 7.25 10.7639 7.69771 10.7639 8.25C10.7639 8.80229 11.2065 9.25 11.7526 9.25C12.2986 9.25 12.7412 8.80229 12.7412 8.25Z" fill="#7A769D" />
                                            </svg>
                                            <p class="mb-0">Нажав на кнопку “Регистрация”, я принимаю <a href="{base_url}index.php/main/page/3" class="text-primary">условия пользования</a></p>
                                        </div>
                                        <div class="form-row-last d-flex justify-content-between">
                                            <a href="{base_url}index.php/main/user_info#user-info"><input type="submit" name="register" class="enter ef4" id="ef4" value="Регистрация"></a>
                                            <a href="#"><input type="submit" name="register" class="register rf4" value="Отмена"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr5" style="display: none;">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Восстановление пароля</h3>
                                    </div>
                                </div>
                                <form id="form5" class="form-detail" method="post">
                                    <div class="tabcontent" id="sign-phone">
                                        <div class="form-row">
                                            <span class="text-label">Телефон</span>
                                            <label class="form-row-inner">
                                                <span class="phone-mask">+992</span>
                                                <input type="number" style="padding-left: 50px" min="9" name="tel-number" id="errorPhone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" class="input-text form-detail_validate" required placeholder=" Введите свой номер">
                                                <span class="border"></span>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text5"></p>
                                        <div class="form-row-last d-grid">
                                            <a href="#" style="width: 100%;"><input type="submit" name="enter" class="enter-main ef5 enter-reg_btn" value="Отправить код"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr6" style="display: none;">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Восстановление пароля</h3>
                                    </div>
                                </div>
                                <form id="form6" class="form-detail " action="#" method="post">
                                    <div class="tabcontent2" id="ver-in">
                                        <div class="form-row user-phone">
                                            <span class="text-label">Введите код из смс</span>
                                            <label class="form-row-inner">
                                                <input type="number" name="tel-number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" minlength="4" id="ver-sms2" class="input-text" required placeholder=" __ __ __ __ ">
                                                <span class="border"></span>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text6"></p>
                                        <div class="timer-agree">
                                            <div class="showTimer">
                                                <p>Повторная отправка сообщения будет доступна через:</p>
                                                <div id="timer" class="text-center pb-4">
                                                    <span id="minutesx"></span>
                                                    <span> : </span>
                                                    <span id="secondsx"></span>
                                                </div>
                                            </div>
                                            <div class="hideTimer text-center justify-content-center pb-4" style="display: none;">
                                                <a href="#" class="hideTimer_a">Повторная отправка</a>
                                            </div>
                                        </div>
                                        <div class="form-row-last d-flex justify-content-between">
                                            <a href="#"><input type="submit" name="register" class="enter ef3" value="Продолжить"></a>
                                            <a href="#"><input type="submit" name="register" class="register cancel-btn" value="Отмена"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr7" style="display: none;">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Восстановление пароля</h3>
                                    </div>
                                </div>
                                <form id="form7" class="form-detail " action="#" method="post">
                                    <div class="tabcontent2" id="ver-in2">
                                        <div class="form-row">
                                            <span class="text-label">Пароль</span>
                                            <label class="form-row-inner position-relative">
                                                <input type="password" name="password" id="first-password2" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$"  class="input-text hide-pass2" required placeholder="* * * * * * * * * *">
                                                <div class="hide-btn-pass" data-active="0">
                                                    <img src="{base_url}img/show-pass.svg" alt="Icon" id="hidePass4">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-row">
                                            <span class="text-label">Повторный пароль</span>
                                            <label class="form-row-inner position-relative">
                                                <input type="password" name="password" id="second-password2" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" class="input-text hide-pass3" required placeholder="* * * * * * * * * *">
                                                <div class="hide-btn-pass" data-active="0">
                                                    <img src=" {base_url}img/show-pass.svg" alt="Icon" id="hidePass5">
                                                </div>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text7"></p>
                                        <div class="form-row-last d-flex justify-content-between">
                                            <a href="{base_url}index.php/main/user_info#user-info"><input type="submit" name="register" class="enter ef7" id="ef7" value="Продолжить"></a>
                                            <a href="#"><input type="submit" name="register" class="register cancel-btn2" value="Отмена"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="enter-form_reg efr8" style="display: none;">
                                <div class="tab">
                                    <div class="tab-inner">
                                        <h3 class="tablinks text-center">Восстановление пароля</h3>
                                    </div>
                                </div>
                                <form id="form8" class="form-detail " action="#" method="post">
                                    <div class="tabcontent2" id="ver-in">
                                        <div class="form-row user-phone">
                                            <span class="text-label">Введите код из смс</span>
                                            <label class="form-row-inner">
                                                <input type="number" name="tel-number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" minlength="4" id="ver-sms8" class="input-text" required placeholder=" __ __ __ __ ">
                                                <span class="border"></span>
                                            </label>
                                        </div>
                                        <p class="validate-text validate-text8"></p>
                                        <div class="timer-agree">
                                            <div class="showTimer">
                                                <p>Повторная отправка сообщения будет доступна через:</p>
                                                <div id="timer" class="text-center pb-4">
                                                    <span id="minutesy"></span>
                                                    <span> : </span>
                                                    <span id="secondsy"></span>
                                                </div>
                                            </div>
                                            <div class="hideTimer text-center justify-content-center pb-4" id="hidetimer" style="display: none;">
                                                <a href="#" class="hideTimer_a">Повторная отправка</a>
                                            </div>
                                        </div>
                                        <div class="form-row-last d-flex justify-content-between">
                                            <a href="#"><input type="submit" name="register" class="enter ef3" value="Изменить"></a>
                                            <a href="#"><input type="submit" name="register" class="register cancel-btn8" value="Отмена"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header header--standard header--market-place-1" data-sticky="true">
        <div class="header__top header_top">
            <div class="container">
                <div class="header__left">
                    <p>Интернет Аптека Саломат - доставка лекарств на дом !</p>
                </div>
                <div class="header__right">
                    <ul class="header__top-links">
                        <li><a href="{base_url}index.php/main/page/1">О проекте</a></li>
                        <li><a href="{base_url}index.php/main/page/2">Как сделать заказ</a></li>
                        <li><a href="{base_url}index.php/main/page/3">Доставка и оплата</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header__content">
            <div class="container">
                <div class="header__content-left">
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span> Каталог товаров</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">
                                <?php foreach ($categories as $cat) : ?>
                                    <li class="menu-item-has-children has-mega-menu">
                                        <a href="#"><img src="{base_url}img/icons/<?= $cat['icon'] ?>" alt="Icon" style="padding-right: 15px;"> <?= $cat['category_name'] ?></a>
                                        <div class="mega-menu">
                                            <div class="mega-menu__column">
                                                <ul class="mega-menu__list">
                                                    <?php foreach ($cat['sub_cat'] as $sub_cat) : ?>
                                                        <li>
                                                            <a href="{base_url}index.php/main/categoryProducts/<?= $sub_cat['id'] ?>">
                                                                <?= $sub_cat['category_name'] ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <a class="ps-logo" href="{base_url}"><img src="{base_url}img/logo.png" alt=""></a>
                </div>
                <div class="header__content-center" id="srch_res_list">
                    <form class="ps-form--quick-search" action="<?= base_url("index.php/main/searchProductResult") ?>" method="get">
                        <div class="form-group--icon"><i class="icon-magnifier"></i>

                        </div>

                        <input class="form-control srch_pr_inp" name="srch_pr_inp" type="text" placeholder="Найти по названию среди более 5 000 лекарств ...">

                        <button class="srch_submit_btn" type="submit">Найти</button>

                    </form>
                    <!-- PRODUCT SEARCH RESULTS HERE -->
                    <div class="srch-results">

                    </div>


                </div>

                <div class="header__content-right">
                    <div class="header__actions">
                        <!-- <a class="header__extra header_phone_number" href="tel:9990"> -->
                        <a class="header__extra header_phone_number call" href="javascript:void(0)" onclick="window.location='tel:9990'">
                            <strong>
                                <img src="{base_url}img/header-phone.svg " alt="" style="width: 25px; margin-right: 10px; margin-top: 10px;"> 99-90
                            </strong>
                            <p class="text-muted">09:00-00:00</p>
                        </a>
                        <div class="ps-cart--mini">
                            <a class="header__extra header_cart_a" href="{base_url}index.php/main/cart_shopping">
                                <img src="{base_url}img/header-basket.svg" style="margin-bottom: -30px;">
                                <span class="header_cart_tot_span">
                                    <i id="total_count_in_cart_header">0</i>
                                </span>
                            </a>
                            <div class="ps-cart__content">
                                <div class="ps-cart__items" id="ps-cart__items">

                                </div>
                                <div class="ps-cart__footer">
                                    <hr>
                                    <h3 class="cart_sum_h">Общая сумма:<strong class="total_cart_sum"></strong></h3>
                                    <a class="ps-btn d-flex justify-content-center" href="{base_url}index.php/main/cart_shopping">Перейти в корзину</a>
                                    <figure>
                                    </figure>
                                </div>
                            </div>
                        </div>

                        <div class="account-btn">
                            <div class="ps-block--user-header">
                                <div class="ps-block__right" onclick="onPsBlockRight()"><a class="ps-btn" href="#" id="enter-profile">Войти</a></div>
                            </div>
                        </div>
                        <div class="account-wrap" id="account-wrap" style="display: none;">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                    <img class="rounded-circle user_icon" style="width: 45px; height: 45px;" id="user_icon1" src="{base_url}user_img/<?php echo $image ?? 'user.png' ?>" alt="User Icon" />
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img class="rounded-circle user_icon" id="user_icon1" style="width: 50px; height: 50px;" src="{base_url}user_img/<?php echo $image ?? 'user.png' ?>" alt="User Icon" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#"><?php echo ($name  ?? null); ?></a>
                                            </h5>
                                            <span class="email"><?php echo ($email ?? null); ?></span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <ul class="user-info_ul nav nav-pills d-block" id="myTab" role="tablist">
                                            <li class="nav-item5" role="presentation"><a id="webdisign-tab0" data-toggle="tab" href="#user-info" data-hash="#user-info" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-user.svg" alt="Icon">Личная информация</a></li>
                                            <li class="nav-item5" role="presentation"><a id="webdisign-tab1" data-toggle="tab" href="#user-order" data-hash="#user-order" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-cart.svg" alt="Icon">Мои заказы</a></li>
                                            <li class="nav-item5" role="presentation"><a id="webdisign-tab2" data-toggle="tab" href="#user-favorite" data-hash="#user-favorite" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-like.svg" alt="Icon">Избранное</a></li>
                                            <li class="nav-item5" role="presentation"><a id="webdisign-tab3" data-toggle="tab" href="#user-save" data-hash="#user-save" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/up-save.svg" alt="Icon">Безопасность</a></li>
                                            <li class="nav-item5" role="presentation"><a id="webdisign-tab3" data-toggle="tab" href="#phone-number" data-hash="#phone-number" role="tab" aria-controls="webdisign" aria-selected="true"><img src="{base_url}img/header-phone.svg" alt="Icon" width="34px">Номер телефона</a></li>
                                        </ul>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="/" onclick="onRemoveLS()">
                                            <i class="zmdi zmdi-power"></i>Выход</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation">
            <div class="container">
                <div class="navigation__left">
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span> Каталог товаров</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">

                                <!--mega menu-->
                                <!--Лекарственные препараты-->
                                <?php foreach ($categories as $cat) : ?>
                                    <li class="menu-item-has-children has-mega-menu">
                                        <a href="#"><img src="{base_url}img/icons/<?= $cat['icon'] ?>" alt="Icon" style="padding-right: 15px;"><?= $cat['category_name'] ?></a>
                                        <div class="mega-menu">
                                            <div class="mega-menu__column">
                                                <ul class="mega-menu__list">
                                                    <?php foreach ($cat['sub_cat'] as $sub_cat) : ?>
                                                        <li>
                                                            <a href="{base_url}index.php/main/categoryProducts/<?= $sub_cat['id'] ?>">
                                                                <?= $sub_cat['category_name'] ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="navigation__right header-flex_content">
                    <ul class="menu header_links">
                        <li class="">
                            <a href="{base_url}index.php/main/sales/11"><img src="{base_url}img/alergi.svg" /> При алергии</a>
                        </li>
                        <li class="">
                            <a href="{base_url}index.php/main/categoryProducts/178"><img src="{base_url}img/vitamin.svg" /> Витамины</a>
                        </li>
                        <li class="">
                            <a href="{base_url}index.php/main/sales/9"><img src="{base_url}img/skidki.svg" /> Скидки</a>
                        </li>
                    </ul>
                    <!-- <div class="ps-block--header-hotline inline">
                        <p><strong><i class="icon-telephone"></i>+992 888 88 6006</strong></p>
                    </div> -->
                </div>
            </div>
        </nav>
    </header>

    <!-- MOBILE -->

    <header class="header header--mobile" data-sticky="true">
        <div class="navigation--mobile srch_inp_header_div header-flex_content">
            <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
                <img src="{base_url}img/burger-mobile_icon.svg" alt="Mobil Icon" style="width: 22px; height: 20px">
            </a>
            <div class="navigation__left">
                <a class="ps-logo" href="{base_url}"><img class="header-logo_img" src="{base_url}img/logo.png" alt=""></a>
            </div>
            <div class="navigation__right">
                <!-- <div class="header__actions"> -->
                <!-- <div class="ps-cart--mini header_phone_number"> -->
                <a class="header__extra header_phone_number call" href="javascript:void(0)" onclick="window.location='tel:9990'" target="_blank">
                    <strong>
                        <img src="/img/tel.svg " alt="" style="width: 18px; margin-right: 10px;">99-90
                    </strong>
                    <p class="text-muted">09:00-18:00</p>
                </a>
                <!-- </div> -->
                <!--div class="ps-block--user-header">
                        <div class="ps-block__left"><i class="icon-user"></i></div>
                        <div class="ps-block__right"><a href="my-account.html">Login</a><a href="my-account.html">Register</a></div>
                        -->
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
        </div>
        <div class="ps-search--mobile srch_inp_div">
            <form class="ps-form--search-mobile" action="<?= base_url("index.php/main/searchProductResult") ?>" method="get">
                <div class="form-group--nest">
                    <input class="form-control srch_pr_inp_mobile" name="srch_pr_inp" onkeyup="input_type_mobile('srch_pr_inp_mobile', 'mobile')" type="text" placeholder="Искать по названию среди 5 000 лекарств и товаров...">
                    <button type="submit" class="search_icon_btn"><i class="icon-magnifier"></i></button>
                </div>
            </form>
            <div class="srch-results_mobile srch-results-mobile__header">

            </div>
        </div>
    </header>
    <div class="ps-panel--sidebar" id="cart-mobile">
        <div class="ps-panel__header">
            <h3>Корзина</h3>
        </div>
        <div class="navigation__content">
            <div class="ps-cart--mobile">
                <div class="ps-cart__content">
                    <div class="ps-product--cart-mobile">
                        <div class="ps-product__content">
                            <div class="ps-cart__items" id="ps-cart__items">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-cart__footer">
                    <h3>Общая сумма:<strong class="total_cart_sum"></strong></h3>
                    <figure>
                        <a class="ps-btn d-flex justify-content-center" href="{base_url}index.php/main/cart_shopping">Перейти в корзину</a>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-panel--sidebar" id="navigation-mobile">
        <div class="ps-panel__header">
            <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><svg style="display: flex; color: #fff;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></a>
            <h3 style="padding-left: 20px;">Каталог товаров</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">
                <?php foreach ($categories as $cat) : ?>
                    <li class="menu-item-has-children has-mega-menu">

                        <a href="#"><img src="{base_url}img/icons/<?= $cat['icon'] ?>" alt="Icon" style="padding-right: 15px;"> <?= $cat['category_name'] ?></a><span class="sub-toggle"></span>

                        <div class="mega-menu">
                            <div class="mega-menu__column">
                                <?php foreach ($cat['sub_cat'] as $sub_cat) : ?>
                                    <a href="<?= $base_url ?>index.php/main/categoryProducts/<?= $sub_cat['id'] ?>">
                                        <h4>
                                            <?= $sub_cat['category_name'] ?><span class="sub-toggle"></span>
                                        </h4>
                                    </a>
                                    <ul class="mega-menu__list" style="height: max-content;">
                                        <?php foreach ($sub_cat['sub_cat'] as $sub_sub_cat) : ?>
                                            <li>
                                                <a href="<?= $base_url ?>index.php/main/categoryProducts/<?= $sub_sub_cat['id'] ?>">
                                                    <?= $sub_sub_cat['category_name'] ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="navigation--list">
        <div class="navigation__content navigation-main">
            <a class="navigation__item navigation-main" href="{base_url}" data-id="1" data-src="{base_url}img/1inactive.icon.svg">
                <img src="{base_url}img/1inactive.icon.svg" alt="icon">
                <span> Главная</span>
            </a>
            <a class="navigation__item ps-toggle--sidebar navigation-favorite" onclick="onPsBlockRight()" href="enter-profile" data-id="2" data-src="{base_url}img/2inactive.icon.svg">
                <img src="{base_url}img/2inactive.icon.svg" alt="icon">
                <span> Избранное</span>
            </a>
            <a class="navigation__item navigation-recept" href="{base_url}index.php/main/recipe" data-id="3" data-src="{base_url}img/3inactive.icon.png">
                <img src="{base_url}img/3inactive.icon.png" alt="icon">
                <span> э-Рецепт</span>
            </a>
            <a class="navigation__item navigation-cart" href="{base_url}index.php/main/cart_shopping" data-id="4" data-src="{base_url}img/4inactive.icon.svg">
                <img src="{base_url}img/4inactive.icon.svg" alt="icon">
                <span> Корзина</span>
                <span class="footer_cart_tot_span">
                    <i id="total_count_in_cart_footer">0</i>
                </span>
            </a>
            <div class="account-btn">
                <div class="ps-block--user-header">
                    <div class="ps-block__right" onclick="onPsBlockRight()">
                        <a class="navigation__item navigation-profile" onclick="onPsBlockRight()" href="#" id="enter-profile" data-id="5" data-src="{base_url}img/5inactive.icon.svg">
                            <img src="{base_url}img/5inactive.icon.svg" alt="icon">
                            <span>Профиль</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="account-wrap" id="account-wrap2" style="display: none;">
                <div class="user-image__link">
                    <a href="{base_url}index.php/main/user_info#user-info"><img class="rounded-circle" style="width: 40px; height: 40px;" src="{base_url}user_img/<?php echo $image ?? 'user.png' ?>" alt="User Icon" /></a>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
        <div class="ps-panel__header">
            <form class="ps-form--search-mobile" action="<?= base_url("main/searchProductResult") ?>" method="get">
                <div class="form-group--nest">
                    <input class="form-control srch_pr_inp_mobile_aside" name="srch_pr_inp" onkeyup="input_type_mobile('srch_pr_inp_mobile_aside', 'sidebar')" type="text" placeholder="Искать по названию среди 5 000 лекарств и товаров...">
                    <button type="submit" class="search_icon_btn"><i class="icon-magnifier"></i></button>
                </div>
            </form>
        </div>
        <div class="srch-results_mobile srch-res_mob_sidebar">

        </div>
        <div class="navigation__content"></div>
    </div>

    <div class="toast toast_empty fade hide">
        <div class="toast-body">
            <i class="fa fa-exclamation-triangle"></i>
            Корзина пуста!
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</body>

<script src="{base_url}plugins/jquery.form.validation.min.js"></script>
<script src="{base_url}js/jquery.validate.min.js"></script>
<script src="{base_url}js/form_validation_messages_ru.js"></script>
<script>
    var timer;

    var compareDate = new Date();
    compareDate.setDate(compareDate.getDate() + 7);

    function userTimer() {
        timer = setInterval(function() {
            timeBetweenDates(compareDate);
        }, 1000);
    }

    function timeBetweenDates(toDate) {

        var dateEntered = toDate;
        var now = new Date();
        var difference = dateEntered.getTime() - now.getTime();

        if (difference <= 0) {
            if (minutes === 0 && seconds === 0) {
                $('.showTimer').hide();
                $('.hideTimer').css("display", "block");
            }

            // Timer done
            clearInterval(timer);

        } else {

            var seconds = Math.floor(difference / 1000);
            var minutes = Math.floor(seconds / 60);

            minutes %= 2;
            seconds %= 60;
            if (minutes === 0 && seconds === 0) {
                $('.showTimer').hide();
                $('.hideTimer').css("display", "block");
            }

            $("#minutes").text(minutes);
            $("#seconds").text(seconds);
            $("#minutesx").text(minutes);
            $("#secondsx").text(seconds);
            $("#minutesy").text(minutes);
            $("#secondsy").text(seconds);
        }
    }

    const __userIcons = Array.from(document.querySelectorAll(".image  img"));



    if (localStorage.getItem("userId") !== null) {
        $(".account-btn").css("display", "none")
        $(".account-wrap").css("display", "block")
    }

    function onAddBorder() {
        const __products = JSON.parse(localStorage.getItem("product_list"));
        const __categores = Array.from(document.querySelectorAll(".ps-product--simple, .main-ps-product, .ps-product--inner-sales, .ps-product--wide"));

        if (__products !== null) {
            __categores.forEach(elem => {
                __products.forEach(product => {
                    if (elem.dataset.id === product.product_id) {
                        elem.classList.add("main-products_border");
                    }
                })
            })
        }
    }

    function remove_from_header_cart(id) {
        const __categores = Array.from(document.querySelectorAll(".ps-product--simple, .main-ps-product, .ps-product--inner-sales, .ps-product--wide"));
        __categores.forEach(elem => {
            if (Number(elem.dataset.id) === id) {
                elem.classList.remove("main-products_border")
            }
        })
        var mydata = $.parseJSON(localStorage.getItem("product_list"));
        if (mydata.length == 1) {
            // $.removeCookie('product_list', {
            //     path: '/'
            // });
            localStorage.removeItem("product_list");
            $('.pr-list').html('');
            if (typeof goHome == 'function') {
                goHome();
            }
            // $.cookie('product_list', '', {expires: -1});
        } else {
            mydata.forEach(function(elem, index) {
                if (elem.product_id == id) {
                    mydata.splice(index, 1);
                    $('#prod_list' + id).remove();
                }
            });
            // $.cookie("product_list", JSON.stringify(mydata), {
            //     path: '/'
            // });
            localStorage.setItem("product_list", JSON.stringify(mydata))
        }
        set_prods_header();
        if (typeof product_list == "function") {
            product_list();
        };
        if (typeof set_pr_checkout == "function") {
            set_pr_checkout();
        };
        if (typeof set_pr_checkout == "function") {
            total_sum();
        };

    }

    const __hide = Array.from(document.querySelectorAll(".hide-btn-pass"));
    __hide.forEach(elem => elem.addEventListener("click", showPass))

    function showPass() {
        this.dataset.active === "0" ? (this.dataset.active = "1") : (this.dataset.active = "0");

        let res = !!Number(this.dataset.active);
        if (res) {
            this.childNodes[1].src = "{base_url}img/hide-pass.svg";
            this.parentNode.childNodes[1].type = "text"
        } else {
            this.childNodes[1].src = "{base_url}img/show-pass.svg";
            this.parentNode.childNodes[1].type = "password"
        }

    }


    function set_prods_header() {

        if (localStorage.getItem("product_list")) {
            $('.checkout').show();
            $('.ps-cart__footer').find('h3').show();
            $('.ps-cart__footer').find('.cart_empty_text').remove();
            $('.ps-cart__footer').css('text-align', '');
            $('.ps-cart__footer').find('figure').css('justify-content', '');

            var mydata = $.parseJSON(localStorage.getItem("product_list"));
            var total_sum = 0;
            var arr = [];
            mydata.forEach(function(item, index) {
                total_sum += (item.product_count * item.product_price);
            });
            $('.total_cart_sum').text(total_sum + ' смн.');

            $('#total_count_in_cart_header').text(mydata.length);
            $('#total_count_in_cart_footer').text(mydata.length);
            if (mydata.length > 2) {
                mydata.splice(2);
            }
            $('.ps-cart__items').html('');
            mydata.forEach(function(item) {
                html = "<div class=\"ps-product--cart-mobile\" id=\"prod_list" + item.product_id + "\">\n" +
                    "        <div class=\"ps-product__thumbnail hover01\">\n" +
                    "            <a href=\"<?= $base_url ?>upload_product/" + item.product_pic + "\">\n" +
                    "                <img src=\"<?= $base_url ?>upload_product/" + item.product_pic + "\" alt=\"\"></a>\n" +
                    "        </div>\n" +
                    "        <div class=\"ps-product__content\">\n" +
                    "            <i style=\"cursor:pointer\" class=\"ps-product__remove icon-cross\" id=\"ps-product__remove\" onclick=\"remove_from_header_cart(" + item.product_id + ")\"></i>\n" +
                    "            <a href=\"<?= $base_url ?>index.php/main/product/" + item.product_id + "\">" + item.product_name + "</a>\n" +
                    "            <p>" + item.product_brand.brand_name + "</p><small>" + item.product_count + " x " + item.product_price + " c.</small>\n" +
                    "        </div>\n" +
                    "    </div>";


                $('.ps-cart__items').append(html);
            });

            if (($.parseJSON(localStorage.getItem("product_list"))).length > 2) {
                var more = "<div><a style=\"float:right;font-size:16px;color:#33c6a5\" href=\"<?= $base_url ?>index.php/main/cart_shopping\">Все продукты <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>\n</a></div>";
                $('.ps-cart__items').append(more);
            }
        } else {
            $('.ps-cart__items').html('');
            $('.total_cart_sum').html('');
            $('.checkout').hide();
            $('.ps-cart__footer').find('h3').hide();
            $('.ps-cart__footer').prepend("<h3 class=\"cart_empty_text\">Корзина пуста <i class=\"fa fa-shopping-cart\"></i></h3>");
            $('.ps-cart__footer').find('h3.cart_empty_text').css('color', 'gray');
            $('.ps-cart__footer').css('text-align', 'center');
            $('.ps-cart__footer').find('figure').css('justify-content', 'center');
            $('#total_count_in_cart_header').html('0');
            $('#total_count_in_cart_footer').html('0');
        }
    }

    function input_type() {
        $('.srch_pr_inp').keyup(function() {
            if ($('.srch_pr_inp').val() == '') {
                $('.srch-results_mobile').hide();
            }
            $('.srch-results').html('');
            $('.srch-results').css('display', 'none');

            $.getJSON("{base_url}index.php/main/search_product?q=" + $('.srch_pr_inp').val(), function(data, status) {
                var res = data;
                if (res.length == 0) {
                    var html_empty = "<div class=\"srch-results-empty\">" +
                        "<div>" +
                        "<strong id=\"res-prod-empty\">Ничего не найдено ...</strong>" +
                        "</div>" +
                        "</div>";
                    $('.srch-results').html('');

                    $('.srch-results').append(html_empty);
                } else {
                    $('.srch-results').html('');
                    if (res.length > 5) {
                        res.splice(5);
                    }
                    res.forEach(function(prod, index, arr) {

                        var html_list;
                        if (prod.product_old_price != 0) {
                            html_list =
                                "<a href=\"{base_url}index.php/main/product/" + prod.id + "\">" +
                                "<div class=\"ps-product--cart-mobile srch_prod_list\">\n" +
                                "        <div class=\"ps-product__content srch_ps-product__content\">\n" +
                                "            <div class=\"prod_pic\"><img src=\"<?= $base_url ?>upload_product/" + prod.product_pic + "\"></div>" +
                                "            <div class=\"srch_prod_price \">" + prod.product_name + "\n" +
                                "                <p class=\"ps-product__price sale\">" + prod.product_price + " смн. <del>" + prod.product_old_price + "</del></p>" +
                                "            </div>\n" +
                                "        </div>\n" +
                                "    </div>" +
                                "</a>";
                        } else {
                            html_list =
                                "<a href=\"{base_url}index.php/main/product/" + prod.id + "\">" +
                                "<div class=\"ps-product--cart-mobile srch_prod_list\">\n" +
                                "        <div class=\"ps-product__content srch_ps-product__content\">\n" +
                                "            <div class=\"prod_pic\"><img src=\"<?= $base_url ?>upload_product/" + prod.product_pic + "\"></div>" +
                                "            <div class=\"srch_prod_price \">" + prod.product_name + "\n" +
                                "                <p class=\"ps-product__price  sale\">" + prod.product_price + " смн.</p>" +
                                "            </div>\n" +
                                "        </div>\n" +
                                "    </div>" +
                                "</a>";
                        }
                        // "<a href=\"{base_url}index.php/main/product/" + prod.id + "\">" +
                        //     "<div class=\"each_prod d-flex align-items-center justify-content-between\">" +
                        //     "<div class=\"prod_pic\"><img src=\"{base_url}upload_product/" + prod.product_pic + "\" alt=\"pic\"></div>" +
                        //     "<strong class=\"align-self-center\" id=\"res-prod-name\">" + prod.product_name + "</strong>" +
                        //     "<strong class=\"align-self-center\" id=\"res-prod-price\">" + prod.product_price + " cом.</strong>" +
                        //     "</div>" +
                        //     "</a>";
                        // "<div class=\"d-flex align-items-center justify-content-end\"><i onclick=\"add_to_cart(" + prod.id + ")\" style=\"cursor:pointer\" class=\"fa fa-plus add_icon\"></i>";

                        $('.srch-results').append(html_list);
                        if (index != arr.length - 1) {
                            $('.srch_prod_list').css({
                                'cssText': 'border-bottom: 1px solid #e1e1e1 !important'
                            });
                        }
                    });
                }
                $('.srch-results').css('display', 'block');

            });
            $(document).click(function(event) {
                if (!$(event.target).is(".srch_pr_inp, .srch-results, .res-prod-empty, .add_pr_to_cart, add_icon")) {
                    $(".srch-results").css('display', 'none');
                    $(".srch-results").html('');
                }
            });
        });
    }

    function input_type_mobile(cl, type) {
        $('.srch-results_mobile').html('');
        $('.srch-results_mobile').css('display', 'none');

        $.getJSON("{base_url}index.php/main/search_product?q=" + $('.' + cl).val(), function(data, status) {
            var res = data;
            if (res.length == 0) {
                var html_empty = "<div class=\"srch-results-empty_mobile\">" +
                    "<div>" +
                    "<strong id=\"res-prod-empty_mobile\">Ничего не найдено ...</strong>" +
                    "</div>" +
                    "</div>";

                $('.srch-results_mobile').html('');

                $('.srch-results_mobile').append(html_empty);
            } else {
                if (res.length > 10) {
                    res.splice(10);
                }
                $('.srch-results_mobile').html('');

                res.forEach(function(prod, index, arr) {

                    var html_list;
                    if (prod.product_old_price != 0) {
                        html_list =
                            "<a href=\"{base_url}index.php/main/product/" + prod.id + "\">" +
                            "<div class=\"ps-product--cart-mobile srch_prod_list\">\n" +
                            "        <div class=\"ps-product__content srch_ps-product__content\">\n" +
                            "            <div class=\"prod_pic_mobile\"><img src=\"<?= $base_url ?>upload_product/" + prod.product_pic + "\"></div>" +
                            "            <div class=\"srch_prod_price\">" + prod.product_name + "\n" +
                            "                <p class=\"ps-product__price sale\">" + prod.product_price + " смн. <del>" + prod.product_old_price + "</del></p>" +
                            "            </div>\n" +
                            "        </div>\n" +
                            "    </div>" +
                            "</a>";
                    } else {
                        html_list =
                            "<a href=\"{base_url}index.php/main/product/" + prod.id + "\">" +
                            "<div class=\"ps-product--cart-mobile srch_prod_list\">\n" +
                            "        <div class=\"ps-product__content srch_ps-product__content\">\n" +
                            "            <div class=\"prod_pic_mobile\"><img src=\"<?= $base_url ?>upload_product/" + prod.product_pic + "\"></div>" +
                            "            <div class=\"srch_prod_price cust\">" + prod.product_name + "\n" +
                            "                <p class=\"ps-product__price sale\">" + prod.product_price + " смн.</p>" +
                            "            </div>\n" +
                            "        </div>\n" +
                            "    </div>" +
                            "</a>";
                    }

                    $('.srch-results_mobile').append(html_list);
                    if (index != arr.length - 1) {
                        $('.each_prod_mobile').css('border-bottom', '1px solid #e1e1e1');
                    }
                });
            }
            if (type == 'mobile') {
                $('.srch-results-mobile__header').css('display', 'block');
            } else {
                $('.srch-res_mob_sidebar').css('display', 'block');
            }
        });
        // WRITTEN IN MAIN JS 
        // if (! $('.ps-toggle--sidebar').hasClass('active')) {
        // $('.srch-results_mobile').html('');
        // $('.srch_pr_inp_mobile').val('');
        // }
    }


    function change_z_index_on_scroll() {
        $(window).scroll(function() {
            var currentPosition = $(this).scrollTop();
            if ($('.header--mobile').hasClass('header--sticky')) {
                $('.srch_inp_div').css('z-index', '0');
                $('.srch_inp_header_div').css({
                    'cssText': 'padding: 10px 30px !important'
                });
            }
            if ($(window).width() < 480) {
                if ($(this).scrollTop() > 50) {
                    $('.srch_inp_div').css({
                        'cssText': 'z-index:0 !important'
                    });
                    $('.srch_inp_header_div').css({
                        'cssText': 'padding: 10px 30px !important'
                    });
                } else {
                    $('.srch_inp_header_div').css({
                        'cssText': 'padding-bottom: 70px !important'
                    });
                    $('.srch_inp_div').css('z-index', '1000');
                }
            }
        });
    }
    $(document).ready(function() {
        input_type();
        change_z_index_on_scroll();
        set_prods_header();
        $('.srch-results_mobile').html('');
        $('.srch-results_mobile').css('display', 'none');
        $('a.checkout').click(function(e) {
            if (!localStorage.getItem("product_list")) {
                e.preventDefault();
                $('.toast_empty').toast({
                    delay: 1500
                });
                $('.toast_empty').toast('show');
            }
        });
    });

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function verForm() {
        document.querySelector(".user-phone").style.display = "none";
        document.querySelector(".ver-form").style.display = "block";

    }

    function passForm() {
        document.querySelector(".ver-form").style.display = "none";
        document.querySelector(".pass-form").style.display = "block";

    }

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

    // Get the element with id="defaultOpen" and click on it
    /*document.getElementById("defaultOpen").click();*/

    function onPsBlockRight() {

        $(".enter-form").css("display", "block");
        document.querySelector(".enter-btn-bg").style.display = "flex";
        document.querySelector(".enter-btn-bg").classList.add("active-animation");
        document.querySelector(".enter-btn-bg").classList.remove("disactive-animation");
    }



    $(".forgot-pass_a").click(() => {
        $(".efr2").css("display", "none")
        $(".efr5").css("display", "block")

    })
    // $("#form5").on("submit", (e) => {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "GET",
    //         url: "{base_url}users",
    //         headers: {
    //             "Accept": "application/json",
    //         },
    //         success: function(result) {
    //             if (result.filter(elem => elem.login === String(errorPhone.value)).length > 0) {
    //                 userTimer();
    //                 $(".efr5").css("display", "none");
    //                 $(".efr6").css("display", "block");
    //                 $(".validate-text5").text("");
    //                 localStorage.setItem("restore-phone", errorPhone.value);

    //             } else {
    //                 $(".validate-text5").text("Нет такого пользователья");
    //             }
    //         },
    //     })

    //     $.ajax({
    //         type: "POST",
    //         url: "{base_url}/users/resend_sms",
    //         headers: {
    //             "Accept": "application/json",
    //         },
    //         data: {
    //             phone: localStorage.getItem("restore-phone")
    //         },
    //         success(result) {
    //             localStorage.setItem("res-sms", result);
    //         }
    //     })

    // })
    $(".cancel-btn").click((e) => {
        e.preventDefault();
        $(".efr6").hide();
        $(".efr5").css("display", "block");
    })
    $(".cancel-btn8").click((e) => {
        e.preventDefault();
        $(".enter-btn-bg").hide();
    })
    $(".cancel-btn2").click((e) => {
        e.preventDefault();
        $(".efr7").hide();
        $(".efr5").css("display", "block");
    })
    $("#form6").submit((e) => {
        e.preventDefault();
        if ($("#ver-sms2").val() === String(localStorage.getItem("res-sms"))) {
            $(".efr6").css("display", "none")
            $(".efr7").css("display", "block")
        } else {
            $(".validate-text6").text("Введен неправильный код.");
        }
    })

    $("#form8").submit((e) => {
        e.preventDefault();
        if ($("#ver-sms8").val() === String(localStorage.getItem("res-sms"))) {
            $(".enter-btn-bg").css("display", "none");
            $.ajax({
                type: "POST",
                url: `{base_url}/users/check_register_code`,
                data: {
                    phone: Number(localStorage.getItem("ver-number")),
                    confirm_code: Number(localStorage.getItem("res-sms"))
                },
                success: function(result) {
                    $(".validate-text8").text("");
                    updatePhone();
                },
                error: function(error) {
                    $(".validate-text8").text("Неправильный номер");
                }
            })
        } else {
            $(".validate-text8").text("Введен неправильный код.");
        }
    })


    function updatePhone() {
        $.ajax({
            type: "POST",
            url: `{base_url}users/edit_user/${Number(JSON.parse(localStorage.getItem("userId")).user_id)}`,
            headers: {
                "Accept": "application/json",
            },
            data: {
                phone: Number(localStorage.getItem("ver-number")),
            },
            success: function(result) {
                $(".validate-text").text("");
                $(".enter-btn-phone").css("display", "block")
            },
            error: function(error) {

            }
        })
    }

    // $("#form1").submit((e) => {
    //     e.preventDefault();
    //     onPost();
    // })

    $(".hideTimer_a").click(() => {
        sendSms();
        $(".showTimer").css("display", "block");
        $(".hideTimer").css("display", "none");
        userTimer();
    })
    $(".rf1").click((e) => {
        e.preventDefault();
        $(".efr1").hide();
        $(".efr3").css("display", "block");
        userTimer();
    })
    $("#form3").submit((e) => {
        e.preventDefault();
        verSms();
        userTimer();
    })
    // $("#form4").submit((e) => {
    //     e.preventDefault();
    //     onRegister();
    // })
    $(".rf2").click((e) => {
        e.preventDefault();
        $(".efr2").hide();
        $(".efr1").css("display", "block");
    })
    $(".rf3").click((e) => {
        e.preventDefault();
        $(".efr3").hide();
        $(".efr1").css("display", "block");
    })
    $(".rf4").click((e) => {
        e.preventDefault();
        $(".efr4").hide();
        $(".efr1").css("display", "block");
    })
    document.querySelector(".enter-btn-bg").addEventListener('click', ({
        target
    }) => {
        if (target.classList.contains("enter-btn-bg")) {
            document.querySelector(".enter-btn-bg").classList.remove("active-animation");
            document.querySelector(".enter-btn-bg").classList.add("disactive-animation");
            document.querySelector(".enter-btn-bg").style.display = "none";
        }
    })
    $('.ef1').on('click', () => {
        localStorage.setItem("ver-number", $('#tel-number').val());

    })

    // $("#form2").on("submit", (e) => {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "{base_url}users/login",
    //         headers: {
    //             "Accept": "application/json",
    //         },
    //         data: {
    //             phone: Number(localStorage.getItem("ver-number")),
    //             password: $("#enter-password").val()
    //         },
    //         success: function(result) {
    //             $(".validate-text2").text("");
    //             userInfo();
    //         },
    //         error: function(error) {
    //             $(".validate-text2").text("Неправильный логин или пароль")
    //         }
    //     })


    // })

    $("#form2").on('keyup', (e) => {
        if (e.keyCode === 13) {
            $.ajax({
                type: "POST",
                url: "{base_url}users/login",
                headers: {
                    "Accept": "application/json",
                },
                data: {
                    phone: Number(localStorage.getItem("ver-number")),
                    password: $("#enter-password").val()
                },
                success: function(result) {
                    $(".validate-text2").text("");
                    userInfo();
                },
                error: function(error) {
                    $(".validate-text2").text("Неправильный логин или пароль");
                }
            })
        }
    })

    function sendSms() {
        $.ajax({
            type: "POST",
            url: "{base_url}users/resend_sms",
            headers: {
                "Accept": "application/json",
            },
            data: {
                phone: Number(localStorage.getItem("ver-number")),
            },
            success: function(result) {

            },
            error: function(error) {}
        })
    }

    function userInfo() {
        fetch("{base_url}users")
            .then(resp => resp.json())
            .then(resp => {
                resp.filter(elem => {
                    if (elem.login === String(localStorage.getItem("ver-number"))) {
                        return userId(elem.user_id)
                    }
                })
            })
    }

    function userId(id) {
        fetch(`{base_url}users/show/${id}`, {
            method: "get",
            headers: ({
                'Authorization': "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjM0IiwibG9naW4iOiI1NTAyNjQ0MDAiLCJ0aW1lIjoxNjU3ODY5MjU2fQ.nEO1YvaQFgwJpiGbx22DnuNoB3o7QOte9mGl2hu8z-E",
                'Content-Type': "application/json"
            })
        }).then(resp => resp.json()).then(resp => {
            localStorage.setItem("userId", JSON.stringify(resp[0]))
            if (JSON.parse(localStorage.getItem("userId")).user_id) {
                $(".enter-btn-bg").css("display", "none");
                $(".account-btn").css("display", "none");
                document.getElementById("account-wrap").style.display = "block";
                document.getElementById("account-wrap2").style.display = "block";
            }
        })
    }

    function verSms() {
        $.ajax({
            type: "POST",
            url: "{base_url}users/check_register_code",
            headers: {
                "Accept": "application/json",
            },
            data: {
                phone: Number(localStorage.getItem("ver-number")),
                confirm_code: $("#ver-sms").val()
            },
            success: function(result) {
                $(".efr3").hide();
                $(".efr4").css("display", "block");
                $(".validate-text").text("");
            },
            error: function(error) {
                $(".validate-text").text("Введен неправильный код.");
            }
        })
    }
    $(".user-info_ul a").on("click", function() {
        window.location.hash = "";
        window.location.href = `{base_url}index.php/main/user_info${this.dataset.hash}`
        $(".user-info_ul").find(".nav-item").removeClass("nav-item");
        $(this).parent().addClass("nav-item");
    });

    function onPost() {
        $.ajax({
            type: "POST",
            url: "{base_url}users/check_phone",
            headers: {
                "Accept": "application/json",
            },
            data: {
                phone: Number($("#tel-number").val())
            },
            success: function(result) {
                $('.efr2').css("display", "block");
                $('.efr1').css("display", "none");
            },
            error: function(error) {
                $('.efr3').css("display", "block");
                $('.efr1').css("display", "none");
                sendSms();
                userTimer();
            }
        })
    }

    function onRegister() {
        $.ajax({
            type: "POST",
            url: "{base_url}users/register",
            headers: {
                "Accept": "application/json",
            },
            data: {
                phone: Number(localStorage.getItem("ver-number")),
                password: $("#first-password").val()
            },
            success: function(result) {
                $.ajax({
                    type: "POST",
                    url: "{base_url}users/login",
                    headers: {
                        "Accept": "application/json",
                    },
                    data: {
                        phone: Number(localStorage.getItem("ver-number")),
                        password: $("#first-password").val()
                    },
                    success: function(result) {
                        $(".validate-text2").text("");
                        userInfo();
                    },
                    error: function(error) {
                        $(".validate-text2").text("Неправильный логин или пароль");
                    }
                })

                $(".enter-btn-bg").css("display", "none");
                $(".account-btn").css("display", "none");
                document.getElementById("account-wrap").style.display = "block";
                document.getElementById("account-wrap2").style.display = "block";
                // window.location.href = `{base_url}index.php/main/user_info#user-info`
            },
            error: function(error) {

            }
        })
    }
    $("#second-password").on('input', () => {
        if ($("#second-password").val() !== $("#first-password").val()) {
            $(".validate-text").text("Пароли не совпадают");
            $("#ef4").prop("disabled", true)

        } else {
            $(".validate-text").text("");
            $("#ef4").prop("disabled", false)

        }
    })

    $("#first-password").on('input', () => {
        if ($("#first-password").val() !== $("#second-password").val()) {
            $(".validate-text").text("Пароли не совпадают");
            $("#ef4").prop("disabled", true)

        } else {
            $(".validate-text").text("");
            $("#ef4").prop("disabled", false)

        }
    })

    $("#second-password2").on('input', () => {
        if ($("#second-password2").val() !== $("#first-password2").val()) {
            $(".validate-text").text("Пароли не совпадают");
            $("#ef7").prop("disabled", true)

        } else {
            $(".validate-text").text("");
            $("#ef7").prop("disabled", false)

        }
    })

    $("#first-password2").on('input', () => {
        if ($("#first-password2").val() !== $("#second-password2").val()) {
            $(".validate-text").text("Пароли не совпадают");
            $("#ef7").prop("disabled", true)

        } else {
            $(".validate-text").text("");
            $("#ef7").prop("disabled", false)
        }
    })

    // $("#form7").on('submit', (e) => {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "{base_url}users/forgot_password",
    //         headers: {
    //             "Accept": "application/json",
    //         },
    //         data: {
    //             phone: Number(localStorage.getItem("restore-phone")),
    //             password: $("#first-password2").val()
    //         },
    //         success: function(result) {

    //             $.ajax({
    //                 type: "POST",
    //                 url: "{base_url}users/login",
    //                 headers: {
    //                     "Accept": "application/json",
    //                 },
    //                 data: {
    //                     phone: Number(localStorage.getItem("restore-phone")),
    //                     password: $("#first-password2").val()
    //                 },
    //                 success: function(result) {
    //                     $(".validate-text2").text("");
    //                     userInfo();
    //                 },
    //                 error: function(error) {
    //                     $(".validate-text2").text("Неправильный логин или пароль");
    //                 }
    //             })

    //             $(".enter-btn-bg").css("display", "none");
    //             $(".account-btn").css("display", "none");
    //             document.getElementById("account-wrap").style.display = "block";
    //             document.getElementById("account-wrap2").style.display = "block";
    //         },
    //     })
    // })
    const __navItems = Array.from(document.querySelectorAll(" .navigation__content .navigation__item"));
    __navItems.forEach((link, ind) => {
        const elem = link.childNodes[1].src;
        link.addEventListener("click", function() {
            localStorage.setItem("iconItem", this.dataset.id)
            __navItems.forEach((link) => {
                link.childNodes[1].src = link.dataset.src;
            });
            link.childNodes[1].src = `{base_url}/img/inactive.icon${link.dataset.id}.svg`
        });
        if (link.dataset.id === localStorage.getItem("iconItem")) {
            link.childNodes[1].src = `{base_url}/img/inactive.icon${link.dataset.id}.svg`
        }
    })

    function onConfirm() {
        let closeBtn = confirm("Вы уверены? Все введенные данные стираются!");
        if (closeBtn) {
            window.location.reload();
        }
    }
    // $('.form-detail_validate').val('');
        // removeAll();
        function validate_chekout() {
        $('#form1').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 64,
                    minlength: 3
                }
            },
            submitHandler:function(form){
                onPost();
            }

        });
        $("#enter-password").on("input",function(){
            if($(this).val() !== ""){
                $(".validate-text2").text("");
            }
        })
        $('#form2').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 64,
                    minlength: 3
                }
            },
            submitHandler:function(form){
                $.ajax({
                    type: "POST",
                    url: "{base_url}users/login",
                    headers: {
                        "Accept": "application/json",
                    },
                    data: {
                        phone: Number(localStorage.getItem("ver-number")),
                        password: $("#enter-password").val()
                    },
                    success: function(result) {
                        $(".validate-text2").text("");
                        userInfo();
                    },
                    error: function(error) {
                        $(".validate-text2").text("Неправильный логин или пароль");
                    }
                });
            return false;
            }

        });

        $('#form4').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 64,
                    minlength: 3
                }
            },
            submitHandler:function(form){
                onRegister();
            }

        });

        $('#form5').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 64,
                    minlength: 3
                }
            },
            submitHandler:function(form){
                $.ajax({
                    type: "GET",
                    url: "{base_url}users",
                    headers: {
                        "Accept": "application/json",
                    },
                    success: function(result) {
                        if (result.filter(elem => elem.login === String(errorPhone.value)).length > 0) {
                            userTimer();
                            $(".efr5").css("display", "none");
                            $(".efr6").css("display", "block");
                            $(".validate-text5").text("");
                            localStorage.setItem("restore-phone", errorPhone.value);

                        } else {
                            $(".validate-text5").text("Нет такого пользователья");
                        }
                    },
                })

                $.ajax({
                    type: "POST",
                    url: "{base_url}/users/resend_sms",
                    headers: {
                        "Accept": "application/json",
                    },
                    data: {
                        phone: localStorage.getItem("restore-phone")
                    },
                    success(result) {
                        localStorage.setItem("res-sms", result);
                    }
                })
            return false;
            }

        });

        $('#form7').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 64,
                    minlength: 3
                }
            },
            submitHandler:function(form){
                $.ajax({
                    type: "POST",
                    url: "{base_url}users/forgot_password",
                    headers: {
                        "Accept": "application/json",
                    },
                    data: {
                        phone: Number(localStorage.getItem("restore-phone")),
                        password: $("#first-password2").val()
                    },
                    success: function(result) {

                        $.ajax({
                            type: "POST",
                            url: "{base_url}users/login",
                            headers: {
                                "Accept": "application/json",
                            },
                            data: {
                                phone: Number(localStorage.getItem("restore-phone")),
                                password: $("#first-password2").val()
                            },
                            success: function(result) {
                                $(".validate-text2").text("");
                                userInfo();
                            },
                            error: function(error) {
                                 $(".validate-text2").text("Неправильный логин или пароль");
                                
                            }
                        })

                        $(".enter-btn-bg").css("display", "none");
                        $(".account-btn").css("display", "none");
                        document.getElementById("account-wrap").style.display = "block";
                        document.getElementById("account-wrap2").style.display = "block";
                    },
                })
            return false;
            }

        });
        
    }
    validate_chekout();

    
</script>

<style>
    .enter-btn-bg {
        justify-content: center;
        align-items: center;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10000;
        background: red;
        width: 100vw;
        height: 100vh;
        background: #a8a8a8a8;
        transition: 1000ms;
        display: none;
    }

    .ver-form {
        display: none;
    }

    .pass-form {
        display: none;
    }

    .user-phone {}

    .verification-form {
        position: absolute;
    }

    .active-animation {
        animation: showOpacity 0.3s forwards alternate linear;
    }

    .disactive-animation {
        animation: hideOpacity 0.3s forwards alternate linear;
    }

    @keyframes showOpacity {
        from {
            opacity: 0.3;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes hideOpacity {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    body {
        margin: 0;
    }

    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .page-content {
        width: 100%;
        margin: 0 auto;
        display: flex;
        display: -webkit-flex;
        justify-content: center;
        -o-justify-content: center;
        -ms-justify-content: center;
        -moz-justify-content: center;
        -webkit-justify-content: center;
        align-items: center;
        -o-align-items: center;
        -ms-align-items: center;
        -moz-align-items: center;
        -webkit-align-items: center;
    }

    .form-v8-content {
        background: #fff;
        border-radius: 8px;
        -o-border-radius: 8px;
        -ms-border-radius: 8px;
        -moz-border-radius: 8px;
        -webkit-border-radius: 8px;
        margin: 177px 0;
        font-family: 'Source Sans Pro', sans-serif;
        color: #444444;
        position: relative;
        display: flex;
        display: -webkit-flex;
    }

    .form-v8-content .form-left {
        margin-bottom: -4px;
    }

    .form-v8-content .form-left img {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .form-v8-content .enter-form {
        position: relative;
        width: 100%;
        background: #fff;
        border-radius: 5px;
    }

    .form-v8-content .tab {
        margin: 5px 0 26px;
        width: 100%;
        display: flex;
        display: -webkit-flex;
        justify-content: space-between;
        -o-justify-content: space-between;
        -ms-justify-content: space-between;
        -moz-justify-content: space-between;
        -webkit-justify-content: space-between;
    }

    .form-check {
        padding: 10px 0 20px 0;
    }

    .form-v8-content .tab .tab-inner {
        width: 100%;
    }

    .form-v8-content .tab .tablinks {
        background: transparent;
        border: none;
        outline: none;
        -o-outline: none;
        -ms-outline: none;
        -moz-outline: none;
        -webkit-outline: none;
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 26px;
        font-weight: 400;
        color: #444;
        border-bottom: 3px solid;
        border-bottom-color: rgba(255, 255, 255, 0.2);
        width: 100%;
    }

    .form-v8-content .tab .tablinks.active {
        font-weight: 500;
        color: #444444;
        border-bottom-color: #4a4ac3;
    }

    .form-v8-content .form-row {
        width: 100%;
        position: relative;
        display: block;
    }

    .form-v8-content .form-row .form-row-inner {
        position: relative;
        /* display: flex; */
        justify-content: center;
        padding-bottom: 10px;
    }

    .form-v8-content .form-row .form-row-inner .label {
        position: absolute;
        top: -2px;
        left: 10px;
        font-size: 18px;
        color: #a8a8a8;
        padding: 10px;
        font-weight: 400;
        transform-origin: 0 0;
        transition: all .2s ease;
        -moz-transition: all .2s ease;
        -webkit-transition: all .2s ease;
        -o-transition: all .2s ease;
        -ms-transition: all .2s ease;
    }

    .forgot-pass_a a {
        color: #1EBEBE;
    }

    .text-label {
        padding: 10px 0;
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 16px;
        color: #A8A8A8;
    }

    .form-check {
        display: inline-block;
    }

    .form-check-input {
        display: flex;
        width: 20px !important;
        margin: 0 5px 5px 0;
    }

    .form-check-input:focus {
        box-shadow: none;
    }

    .form-check-label {
        padding: 0 30px;
        color: #A8A8A8;
    }

    .form-v8-content .form-row .form-row-inner .border {
        position: absolute;
        bottom: 31px;
        left: 0;
        height: 1px;
        width: 100%;
        background: #53c83c;
        transform: scaleX(0);
        -moz-transform: scaleX(0);
        -webkit-transform: scaleX(0);
        -o-transform: scaleX(0);
        -ms-transform: scaleX(0);
        transform-origin: 0 0;
        transition: all .15s ease;
        -moz-transition: all .15s ease;
        -webkit-transition: all .15s ease;
        -o-transition: all .15s ease;
        -ms-transition: all .15s ease;
    }

    .form-v8-content .form-detail .input-text {
        border: 1px solid #E0E0E0;
        border-radius: 3px;
        height: 45px;
        width: 350px;
        padding: 5px 0 0 20px;
    }
    .form-v8-content .form-detail .input-text {
        border: 1px solid #E0E0E0;
        border-radius: 3px;
        height: 45px;
        width: 350px;
        padding: 5px 0 0 20px;
    }

    .form-v8-content .form-detail input {
        width: 100%;
        border-bottom-color: rgba(255, 255, 255, 0.2);
        background: transparent;
        color: #333;
    }

    .enter-reg_btn {
        margin-right: 0 !important;
        width: 350px !important;
    }

    .form-v8-content .form-detail .enter {
        background: #1EBEBE;
        border-radius: 5px;
        color: #fff;
        width: 160px;
        height: 44px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 18px;
    }

    .form-v8-content .form-detail .register {
        border-radius: 5px;
        border: 1px solid #1EBEBE !important;
        color: #1EBEBE;
        width: 160px;
        height: 44px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 18px;
    }

    .form-v8-content .form-detail .enter-main {
        width: 100% !important;
        background: #1EBEBE;
        border-radius: 5px;
        color: #fff;
        height: 44px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 18px;
    }

    .form-v8-content .form-detail .enter:hover {
        background: #18A1A1;
        border-radius: 5px;
        color: #fff;
    }

    .form-v8-content .form-detail .register:hover {
        background: #1EBEBE;
        color: #fff;
    }

    .main-enter_btn {
        width: 100% !important;
    }

    /* Responsive */
    @media screen and (max-width: 991px) {
        .form-v8-content {
            margin: 180px 20px;
            flex-direction: column;
            -o-flex-direction: column;
            -ms-flex-direction: column;
            -moz-flex-direction: column;
            -webkit-flex-direction: column;
        }

        .form-v8-content .form-left {
            width: 100%;
        }

        .form-v8-content .form-left img {
            width: 100%;
            border-bottom-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .form-v8-content .enter-form {
            width: auto;
            border-top-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .form-v8-content .tab {
            margin-top: 45px;
        }

        .form-v8-content .form-detail .register {
            margin-bottom: 0px;
        }
    }

    @media screen and (max-width: 325px) {
        .form-v8-content .tab {
            flex-direction: column;
            -o-flex-direction: column;
            -ms-flex-direction: column;
            -moz-flex-direction: column;
            -webkit-flex-direction: column;
        }
    }

    .enter-btn-phone {
        padding: 45px;
        border-radius: 5px;
        justify-content: center;
        align-items: center;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10000;
        width: 100vw;
        height: 100vh;
        transition: 1000ms;
        display: none;

    }

    .enter-btn-password {
        padding: 45px;
        border-radius: 5px;
        justify-content: center;
        align-items: center;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10000;
        width: 100vw;
        height: 100vh;
        transition: 1000ms;
        display: none;

    }

    .enter-form_pass {
        box-shadow: 5px 5px 5px 5px #e5e5e5;
        padding: 20px 40px;
        border-radius: 5px;
    }

    .ok-btn {
        background: #1EBEBE;
        padding: 10px 45px;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
    }

    .ok-btn input {
        color: #fff !important;
    }

    .ok-btn:hover {
        background: #18A1A1;
        color: #fff !important;
    }

    .ok-btn input:hover {
        color: #fff !important;
    }
</style>