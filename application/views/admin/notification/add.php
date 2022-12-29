<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <?php if (isset($category)) : ?>
            <li><a href="{base_url}index.php/admin/categories">Категории</a></li>
            <li class="active"><?= $category['category_name'] ?></li>
        <?php endif; ?>
        <li class="active">Добавить рассылку</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить рассылку</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Наименование  рассылки</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Вводите ...">
                        </div>
                        <div class="form-group">
                            <label>Текст сообщения</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Вводите ...">
                        </div>
                        <div class="form-group">
                            <label>Тип рассылки</label>
                            <select id="type" name="type" class="form-control">
                                <option value="0">Выберите</option>
                                <option value="holidays">Праздники</option>
                                <option value="promotions">Акции</option>
                                <option value="events">События</option>
                            </select>
                        </div>
                        <div class="form-group" id="file_div">
                            <label class="userfile_label">Изображение рассылки</label>
                            <input type="file" name="userfile" class="file_inp" size="50" />
                            <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input()"></i>
                        </div>
                        <div class="box-footer">
                            <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/notification'" class="btn btn-default">Отмена</button>
                            <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<script>

</script>
<script>
    function cancel_file_input() {
        $('.file_inp').val('');
    }

    function validate_chekout() {
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $('form').validate({
            lang: 'ru',
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true,
                    url: true
                },

                userfile: {
                    required: false,
                    accept: "image/jpg,image/jpeg,image/png",
                    // filesize: 4500000
                }
            },
            messages: {
                userfile: {
                    required: "Пожалуйста выберите файл"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    }

    $(document).ready(function() {
        // validate_chekout();
    });
</script>