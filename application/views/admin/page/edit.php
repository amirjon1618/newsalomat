<section class="content-header">
    <h1>
        <br/>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin/pages"><i class="fa fa-dashboard"></i> Страницы</a></li>
        <li class="active"><?php echo $page['name'] ?></li>
        <li class="active">Изменить</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Изменить</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data" onsubmit="return tryEditTag()">
                        <div class="form-group">
                            <label>Наименование </label>
                            <input value="<?php echo $page['name'] ?>" type="text"
                                   id="page_name" name="page_name" class="form-control"
                                   placeholder="Вводите ...">
                        </div>
                        <div class="form-group">
                        <label for="page_about">О странице</label>
                        <textarea class="form-control" name="page_about" id="page_about" cols="30" rows="10">
                            <?= $page['about']?>
                        </textarea>
                        </div>
                        <div class="box-footer">
                            <button type="button"
                                    onclick="javascript:window.location.href='{base_url}index.php/admin/pages'"
                                    class="btn btn-default">Отмена
                            </button>

                            <input type="submit" name="AddBtn" value="Изменить" class="btn btn-primary pull-right"/>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap WYSIHTML5 -->
<script>
    function tryEditTag() {
        $("#page_name").css('border-color', '');

        var b = true;

        if ($("#page_name").val().length == 0) {
            $("#page_name").css('border-color', 'red');
            $("#page_name").focus();
            b = false;
        }

        return b;
    }
</script>
