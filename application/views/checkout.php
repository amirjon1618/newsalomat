<main class="ps-page--my-account" id="checkout_main_tag">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{base_url}">Главная</a></li>
                <li><a href="{base_url}index.php/main/cart_shopping">Корзина</a></li>
                <li>Информация по доставке </li>
            </ul>
        </div>
    </div>
    <section class="ps-section--account ps-checkout">
        <div class="container">
            <div class="ps-section__header">
                <h3>Информация по доставке</h3>
                <img class="img-fluid" src="/img/status-order2.svg" alt="- -">
            </div>
            <div class="ps-section__content">
                <form class="ps-form--checkout">
                    <div class="ps-form__content">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                                <?php if (!$bUser) : ?>
                                    <div class="ps-form__billing-info">
                                        <div class="delivery-form">
                                            <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 p-0">
                                                <div class="form-group pr-3">
                                                    <label>Имя Фамилия <span class="red-star">*</span></label>
                                                    <input class="form-control" maxlength="24" required pattern="\d*" name="name" value="<?php echo $name ?>" id="order_name" type="text" placeholder="Имя Фамилия">
                                                </div>
                                                <div class="form-group pr-3">
                                                    <label>Дом <span></span></label>
                                                    <input class="form-control" id="building" maxlength="250" type="text" placeholder="Дом">
                                                </div>
                                                <div class="form-group pr-3">
                                                    <label>Номер телефона <span class="red-star">*</span></label>
                                                    <input class="form-control" required type="text" pattern="\d*" maxlength="9" value="<?php echo $phone ?>" id="order_phone" name="cell_phone" placeholder="Введите свой номер">
                                                </div>
                                            </div>
                                            <div class="form-input col-xl-6 col-lg-6 col-md-12 col-sm-12 p-0">
                                                <div class="form-group">
                                                    <label>Улица <span class="red-star">*</span></label>
                                                    <input class="form-control" maxlength="250" required name="address" value="<?php echo $address ?>" id="order_address" type="text" placeholder="Улица">
                                                </div>

                                                <div class="form-group">
                                                    <label>Ориентир</label>
                                                    <input class="form-control" id="landmark" maxlength="250" type="text" placeholder="Ориентир">
                                                </div>
                                                <div class="form-group">
                                                    <label>Телефон, если не дозвонимся</label>
                                                    <input class="form-control" required type="text" maxlength="9" id="order_phone2" name="cell_phone" placeholder="Введите свой номер">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-12 p-0">
                                            <label>Комментарии</label>
                                            <textarea class="form-control" maxlength="250" name="comment" id="order_comment" type="text" placeholder="Дополнительные пожелания"></textarea>
                                        </div>
                                    </div>
                                    <div class="checkout_min_sum_div" style="display: none;">
                                        <h4 style="color: #4d4dbf;font-size:16px">Минимальная сумма должна быть 35 сомони</h4>
                                    </div>
                                <?php else : ?>
                                    <div class="checkout_ecom_div">
                                        <h4 class="checkout_ecom_type_title">Метод оплаты</h4>
                                        <div class="checkout_bInfo">
                                            <div class="checkout_bRadio_div">
                                                <span class="checkout_bRadio_span">
                                                </span>
                                            </div>
                                            <label for="bWallet" class="checkout_bWallet_label">MyBabilon
                                                <img class="w-auto wlogo" src="{base_url}img/online_wallet/babilon-m.png" alt="MyBabilon">
                                            </label>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="checkout_min_sum_div" style="display: none;">
                                        <h4 style="color: #4d4dbf;font-size:16px">Минимальная сумма должна быть 35 сомони</h4>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" style="padding: 0 10px;">
                                <div class="ps-block--checkout-order">
                                    <div class="ps-block__content">
                                        <div class="ps-block__content-padding">
                                            <figure class="product-form_text">
                                                <figcaption><strong>Товар</strong><strong>Всего</strong></figcaption>
                                            </figure>
                                            <figure class="ps-block__items" id="prod_list_checkout">
                                                <!--PRODUCT LIST -->

                                            </figure>
                                        </div>
                                        <figure class="subtotal-form_text">
                                            <figcaption><strong>Промежутечный итог</strong><strong id="prod_tot_pr_checkout"></strong>
                                            </figcaption>
                                        </figure>
                                        <div class="ps-block__content-padding">
                                            <figure class="delivery-figure product-form_text">
                                                <figcaption><strong>Доставка</strong></figcaption>
                                                {delivery}
                                                <div class="delivery-div">
                                                    <input type="radio" name="delivery" id="{delivery_id}" value="{delivery_price}">
                                                    <label for="{delivery_id}">{delivery_name} - <span style="font-weight: bold;">{delivery_price} смн.</span></label><br>
                                                </div>
                                                {/delivery}
                                            </figure>
                                            <figure class="total-form_figure">
                                                <figcaption><strong class="total-form_text">Общая сумма</strong><strong id="tot_pr_checkout" class="total-form_text"></strong></figcaption>
                                            </figure>
                                        </div>




                                        <!-- <figure class="ps-block__shipping">
                                            <h3>Способ оплаты</h3> -->
                                        <!-- <input type="radio" name="payment" id="pay_cash" value="cash">
                                            <label for="pay_cash">Наличными при получении</label><br>
                                            <input type="radio" name="payment" id="pay_app" value="app">
                                            <label for="pay_app">Мобильный кошелёк alif </label> -->
                                        <!-- </figure> -->
                                        <?php if ($bUser) : ?>
                                            <div class="checkout_bContinue_div">
                                                <button class="checkout_bContinue_btn" onclick="startTrans()">Продолжить</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <input onclick="javascript: (localStorage.getItem('userId')) ? startTrans() : onPsBlockRight()" type="submit" style="height: 4em" value="Оформить заказ" class="ps-btn ps-btn--fullwidth">
                                    <div class="order-sended h-100 align-items-center justify-content-center">
                                        <div class="order-sended-modal align-items-center justify-content-center">
                                            <div class="page-content">
                                                <div class="form-v8-content">
                                                    <div class="enter-form text-center">
                                                        <div class="enter-form_reg efr1">
                                                            <div class="tab">
                                                                <div class="tab-inner pb-5">
                                                                    <img src="{base_url}img/order-send-corect.png" alt="icon">
                                                                </div>
                                                            </div>
                                                            <div class="tab-inner_text">
                                                                <h3 style="font-size: 22px; font-weight: 700;">Всё готово</h3>
                                                                <p style="width: 300px; color: #AAABAD;">Наш специалист свяжится с вами в ближайшее время.</p>
                                                                <p style="color: #AAABAD;">Спасибо за покупку.</p>
                                                                <input style="height: 4em; border-color: #A8A8A8; border-radius: 5px; padding: 10px 0;" value="" class="ps-btn_order text-center">

                                                            </div>
                                                            <form class="form-detail">
                                                                <div class="tabcontent d-flex justify-content-center" id="sign-phone">
                                                                    <div class="form-row-last text-center">
                                                                        <a href="/" style=" height: 3em; color: #fff; font-size: 18px; font-weight: 500; padding: 15px 35px 15px 35px;" class="ps-btn"><img style="padding-right: 10px;" src="{base_url}img/order-send-arrow.svg" alt=""> На главную</a>
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>


