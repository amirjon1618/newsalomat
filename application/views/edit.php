<div id="order-delivery" class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 order-delivery-name">
                        Изменение данных пользователя
                    </div>
                    <div class="col-12 order-delivery-desc">
                        Здесь Вы можете изменить свои данные которые используются для сайта. Поле Номер телефона менять нельзя, поскольку указанный номер используется в качестве логина для входа на сайт.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="order-delivery-block">
                    <label for="order-delivery-phone" class="order-delivery-block-label">Номер телефона:</label>
                    <input type="text" readonly="true" autocomplete="off" class="order-delivery-input" id="edit-phone" value="{user_phone}">
                </div>
            </div>
            <div class="col-12">
                <div class="order-delivery-block">
                    <label for="order-delivery-name" class="order-delivery-block-label">Имя:</label>
                    <input type="text" autocomplete="off" class="order-delivery-input" id="edit-name" value="{user_name}">
                </div>
            </div>
            <div class="col-12">
                <div class="order-delivery-block">
                    <label for="order-delivery-bar-code" class="order-delivery-block-label">Новый пароль:</label>
                    <input type="password" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" title="только английские буквы и цифры" autocomplete="off" class="order-delivery-input" id="edit-password">
                </div>
            </div>
            <div class="col-12">
                <div class="order-delivery-block">
                    <div class="order-delivery-button" id="edit-confirm">
                        Изменить данные
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>