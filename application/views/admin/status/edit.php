<section class="content-header">
    <h1>
        <br/>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin/status"><i class="fa fa-dashboard"></i> Статусы</a></li>
        <li class="active"><?php echo $status[0]['status_text'] ?></li>
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
                        <!-- <div class="form-group">
                            <label>Номер статуса </label>
                            <input value="<?php echo $status[0]['status_number'] ?>" type="number" id="status_number" name="status_number" class="form-control"
                                   placeholder="Вводите ...">
                        </div> -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input value="<?php echo $status[0]['status_text'] ?>" type="text"
                                   id="status_text" name="status_text" class="form-control"
                                   placeholder="Вводите ...">
                        </div>

                        <div class="box-footer">
                            <button type="button"
                                    onclick="javascript:window.location.href='{base_url}index.php/admin/status'"
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