<div id="back2top"><i class="pe-7s-angle-up"></i></div>
<div class="ps-site-overlay"></div>

<div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content">
        <form class="ps-form--primary-search" action="do_action" method="post">
            <input class="form-control" type="text" placeholder="Поиск по...">
            <button><i class="aroma-magnifying-glass"></i></button>
        </form>
    </div>
</div>


<div class="modal fade" id="confirmCartModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal_close_btn close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <div class="recipe_phone_div" id="confirm_div">
                    <div class="recipe_phone_div_inp">
                        <h5>Вам отправлено SMS с кодом подтверждения</h5>
                        <input type="text" id="confirm_inp_checkout" class="recipe_phone_code" placeholder="Введите код">
                        <div id="not_found_checkout">
                            <p>Неверный код</p>
                        </div>
                    </div>
                    <h5 id="not_received_sms_order">Не получили SMS? <span class="resend_code" onclick="orderResendSms()">Отправить ещё раз</span></h5>
                    <h5 id="recend_timer_sms_order">Вы можете переотправить sms через <span id="timer_order"></span></span></h5>
                    <button class="recipe_phone_div_button_confirm_sms confirm_btn_checkout">
                        Потдвердить
                        <!-- <div class="spinner-border text-light" id="review_spinner" style="margin-left:10px;display:none" role="status"> -->
                        <!-- <span class="sr-only">Loading...</span> -->
                        <!-- </div> -->
                    </button>
                </div>


                <!-- <div id="confirm_div">
                    <label for="confirm_inp">Введите код</label>
                    <input type="text" id="confirm_inp">
                    <p id="not_found">Не найдено</p>
                    <button class="btn btn-primary confirm_btn">
                        Подтвердить
                        <div class="spinner-border text-light" id="review_spinner" style="margin-left:10px;display:none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div id="checkout_loading" style="display: none;">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<script src="{base_url}plugins/jquery.form.validation.min.js"></script>
