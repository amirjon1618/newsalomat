<div class="recipe_main_div">
    <div class="recipe_div" id="recipe_div_phone">
        <h3 class="recipe_header">Расшифровка рецепта</h3>
        <h5>Укажите номер для отправки Вам ответа.</h5>
        <div class="recipe_phone_div" id="recipe_phone_div_phone_number" style="text-align: center;">
            <form id="formSms">
                <div class="recipe_phone_div_inp">
                    <h5 class="mb-3">Введите номер телефона</h5>
                    <span>+992</span>
                    <input class="recipe_phone_number form-control" type="text" pattern="[0-9]+" title="987654321" required type="number" minlength="9" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="order_phone" name="cell_phone" placeholder="Введите свой номер">
                </div>
                <h5 class="recipe_error_msg_code">Введите 9 цифр</h5>
                <div class="recipe_name_div_inp py-3">
                    <input class="recipe_name form-control" minlength="3" maxlength="24" pattern="[A-Za-zА-Яа-я]+" title="Русские или английские буквы" required name="name" id="order_name" type="text" placeholder="Имя Фамилия">
                </div>
                <div class="recipe_comment_div_inp pb-3">
                    <textarea class="recipe_comment form-control" minlength="3" maxlength="250" name="comment" id="order_comment" type="text" placeholder="Комментарий"></textarea>
                </div>
                <button class="recipe_phone_div_button_send_sms">
                    Отправить рецепт
                </button>
            </form>
        </div>
        <div class="recipe_phone_div" id="recipe_phone_div_phone_code">
            <div class="recipe_phone_div_inp">
                <h5>Вам отправлено SMS с кодом подтверждения</h5>
                <input type="number" class="recipe_phone_code" placeholder="Введите код">
                <div class="recipe_error_msg_code">
                    <p>Неверный код</p>
                </div>
            </div>
            <h5 id="not_received_sms">Не получили SMS? <span class="resend_code" onclick="resendSms()">Отправить ещё раз</span></h5>
            <h5 id="recend_timer_sms">Вы можете переотправить sms через <span id="timer_recipe"></span></span></h5>
            <button class="recipe_phone_div_button_confirm_sms" onclick="confirmRecipeCode()">
                Потдвердить
                <div class="spinner-border text-light" id="recipe_spinner" style="margin-left:10px;display:none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </div>
        <div class="recipe_phone_div" id="recipe_successful">
            <div class="recipe_successful_div">
                <img src="{base_url}img/recipe_success_icon.png" alt="">
                <p>Рецепт отправлен.</p>
                <p>Скоро мы свяжемся с Вами.</p>
            </div>
        </div>
        <div class="recipe_phone_back_btn_div">
            <button class="recipe_phone_back_btn" onclick="recipeGoBack()"><i class="fa fa-arrow-left"></i> Назад</button>
        </div>
    </div>
    <div class="recipe_div" id="recipe_div_img_upload">
        <h3 class="recipe_header">Расшифровка рецепта</h3>
        <h5>Выберите фото рецепта для отправки на расшифровку:</h5>
        <div class="row file_upload_div">
            <div class=" col-sm-6 col-12">
                <input type="file" name="user_files[]" id="user_files">
            </div>

            <div class="col-sm-6 col-12 send_recipe_btn_div">
                <button class="send_recipe_btn" onclick="sendFilesBtn()">
                    <i class="fa fa-check-circle"></i>
                    Отправить рецепт
                </button>
            </div>
        </div>

        <h5>Вы так же можете отправить фото в мессенджерах:</h5>
        <div class="row recipe_social_main_div">
            <div class="col-md-6 col-12 col-sm-6 recipe_social_main_div_each">
                <a href="https://wa.me/992888886006">
                    <div class="recipe_social_div">
                        <img src="{base_url}img/whatsapp_icon.png" alt="">
                        <div>
                            <p>Отправить на</p>
                            <h5>WhatsAPP</h5>
                        </div>
                    </div>
                </a>
            </div class="recipe_social_div">
            <div class="col-md-6 col-12 col-sm-6 recipe_social_main_div_each">
                <a href="https://t.me/Salomat6006" target="_blank">
                    <div class="recipe_social_div">
                        <img src="{base_url}img/telegram_icon.png" alt="">
                        <div>
                            <p>Отправить на</p>
                            <h5>Телеграм</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="toast toast_empty fade hide">
    <div class="toast-body">
        <i class="fa fa-exclamation-triangle"></i>
        Нужно загрузить фото рецепта
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<div class="toast toast_not_finished fade hide">
    <div class="toast-body">
        <i class="fa fa-exclamation-triangle"></i>
        Загрузка ещё не закончилась
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<div id="loading" style="display: none;">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<script src="{base_url}plugins/kendo-upload-ui/js/kendo.all.min.js"></script>
<script src="{base_url}plugins/kendo-upload-ui/js/kendo.messages.ru-RU.min.js"></script>
<script>
    var recipe_pics = [];
    var recipe_id = null;
    var recipe_phone_number = '';
    var recipe_name = '';
    var recipe_comment = '';
    var uploadFinished = false;
    // var recipe_sms_id = '';

    $("#formSms").on('submit', (e) => {
        e.preventDefault();
        sendSms()
    })

    function file_click() {
        $('#recipe_userfile').click();
    }

    function onUpload(e) {
        // An array with information about the uploaded files
        uploadFinished = false;
        var files = e.files;
        e.data = {
            fileDescription: 'hello'
        };
        var upload = $("#user_files").data("kendoUpload"),
            files2 = upload.getFiles();
    }

    function onSuccess(e) {
        var obj = {
            name: e.files[0].name,
            uid: e.files[0].uid,
            file: e.response.file
        };
        $('.k-file-name').css('color', 'green');
        $('.k-file-size').css({
            'cssText': 'display:block !important'
        });
        if (e.operation != 'remove') {
            recipe_pics.push(obj);
        }
    }

    function onRemove(e) {
        // uploadFinished = true;
        e.data = {
            uid: e.files[0].uid
        };
        recipe_pics.forEach(function(el, i) {
            if (el.uid == e.files[0].uid) {
                recipe_pics.splice(i, 1);
            }
        });
    }

    function sendFilesBtn() {
        var upload = $("#user_files").data("kendoUpload"),
            files2 = upload.getFiles();
        if (files2.length == 0) {
            $('.toast_empty').toast({
                delay: 1500
            });
            $('#loading').hide();
            $('.toast_empty').toast('show');
        } else if (!uploadFinished) {
            $('.toast_not_finished').toast({
                delay: 1500
            });
            $('#loading').hide();
            $('.toast_not_finished').toast('show');
        } else {
            $('#recipe_div_phone').show();
            $('#recipe_div_img_upload').hide();
            $('#loading').hide();
        }

    }

    function validatePhone(phoneNumber) {
        var phoneNumberPattern = /^\d{9}$/;
        return phoneNumberPattern.test(phoneNumber);
    }

    function sendSms() {
        $('#loading').show();
        var validate = validatePhone($('.recipe_phone_number')[2].value);
        if (validate) {
            var upload = $("#user_files").data("kendoUpload"),
                files2 = upload.getFiles();
            $.ajax({
                url: "<?= base_url() ?>index.php/main/recipeSendSms",
                type: "POST",
                dataType: "json",
                data: {
                    "recipe_phone": $('.recipe_phone_number')[2].value,
                    "recipe_name": $('.recipe_name').val(),
                    "recipe_comment": $('.recipe_comment').val(),
                    "recipe_pics": recipe_pics
                },
                success: function(data) {
                    console.log(data)
                    if (data.stat == 1) {
                        recipe_id = data.recipe_id;
                        recipe_phone_number = $('.recipe_phone_number')[2].value;
                        $('#recipe_phone_div_phone_number').hide();
                        $('#recipe_phone_div_phone_code').show();
                        begin();
                        $('#loading').hide();
                    }
                }
            });
            $('.recipe_error_msg').hide();
        } else {
            $('#loading').hide();
            $('.recipe_error_msg').show();
        }
    }

    function begin() {
        $('#not_received_sms').hide();
        $('#recend_timer_sms').show();

        timing = 60;
        $('#timer_recipe').html(timing);
        myTimer = setInterval(function() {
            --timing;
            $('#timer_recipe').html(timing);
            if (timing === 0) {
                $('#recend_timer_sms').hide();
                $('#not_received_sms').show();
                clearInterval(myTimer);
            }
        }, 1000);
    }

    function resendSms() {
        console.log($('.recipe_phone_number'));
        $('#loading').show();
        $.ajax({
            url: "<?= base_url() ?>index.php/main/recipeResendSms",
            type: "POST",
            dataType: "json",
            data: {
                "recipe_phone": $('.recipe_phone_number')[2].value,
                "recipe_id": recipe_id
            },
            success: function(data) {
                if (data.stat == 1) {
                    begin();
                    $('#loading').hide();
                }
            }
        });
    }

    function confirmRecipeCode() {
        $('#loading').show();
        var upload = $("#user_files").data("kendoUpload"),
            files2 = upload.getFiles();
        $.ajax({
            url: "<?= base_url() ?>index.php/main/confirmRecipeCode",
            type: "POST",
            dataType: "json",
            data: {
                'recipe_phone_code': $('.recipe_phone_code').val(),
                'recipe_phone_number': recipe_phone_number,
                'recipe_id': recipe_id
            },
            success: function(data) {
                if (data == 1) {
                    $('.recipe_phone_code').val('');
                    $('#recipe_phone_div_phone_code').hide();
                    $('#recipe_successful').show();
                    $('.recipe_phone_back_btn').hide();
                    $('.recipe_error_msg_code').hide();
                } else {
                    $('.recipe_error_msg_code').show();
                }
                $('#loading').hide();
            }
        });
    }

    function recipeGoBack() {
        $('#loading').show();

        if ($('#recipe_phone_div_phone_code').is(':visible')) {
            $('#recipe_phone_div_phone_number').show();
            $('#recipe_phone_div_phone_code').hide();
        } else if ($('#recipe_phone_div_phone_number').is(':visible')) {
            $('#recipe_div_phone').hide();
            $('#recipe_div_img_upload').show();
        }
        $('#loading').hide();
    }

    function onComplete(e) {
        uploadFinished = true;
        // The Upload is now idle
    }

    function removeAll() {
        var upload = $("#user_files").data("kendoUpload");
        upload.clearAllFiles();
    }

    $(document).ready(function() {
        recipe_pics = [];
        recipe_ids = [];
        $("#user_files").kendoUpload({
            async: {
                saveUrl: "{base_url}index.php/main/sm?type=save",
                removeUrl: "{base_url}index.php/main/sm?type=remove",
                chunkSize: 110000000000, // bytes
                concurrent: true,
                autoUpload: true
            },
            localization: {
                dropFilesHere: '',
                uploadFail: 'Файл(ы) не удалось загрузить.',
                uploadSuccess: '',
                invalidFileExtension: 'Тип файла не разрешен.',
                invalidFiles: 'Недопустимый файл(ы). Пожалуйста, проверьте требования к загрузке файлов.',
                invalidMaxFileSize: 'Слишком большой размер файла.',
                invalidMinFileSize: 'Размер файла слишком мал.'
            },
            upload: onUpload,
            success: onSuccess,
            remove: onRemove,
            complete: onComplete
        });
        $('.recipe_phone_number').val('');
        removeAll();
    });
</script>