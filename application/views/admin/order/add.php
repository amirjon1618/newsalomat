<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{base_url}admin/orders"><i class="fa fa-list"></i> Заказы</a></li>
        <li class="active">Добавить</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary" id="add-order-box-div">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form class="add_order_form">
                    <div class="form-group add_order_prod_div">
                            <label for="order_srch_pr">Добавьте лекарство в список</label>
                            <input name="order_srch_pr" type="text" class="form-control" id="order_srch_pr" placeholder="Поиск...">
                            <div class="form-control order_prod_srch_res" style="height: max-content;display:none">

                            </div>
                            <div class="prods">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Кол-во</th>
                                        <th>Цена</th>
                                        <th>Сумма</th>
                                        <th>Удалить</th>
                                    </thead>
                                    <tbody class="order_prods_table_body">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Введите номер телефона</label>
                            <input class="form-control" required type="text" pattern="\d*" maxlength="9" id="order_phone" name="cell_phone" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Имя и Фамилия</label>
                            <input class="form-control" maxlength="80" required name="name" id="order_name" type="text" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Введите улицу, дом и номер квартиры, куда доставлять</label>
                            <input class="form-control" maxlength="250" required name="address" id="order_address" type="text" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Комментарий к заказу</label>
                            <textarea class="form-control" maxlength="250" name="comment" id="order_comment" type="text" placeholder=""></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="product-type">Тип оплаты </label>
                            <select class="form-control" name="payment" id="payment">
                                <option value="">Выберите ...</option>
                                <option value="cash">Наличными</option>
                                <option value="app">Через алиф моби</option>
                            </select>
                        </div> -->
                        <div class="box-footer">
                            <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/orders'" class="btn btn-default">
                                Отмена
                            </button>
                            <input onclick="addOrder()" type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                        </div>
                    </form>
                    <div id="order_confirm_code_main_div" style="display:none;">
                        <div id="confirm_div_order_add">
                            <label for="confirm_inp">Введите код</label>
                            <input max="4" type="number" id="confirm_inp">
                            <p id="not_found">Не найдено</p>
                            <button onclick="checkOrderCode()" class="btn btn-primary confirm_btn">
                                Подтвердить
                                <div class="spinner-border text-light" id="review_spinner" style="margin-left:10px;display:none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
    <div id="order_add_confirm_loading" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</section>