<script src="{base_url}js/jquery.validate.min.js"></script>
<script src="{base_url}js/form_validation_messages_ru.js"></script>
<script>
    var orderCode = null;
    var orderId = null;
    var bUserInfo = <?= $bUserInfo; ?>;

    function goHome() {
        url = "<?= $base_url ?>index.php/main";
        $(location).attr("href", url);
    }

    function validate_chekout() {
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $('.ps-form--checkout').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 80,
                    minlength: 3
                },
                address: {
                    required: true,
                    maxlength: 250,
                    minlength: 3
                },

                comment: {
                    required: false,
                    maxlength: 250
                },
                delivery: {
                    required: true
                },
                cell_phone: {
                    required: true,
                    number: true,
                    minlength: 9,
                    maxlength: 9
                },
            },


            messages: {
                cell_phone: {
                    required: "Ввeдите ваш номер телефона без +992",
                },
                terms_conditions: "",
                delivery: {
                    required: "Выберите тип доставки"
                }
            },
            //     name:  {
            //         required: "Пожалуйста вводите имя",
            //         maxlength: jQuery.validator.format("Пожалуйста введите не больше {0} знаков"),
            //     },
            //     surname:  {
            //         required: "Пожалуйста вводите фамилию",
            //         maxlength: jQuery.validator.format("Пожалуйста введите не больше {0} знаков"),
            //     },

            //     landmark: jQuery.validator.format("Пожалуйста введите не больше {0} знаков"),
            //     comment: jQuery.validator.format("Пожалуйста введите не больше {0} знаков"),
            //     address:  { 
            //         required: "Пожалуйста вводите аддресс",
            //         maxlength: jQuery.validator.format("Пожалуйста введите не больше {0} знаков"),
            //     }
            errorPlacement: function(error, element) {
                if (element.is(":radio")) {
                    error.appendTo(element.parents('.delivery-figure'));
                } else { // This is the default behavior 
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                alert('1');
                order_confirm();
            }

        });
    }

    function set_pr_checkout() {
        $('#prod_list_checkout').html('');
        $('#prod_tot_pr_checkout').text('');
        $('#tot_pr_checkout').text('');
        if (localStorage.getItem("product_list")) {
            var mydata = JSON.parse(localStorage.getItem("product_list"));
            var sum = 0;
            var variant = 0;
            mydata.forEach(function(item, index) {
                var html = "<a href=\"<?= $base_url ?>index.php/main/product/" + item.product_id + "\"><strong>" + item.product_name + "</strong><div style='display: flex; justify-content: space-between;'><span style='margin-left:10px;'>x" + item.product_count + "</span>" +
                    "<small style='margin-left:10px'> " + item.product_price + "</small></div>" +
                    "</a>";
                variant += (item.product_count * item.product_price)
                sum = Number(localStorage.getItem("promocode_discount")) || variant;
                $('#prod_list_checkout').append(html);
            });
            $('#prod_tot_pr_checkout').text(Math.round(sum) + ' сом.');
            countSumWithDelivery();
        }
    }

    function total_sum() {
        if (localStorage.getItem("product_list")) {
            var mydata = JSON.parse(localStorage.getItem("product_list"));
            var cart_total_sum = 0;
            mydata.forEach(function(item, index) {
                cart_total_sum += (item.product_count * item.product_price);
            });
            if (cart_total_sum < 35) {
                // if (false) {
                $(".checkout_ecom_div").hide();
                $(".ps-form__billing-info").hide();
                $(".checkout_min_sum_div").show();
                $(".checkout_bContinue_div").hide();
            } else {
                $(".checkout_ecom_div").show();
                $(".ps-form__billing-info").show();
                $(".checkout_min_sum_div").hide();
                $(".checkout_bContinue_div").show();
            }
        }
    }

    function order_confirm() {
        var form = $('.ps-form--checkout');
        form.validate();
        if (!$('#save-next-time').is(':checked')) {
            $('label[for="save-next-time"]').css('color', 'red');
        }
        if (form.valid()) {
            if (localStorage.getItem("product_list")) {
                $('#checkout_loading').css('display', 'block');
                var mydata = JSON.parse(localStorage.getItem("product_list"));
                var phone_number = $('#order_phone').val();
                var phone_number2 = $('#order_phone2').val();
                var name = $('#order_name').val();
                var address = $('#order_address').val();
                var landmark = $('#landmark').val();
                var building = $('#building').val();
                var comment = $('#order_comment').val();
                var delivery_id = $('input[name=delivery]:checked').attr("id")
                // var cash_type = $('input[name=payment]:checked').val() ?? '';

                $.post("<?= $base_url; ?>index.php/main/confirmOrder", {
                    "phone_number": phone_number,
                    "phone_number2": phone_number2,
                    "name": name,
                    "product_total_count": 2,
                    "address": address + landmark + building,
                    "comment": comment,
                    "delivery_id": delivery_id,
                    // "cash_type": cash_type,
                    "products": mydata
                }, function(data) {
                    if (data.answ == 1) {
                        orderCode = data.order_code;
                        orderId = data.order_id;
                        begin();
                        $('#confirmCartModal').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        })

                        $('#checkout_loading').css('display', 'none');
                    } else {
                        $('#checkout_loading').css('display', 'none');
                        alert('Пожалуйста заполните все поля правильно');
                    }
                }, "json");
            } else {
                $('#checkout_loading').css('display', 'none');
                alert('Корзина пуста!');
            }
            set_pr_checkout();
            set_prods_header();
        }
    }

    function checked_terms_conditions() {
        $("#save-next-time").change(function() {
            if (this.checked) {
                $('label[for="save-next-time"]').css('color', 'rgba(0, 0, 0, 0.5)');
            } else {
                $('label[for="save-next-time"]').css('color', 'red');
            }
        });
    }

    function confirmOrder() {
        $('.confirm_btn_checkout').on('click', function() {
            $('#checkout_loading').show();
            $('.confirm_btn_checkout').attr('disabled', true);
            var $this = $('#confirm_inp_checkout');
            $.getJSON("<?= base_url() ?>index.php/main/checkOrderCode", {
                order_code: $this.val(),
                order_id: orderId,
                order_phone: $('#order_phone').val()
            }, function(data, status) {
                if (data.stat == 1) {
                    // $.removeCookie('product_list', {
                    //     path: '/'
                    // });
                    localStorage.removeItem("product_list")
                    $('#confirm_div').html('');
                    var html =
                        "<i class=\"fa fa-check-square-o\" id=\"success_icon\"></i>" +
                        "<h4 class=\"text-muted\">Ваш заказ принят!</h4>" +
                        "<p><strong>Мы свяжемся с Вами в ближайшее время.</p>" +
                        "<div class=\"order_numb_div\"> Номер заказа <span style=\"color:#3c3a3a\">#" + data.order.id + "</span></strong> </div>" +
                        "<br />";

                    html += "<a onclick=\"go_to_main()\" style='cursor:pointer'>На главную страницу</a>";
                    // change_order_status();

                    $('.modal_close_btn').hide();

                    $('#confirm_div').append(html);

                    $('#not_found_checkout').hide();
                    $('#checkout_loading').hide();

                } else {
                    $('#checkout_loading').hide();
                    $('.confirm_btn_checkout').removeAttr('disabled');

                    $('#not_found_checkout').show();
                }
            });
        });
    }

    function begin() {
        $('#not_received_sms_order').hide();
        $('#recend_timer_sms_order').show();

        timing = 60;
        $('#timer_order').html(timing);
        myTimer = setInterval(function() {
            --timing;
            $('#timer_order').html(timing);
            if (timing === 0) {
                $('#recend_timer_sms_order').hide();
                $('#not_received_sms_order').show();
                clearInterval(myTimer);
            }
        }, 1000);
    }

    function orderResendSms() {
        $('#checkout_loading').show();
        $.ajax({
            url: "<?= base_url() ?>index.php/main/orderResendSms",
            type: "POST",
            dataType: "json",
            data: {
                "order_phone": $('#order_phone').val(),
                "order_id": orderId
            },
            success: function(data) {
                begin();
                if (data == 1) {
                    $('#checkout_loading').hide();
                } else {
                    setTimeout(function() {
                        alert('Произошла ошибка!');
                    }, 5);
                }
            }
        });
    }

    function change_order_status() {
        $.ajax({
            url: "<?= base_url() ?>index.php/api/changeOrderStatus",
            type: "POST",
            dataType: "json",
            data: {
                "order_id": orderId,
                "status_id": 1,
            },
            success: function(data) {}
        });
    }

    function go_to_main() {
        var url = "<?= base_url() ?>";
        $(location).attr("href", url);
    }

    function startTrans() {

        var checkedDel = false;
        $.each($('input[name=delivery]'), function(index, value) {
            if ($(value).prop("checked")) {
                checkedDel = true;
            }
        });
        if (checkedDel) {
            if (localStorage.getItem("product_list")) {
                $('#checkout_loading').css('display', 'block');
                // var mydata = JSON.parse(localStorage.getItem("product_list"));
                var mydata = JSON.parse(localStorage.getItem("product_list"));
                var phone_number = $('#order_phone').val();
                var phone_number2 = $('#order_phone2').val();
                var name = $('#order_name').val();
                var address = $('#order_address').val();
                var landmark = $('#landmark').val();
                var building = $('#building').val();
                var comment = $('#order_comment').val();
                var totalPrice = $('#tot_pr_checkout');
                var delivery_id = $('input[name=delivery]:checked').attr("id")
                $.post("<?= $base_url; ?>index.php/main/createOrder", {
                    "total_price": totalPrice[0].textContent.split(' ')[0],
                    "phone_number": phone_number,
                    "phone_number2": phone_number2,
                    "name": name,
                    "product_total_count": 2,
                    "address": address + ' ' + building + ' Ориентир: ' + landmark,
                    "comment": comment,
                    "delivery_id": delivery_id,
                    // "cash_type": cash_type,
                    "products": mydata,
                    "wallet_name": "MyBabilon",
                    // "delivery_id": $('input[name=delivery]:checked').attr("id")
                }, function(data) {
                    $(".ps-btn_order").val("Номер заказа № " + data)
                    $(".order-sended").css("display", "flex")
                    if (data != 0) {
                        $('#checkout_loading').css('display', 'none');
                        // $.removeCookie('product_list', {
                        //     path: '/'
                        // });
                        localStorage.removeItem("product_list");
                        $(".checkout_bContinue_div").hide();
                        $(".checkout_ecom_div").append(`<h4>Пожалуйста подождите</h4>`);
                        $("#checkout_main_tag").append(inputForB);
                    } else {
                        $('#checkout_loading').css('display', 'none');
                        alert('Произошла ошибка, попробуйте позже');
                    }
                }, "json");
            } else {
                $('#checkout_loading').css('display', 'none');
                alert('Корзина пуста!');
            }
        } else {
            $('.delivery-figure').css("border-bottom", "2px solid red");
            // $('.delivery-figure').append("Пожалуйста выберите доставку.")
        }
    }

    function countSumWithDelivery() {
        $('input[type=radio][name="delivery"]').change(function() {
            $('.delivery-figure').css("border-bottom", "1px solid #eaeaea");
            if (localStorage.getItem("product_list")) {
                var mydata = JSON.parse(localStorage.getItem("product_list"));
                var sum = 0;
                var variant = 0;
                mydata.forEach(function(item, index) {
                    variant += (item.product_count * item.product_price)
                    sum = Number(localStorage.getItem("promocode_discount")) || variant;
                });
                sum += ($('input[name=delivery]:checked').val() ? parseInt($('input[name=delivery]:checked').val()) : 0);
                $('#tot_pr_checkout').text(Math.round(sum) + ' смн.');
            }
        });
    }

    $(document).ready(function() {
        if (!localStorage.getItem("product_list")) {
            url = "<?= $base_url ?>index.php/main";
            $(location).attr("href", url);
        }
        countSumWithDelivery();
        total_sum();
        checked_terms_conditions();
        validate_chekout();
        set_pr_checkout();
        confirmOrder();
        $('#not_found_checkout').hide();
    })
</script>

<style>
    .order-sended {
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

    .order-sended-modal {
        background-color: #fff;
        padding: 45px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px 5px #e5e5e5;
        height: 600px;
        width: 500px;
        display: flex;
    }

    .ps-btn_order {
        border: 1px solid #A8A8A8;
        background: none;
        color: #222222;
    }

    .ps-btn_order:hover {
        border: 1px solid #A8A8A8;
        background: none;
        color: #222222;
    }
</style>