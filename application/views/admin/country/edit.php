<section class="content-header">
    <h1>
        <br/>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin/countries"><i class="fa fa-dashboard"></i> Форм</a></li>
        <li class="active"><?php echo $country[0]['country_name'] ?></li>
        <li class="active">Изменить</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Изменить</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input value="<?php echo $country[0]['country_name'] ?>" type="text"
                                   id="country_name" name="country_name" class="form-control"
                                   placeholder="Вводите ...">
                        </div>

                        <div class="box-footer">
                            <button type="button"
                                    onclick="javascript:window.location.href='{base_url}index.php/admin/countries'"
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

