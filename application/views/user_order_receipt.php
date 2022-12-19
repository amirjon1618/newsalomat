<div id="main_div">
    <div id="confirm_div">
        <?php if (!isset($not_found)) : ?>
            <h3 class="text-left">Ваш заказ</h3>
            <div class="order_nm-date">
                <p>Номер заказа: <b> {order_id} </b></p>
                <p>Дата: {order_date}</p>
            </div>
            <hr class="uo_hr">
            {products}
            <a href="{base_url}index.php/main/product/{product_id}">
                <p class="receipt_prods fs-13" style="text-align:start">
                    <span class="text-muted pr_name_span">{product_name}</span>
                    <span class="user_order_item_span2">
                        {total_count} x {product_price} смн.
                    </span>
                </p>
            </a>
            {/products}
            <hr class="uo_hr">
            <p class="fw-600 fs-13" style="text-align:start;margin-bottom: 6px;">
                <span class="text-muted"> Доставка (г.Душанбе)</span>
                <span style="margin-left:25px;float:right;font-weight:bold">
                    <?= $delivery_info["delivery_price"]; ?> смн.
                </span>
            </p>
            <hr class="uo_hr">
            <p class="fw-600 fs-13" style="text-align:start;">
                <span class="text-muted total_span">Итого: </span>
                <span style="float:right;font-weight:bold;color:#00c7a5">{total_sum} смн.</span>
            </p>
        <?php else : ?>
            <h4 class="text-muted">Чек не найден...</h4>
        <?php endif; ?>
    </div>
</div>