<!-- Bootstrap WYSIHTML5 -->
<script>
    var prods = [];
    var order_id = null;
    var order_phone = null;

    function searchProds() {
        $('#order_srch_pr').keyup(function() {
            $('.order_prod_srch_res').hide();
            $('.order_prod_srch_res').html('');
            $.getJSON("{base_url}index.php/main/search_product?q=" + $('#order_srch_pr').val(),
                function(data, status) {
                    var prodsHtml;
                    $('.order_prod_srch_res').show();
                    $('.order_prod_srch_res').html('');
                    if (data.length > 0) {
                        $.each(data, function(ind, el) {
                            prodsHtml =
                                "<div class=\"order_srch_each_prod\" onclick='addProd(" + JSON.stringify(el) + ")'>" +
                                "<b>" + el.product_name + "</b>";
                                if (el.total_count_in_store < 0) {
                                    prodsHtml += "<h5 style=\"color: red;font-weight:bold;\">Нет в наличии</h5>"
                                } else {
                                    prodsHtml += "<h5 style=\"color: green;font-weight:bold;\">В наличии " + el.total_count_in_store + " штук</h5>"
                                }
                                "</div>";
                            $('.order_prod_srch_res').append(prodsHtml);
                            if (ind != data.length - 1) {
                                $('.order_srch_each_prod').css('border-bottom', '1px solid #e1e1e1');
                            }
                        })
                    } else {
                        $('.order_prod_srch_res').append("<b> Ничего не найдено...</b>");
                    }
                }
            );
        })
    }

    function addProd(el) {
        var prodHtml =
            "<tr id=selected_prod" + el.id + ">" +
            "   <td>" + el.id + "</td>" +
            "   <td>" + el.product_name + "</td>" +
            "   <td>" +
            "       <input onchange='change_count_prod(" + JSON.stringify(el) + ")' id=\"order_prod_count_"+ el.id +"\" type=\"text\" value=\"1\" name=\"order_prod_count[]\">" +
            "   </td>" +
            "   <td>" + el.product_price + "</td>" +
            "   <td id=\"prod_sum_"+ el.id +"\">"+ el.product_price +"</td>" +
            "   <td>" +
            "       <i class=\"fa fa-remove\" style=\"font-size: 24px;color:red;cursor:pointer\" onclick=\"removeProdFromSelected(" + el.id + ")\"></i>" +
            "   </td>" +
            "</tr>";
            countSum(el.id, el.product_price)
        if ($('.order_prods_table_body').find('#selected_prod' + el.id).length) {
            var count = $('#selected_prod' + el.id).find('#order_prod_count_' + id);
            count.val(parseInt(count.val()) + 1);
            // if (parseInt(count.val()) < el.total_count_in_store) {
            //     count.val(parseInt(count.val()) + 1);
            // }
            prods.forEach(function(item, index) {
                if (item.id == el.id) {
                    item.count = parseInt(count.val());
                }
            });
        } else {
            $('.order_prods_table_body').append(prodHtml);
            el.count = 1;
            prods.push(el);
        }
        $('.order_prod_srch_res').hide();
    } 
    function countSum(id, price) {
        let pr = parseInt($('#order_prod_count_' + id).val());
        let sum = (parseInt(price) * (isNaN(pr)? 1: pr));
        $('#prod_sum_' + id).text('' + sum);
    }
    function change_count_prod(el) {
        var inp = $('#selected_prod' + el.id).find('#order_prod_count_' + el.id);
        // if (inp.val() < 1 || !$.isNumeric(inp.val())) {
        //     el.count = 1;
        //     inp.val(1);
        // } else if (parseInt(inp.val()) > parseInt(el.total_count_in_store)) {
        //     el.count = el.total_count_in_store;
        //     inp.val(el.total_count_in_store);
        // } else {
        //     el.count = inp.val();
        // }
        if (parseInt(inp.val()) > 0) {
            el.count = inp.val();
        }else {
            el.count = 1;
            inp.val(1);
        } 
        inp.val(el.count);
        prods.forEach(function(item, index) {
            if (item.id == el.id) {
                prods[index] = el;
            }
        })
        countSum(el.id, el.product_price);
    }

    function removeProdFromSelected(id) {
        $('#selected_prod' + id).remove();
        prods.forEach(function(item, index) {
            if (item.id == id) {
                prods.splice(index, 1);
            }
        })
    }

    function addOrder() {
        var form = $('.add_order_form');
        form.validate();
        if (form.valid()) {
            if (prods.length != 0) {
                $('#order_add_confirm_loading').css('display', 'block');
                var phone_number = $('#order_phone').val();
                var name = $('#order_name').val();
                var address = $('#order_address').val();
                var comment = $('#order_comment').val();
                $.post("<?= $base_url; ?>index.php/admin/addOrderConfirm", {
                    "phone_number": phone_number,
                    "name": name,
                    "address": address,
                    "comment": comment,
                    // "cash_type": cash_type,
                    "products": prods
                }, function(data) {
                    if (data.answ == 1) {
                        order_id = data.order_id;
                        order_phone = data.order_phone;
                        $('.add_order_form').hide();
                        $('#order_confirm_code_main_div').show();
                        $('#order_add_confirm_loading').hide();
                    } else {
                        $('#order_add_confirm_loading').hide();
                        alert('Пожалуйста заполните все поля правильно');
                    }
                }, "json");
            } else {
                alert('Пожалуйста сперва выберите товар!');
            }
        }
    }

    function checkOrderCode() {
        $('#review_spinner').show();
        $('.confirm_btn').attr('disabled', 'disabled');
        var $this = $('#confirm_inp');
        $.getJSON("<?= base_url() ?>index.php/main/checkOrderCode", {
            order_code: $this.val(),
            order_id: order_id,
            order_phone: order_phone
        }, function(data, status) {
            if (data.stat == 1) {
                $('#confirm_div_order_add').html('');
                var html =
                    "<i class=\"fa fa-check-square-o\" id=\"success_icon\"></i>" +
                    "<h4 class=\"text-muted\">Заказ успешен</h4>" +
                    "<p><strong>Товары</strong></p>" +
                    "<hr>";
                var tot_sum = 0;
                $.each(data.products, function(i, el) {
                    html += `<p style="text-align:start"><strong>${el.product_name}</strong><span style="margin-left:25px;float:right">${el.total_count}x${el.product_price} = ${el.total_count * el.product_price} смн.</span>`;
                    tot_sum += el.total_count * el.product_price;
                });
                html += "<hr>" +
                    `<p style="text-align:start"><strong>Итого: </strong><span style="float:right">${tot_sum} смн.</span></p>`;
                $('#confirm_div_order_add').append(html);
                $('#not_found').hide();
            } else {
                $('#review_spinner').hide();
                $('.confirm_btn').removeAttr('disabled');

                $('#not_found').show();
            }
        });
    }

    function validate_order_add() {
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $('.add_order_form').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true,
                    maxlength: 64,
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
                cell_phone: {
                    required: true,
                    number: true,
                    minlength: 9,
                    maxlength: 9
                },
                order_srch_pr: {
                    required: false,
                },
            },
            messages: {
                cell_phone: {
                    required: "Пожалуйста ввeдите ваш номер телефона без +992",
                },
                terms_conditions: "",
            },
            errorPlacement: function(error, element) {
                // if (element.is(":radio")) {
                //     error.appendTo(element.parents('.ps-block__shipping'));
                // } else { // This is the default behavior 
                //     error.insertAfter(element);
                // }
            },
            submitHandler: function(form) {
                order_confirm();
            }

        });
    }

    $(document).ready(function() {
        $('#not_found').hide();
        prods = [];
        searchProds();
        validate_order_add();
        $("form").submit(function(e) {});
        $(document).click(function(event) {
            if (!$(event.target).is("#order_srch_pr, .order_prod_srch_res, .order_prod_srch_res div, .order_prod_srch_res div b, .order_prod_srch_res div i")) {
                $(".order_prod_srch_res").css('display', 'none');
                $(".order_prod_srch_res").html('');
            }
        });
    });
</script>