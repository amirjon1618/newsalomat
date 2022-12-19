<div class="container main-mycart p-0">
    <div class="parent-mycart">
        <div class="mycart col-lg-8 col-md-6 col-sm-12 col-xs-12 p-0">
            <div class="ps-section--shopping ps-shopping-cart">
                <div class="">
                    <div class="ps-section__header">
                        <h3>Корзина</h3>
                        <img class="img-fluid" src="/img/status-order.svg" alt="- -">
                    </div>
                    <div class="board-show">
                        <div class="toast-body my-5" style="text-align:center;">
                            <img class="mb-5" src="{base_url}img/cart-icon.svg" alt="Cart">
                            <h3 class="mb-3" style="color: #6D6D6D; font-size: 16px; ">Ваша корзина пуста</h3>
                            <p>для совершения покупки воспользуйтесь каталогом товаров</p>
                        </div>
                    </div>
                    <div class="ps-section__content">
                        <div class="table-responsive" id="table-scroll">
                            <table class="table ps-table--shopping-cart mb-5">
                                <thead class="shopping-cart_th">
                                    <tr>
                                        <th>Товар</th>
                                        <th>Цена</th>
                                        <th>Кол-во</th>
                                        <th>Итого</th>
                                    </tr>
                                </thead>
                                <tbody class="pr-list">
                                    <!--PRODUCT LIST-->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mycart col-lg-4 col-md-6 col-sm-12 col-xs-12" style="display: flex; justify-content: center; align-items: center; padding-top: 8%;">
            <div class="ps-page--simple">
                <div class="ps-section--shopping ps-shopping-cart">
                    <div class="order-content">
                        <div class="ps-section__content ps-section__border">
                            <div class="ps-section__header">
                                <h3 class="fw-bold">Ваш заказ</h3>
                            </div>
                            <div class="price-product px-3 justify-content-between">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="border-0 fw-bolder table-text-bold" style="font-weight: 500;">Стоимост товаров: </td>
                                            <td class="border-0 table-text-end table-text-bold"><span class="number-currency"> </span><span class="text-currency"> смн.</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="px-3">
                                <table class="table py-5 justify-content-between">
                                    <tbody>
                                        <tr>
                                            <td class="border-0 table-text-bold" style="font-weight: 500;">Итого: </td>
                                            <td class="border-0 table-text-end table-text-bold"><span class="number-currency_total"> </span><span class="text-currency"> смн.</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="price-text px-4 pb-4">
                                <input type="text" name="promo_code" id="promo_code" class="border price-text__input" placeholder="Активировать промо код">
                                <button class="price-text__btn" onclick="onPromoCode()"><img src="{base_url}img/right-arrow.svg" alt=""></button>
                            </div>

                        </div>
                        <div class="ps-section__cart-actions">
                            <a class="ps-btn ps-btn--outline checkout" onclick="orderCheckout()" href="{base_url}index.php/main/checkout">
                                Оформить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    if (!localStorage.getItem("product_list")) {
        $(".board-show").show();
        $(".order-content").addClass("mob-order-content");
    } else {
        $(".board-show").hide();
    }

    function decrease_count_cart(id) {

        var mydata = $.parseJSON(localStorage.getItem("product_list"));
        mydata.forEach(function(item, index) {
            if (item.product_id == id) {
                item.product_count--;
                if (item.product_count < 1) {
                    item.product_count = 1;
                }
                mydata[index] = item;
                // $.cookie("product_list", JSON.stringify(mydata), {
                //     path: '/'
                // });
                localStorage.setItem("product_list", JSON.stringify(mydata))
                $('#count_input_ps' + id).val(item.product_count);
            }
        });
        product_list();
        set_prods_header();

    }

    function increase_count_cart(id) {
        var mydata = $.parseJSON(localStorage.getItem("product_list"));
        mydata.forEach(function(item, index) {
            if (item.product_id == id) {
                item.product_count++;
                // if (item.product_count > item.product_total_count) {
                //    item.product_count = item.product_total_count;
                // }
                mydata[index] = item;

                localStorage.setItem("product_list", JSON.stringify(mydata))
                $('#count_input_ps' + id).val(item.product_count);
            }
        });
        product_list();
        set_prods_header();
    }

    function change_count_cart(id) {
        var mydata = $.parseJSON(localStorage.getItem("product_list"));
        mydata.forEach(function(item, index) {
            if (item.product_id == id) {
                // if ($('#count_input_ps'+id).val() > item.product_total_count) {
                //     item.product_count = item.product_total_count;
                //     $('#count_input_ps'+id).val(item.product_total_count);
                // } else if ($('#count_input_ps'+id).val() < 1 || ! $.isNumeric($('#count_input_ps'+id).val())) {
                //     item.product_count = 1;
                //     $('#count_input_ps'+id).val(1);
                // } else {
                //     item.product_count = $('#count_input_ps'+id).val();
                // }
                if ($('#count_input_ps' + id).val() > 0) {
                    item.product_count = $('#count_input_ps' + id).val();
                } else {
                    item.product_count = 1;
                    $('#count_input_ps' + id).val(1);
                }
                mydata[index] = item;
                $('#count_input_ps' + id).val(item.product_count);
                // $.cookie("product_list", JSON.stringify(mydata), {
                //     path: '/'
                // });
                localStorage.setItem("product_list", JSON.stringify(mydata))
            }
        });
        product_list();
    }

    function remove_from_cart(id) {

        var mydata = $.parseJSON(localStorage.getItem("product_list"));
        if (mydata.length == 1) {
            // $.removeCookie('product_list', {
            //     path: '/'
            // });
            localStorage.removeItem("product_list")
            if (!localStorage.getItem("product_list")) {
                $(".board-show").show();
                $(".order-content").addClass("mob-order-content");
            } else {
                $(".board-show").hide();
            }
            $('.pr-list').html('');
        } else {
            mydata.forEach(function(elem, index) {
                if (elem.product_id == id) {
                    mydata.splice(index, 1);
                    $('.pr-list-tr' + id).remove();
                }
            });
            // $.cookie("product_list", JSON.stringify(mydata), {
            //     path: '/'
            // });
            localStorage.setItem("product_list", JSON.stringify(mydata))
        }
        product_list();
        set_prods_header();
    }

    let sum1;
    let totalSum;

    function product_list() {
        let sum = 0;
        if (localStorage.getItem("product_list")) {
            var mydata = $.parseJSON(localStorage.getItem("product_list"));
            $('.pr-list').html('');
            mydata.forEach(function(item) {
                var tr = document.createElement('tr');
                tr.classList.add("pr-list-tr" + item.product_id);
                var td1 = document.createElement('td');
                var div1 = "<div class=\"ps-product--cart\">" +
                    "<div class=\"ps-product__thumbnail\">" +
                    "<a href=\"<?= $base_url ?>upload_product/" + item.product_pic + "\">" +
                    "<img src=\"<?= $base_url ?>upload_product/" + item.product_pic + "\" alt=\"\">" +
                    "</a>" +
                    "</div>" +
                    "<div class=\"ps-product__content\">" +
                    "<a href=\"<?= $base_url ?>index.php/main/product/" + item.product_id + "\">" +
                    item.product_name +
                    "</a>" +
                    "<p>" + item.product_brand.brand_name + "</p>" +
                    "</div>" +
                    "</div>";
                td1.innerHTML += div1;
                sum += (item.product_count * item.product_price);

                var td2 = document.createElement('td');
                if (item.product_old_price != 0) {
                    var div2 = "<p class=\"margBot0\">" +
                        "<del>" + item.product_old_price + " смн.</del>\n" +
                        "</p>" + item.product_price + " смн.";
                } else {
                    var div2 = "<p class=\"margBot0\">" +
                        "</p>" + item.product_price + " смн.";
                }
                td2.innerHTML += div2;
                var td3 = document.createElement('td');
                var dv3 = " <div class=\"form-group--number\">" +
                    "<button class=\"up_count\" onclick=\"increase_count_cart(" + item.product_id + ")\">+</button>" +
                    "<button class=\"down_count\" onclick=\"decrease_count_cart(" + item.product_id + ")\">-</button>" +
                    "<input class=\"form-control\" id=\"count_input_ps" + item.product_id + "\" onchange=\"change_count_cart(" + item.product_id + ")\" type=\"text\" placeholder=\"1\" value=\" " + item.product_count + "\">" +
                    "</div>";
                td3.innerHTML += dv3;
                var td4 = document.createElement('td');
                var text = document.createTextNode(item.product_count * item.product_price + ' смн');
                td4.appendChild(text);

                var td5 = document.createElement('td');
                var tag5 = "<i style=\"cursor:pointer\" class=\"icon-cross\"  onclick=\"remove_from_cart(" + item.product_id + ")\"></i>";
                td5.innerHTML += tag5;
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                $('.pr-list').append(tr);
                $('.pr-list').find('td').css('text-align', 'center');
            })
        } else {
            $('.table-responsive').css('display', 'none');
            $('.checkout').css('display', 'none');
            $('.ps-section__cart-actions').css('justify-content', 'center');
            $('.ps-section__header').find('h1').append(" пуста <i class=\"fa fa-shopping-cart\"></i>");
            $('.ps-section__header').find('h1').css('color', 'gray');

            $('.pr-list').html('');
        }
        $(".number-currency").text(`${sum}`);
        if (localStorage.getItem("product_list") === null) {
            localStorage.removeItem("promocode_discount")
        }
        $('.number-currency_total').text(`${sum + 0}`);
        totalSum = sum + 0;
        sum1 = sum;
    }

    $(document).ready(function() {
        set_prods_header();
        product_list();
        $('a.checkout').click(function(e) {
            if (!localStorage.getItem("product_list")) {
                e.preventDefault();
                $('.toast_empty2').toast({
                    delay: 1500
                });
                $('.toast_empty2').toast('show');
            }
        });
    })


    // get PromoCode
    let result = null;

    function onPromoCode() {
        var discount = "";
        var promo_code = $("#promo_code").val();
        $.ajax({
            url: '<?= $base_url ?>index.php/main/promo',
            data: {
                text: $("textarea[name=promo_code]").val(),
                promo_code: promo_code
            },
            dataType: 'json',
            success: function(data) {
                discount = data.discount;
                result = totalSum - (discount * sum1 / 100);
                $('.number-currency_total').text(`${Math.round(result)}`);
            }
        });
    }

    function orderCheckout() {
        localStorage.setItem('promocode_discount', result);
    }
</script>