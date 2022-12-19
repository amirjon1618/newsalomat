<section class="content-header">
    <h1>
        <br/>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Profile</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Сменить пароль</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="" method="POST">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Новый пароль</label>
                        <input type="text" id="newpass1" name="newpass1" class="form-control" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label>Повторить пароль</label>
                        <input type="text" id="newpass2" name="newpass2" class="form-control" placeholder="" value="">
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/'"
                                class="btn btn-default">Отмена
                        </button>
                        <input type="submit" name="editBtn" value="Сохранить" class="btn btn-primary pull-right"/>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div>
    </div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script>
    // $(function () {
    //     $("#reservation").datepicker({showButtonPanel: true});
    //     $("#reservation").datepicker("option", "dateFormat", "dd-mm-yy");
    //     var queryDate = '{date}',
    //         dateParts = queryDate.match(/(\d+)/g)
    //     realDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
    //     $("#reservation").datepicker('setDate', queryDate);
    //
    // });
</script>
