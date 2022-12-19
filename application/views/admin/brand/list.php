<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Бренды</li>
        <li class="active">Список</li>
    </ol>
</section>
{alert}
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">СПИСОК БРЕНДОВ</h3>
                    <button onclick="addBrand()" class="add_btns add_btns_color btn btn-primary">
                        <i class="fa fa-plus"></i> Добавить бренд
                    </button>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th style="text-align: center;">Изменить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            {list}
                            <tr>
                                <td>{id}</td>
                                <td>{brand_name}</td>
                                <td style="text-align: center;width: 100px;">
                                    <a onclick="getBrandInfo({id})" href="#">
                                        <i style="font-size: 24px;" class="fa fa-edit"> </i>
                                    </a>
                                </td>
                                <td style="text-align: center;width: 96px;"> <a class="confirmation" href="{base_url}index.php/Admin/brands?do=remove&id={id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
                            </tr>
                            {/list}
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!--------------------------------------- ADD MODAL---------------------------->

    <div class="modal fade" id="addModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Добавить Бренд</h4>
                </div>
                <div class="modal-body">
                    <form class="modal_form" role="form" method="POST" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="Вводите ...">
                        </div>
                        <div class="box-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Отмена
                            </button>
                            <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->

<script>
    function tryAddBanner() {
        $("#slider_name").css('border-color', '');
        $("#slider_link").css('border-color', '');
        $(".userfile_label").css('color', 'black');

        var b = true;

        if ($("#slider_name").val().length == 0) {
            $("#slider_name").css('border-color', 'red');
            $("#slider_name").focus();
            b = false;
        }

        if ($('#addModal').hasClass('addModal')) {
            if ($(".file_inp").val().length == 0) {
                $(".userfile_label").css('color', 'red');
                $(".file_inp").focus();
                b = false;
            }
        }

        return b;
    }

    function getBrandInfo(id) {
        $('#edit_loading').show();
        $.getJSON('<?= $base_url ?>index.php/api/GetBrandInfo/' + id, function(data, status) {
            $('.modal_form').attr('action', '{base_url}index.php/admin/editBrand/' + id);
            $('.modal-title').text('Изменить Баннер');
            $('#brand_name').val(data[0].brand_name);
            $('#edit_loading').hide();
            $('#addModal').modal('show');
        });
    }

    function addBrand() {
        $('.modal_form').attr('action', '{base_url}index.php/admin/addBrand');
        $('.modal-title').text('Добавить Баннер');
        $('#brand_name').val('');
        $('#addModal').modal('show');
    }
</script>