<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{base_url}admin/products"><i class="fa fa-dashboard"></i> Товары</a></li>
        <li class="active">Добавить</li>
    </ol>
</section>
{alert}
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Импортировать продукты</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <!-- text input -->
                       
                        <div class="form-group">
                            <!-- <label for="product_csv">Текст</label>
                            <textarea id="product_csv" name="product_csv" rows="30" cols="20" class="form-control"></textarea> -->
                            <input type="file" name="userfile">
                        </div>
                        <div class="box-footer">
                            <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/products'" class="btn btn-default">Отмена
                            </button>
                            <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                        </div>

                    </form>
                </div><!-- /.box-body -->
</section>
<!-- Bootstrap WYSIHTML5 -->
<script>
    function cancel_file_input(str) {
;        $(str).val('');
    }
    $(document).ready(function() {
        
    });
</script>