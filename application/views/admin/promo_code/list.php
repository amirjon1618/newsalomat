<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Промокод</li>
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
                    <h3 class="box-title">Список Промокодов</h3>
                    <button onclick="addPromoCode()" class="add_btns add_btns_color btn btn-primary">
                        <i class="fa fa-plus"></i> Добавить промокод
                    </button>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Код</th>
                                <th>Скидка</th>
                                <th style="text-align: center;">Изменить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            {list}
                            <tr>
                                <td>{id}</td>
                                <td>{code}</td>
                                <td>{discount}</td>
                                <td style="text-align: center;width: 100px;">
                                    <a onclick="getPromoCodeInfo({id})" href="#">
                                        <i style="font-size: 24px;" class="fa fa-edit"> </i>
                                    </a>
                                </td>
                                <td style="text-align: center;width: 96px;">
                                 <a class="confirmation" href="{base_url}index.php/admin/promo_codes?do=remove&id={id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i>
                                </a></td>
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
                    <h4 class="modal-title">Добавить Промокод</h4>
                </div>
                <div class="modal-body">
                    <form class="modal_form" role="form" method="POST" enctype="multipart/form-data" onsubmit="return validatePromoCodeForm()">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Код</label>
                            <input type="text" id="code" name="code" class="form-control" placeholder="Вводите ...">
                        </div>
                        <div class="form-group">
                            <label>Проценты </label>
                            <input type="text" id="discount" name="discount" class="form-control" placeholder="Вводите ...">
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

    function getPromoCodeInfo(id) {
        $('#code').css('border-color', '#d2d6de');
        $('#edit_loading').show();
        $.getJSON('<?= $base_url ?>index.php/api/GetPromoCodeInfo/' + id, function(data, status) {
            $('.modal_form').attr('action', '{base_url}index.php/admin/editPromoCode/' + id);
            $('.modal-title').text('Изменить Промокод');
            $('#code').val(data.code);
            $('#discount').val(data.discount);
            $('#edit_loading').hide();
            $('#addModal').modal('show');
        });
    }

    function addPromoCode() {
        $('#code').css('border-color', '#d2d6de');
        $('.modal_form').attr('action', '{base_url}index.php/admin/addPromoCode');
        $('.modal-title').text('Добавить Промокод');
        $('#code').val('');
        $('#discount').val('');
        $('#addModal').modal('show');
    }
    function validatePromoCodeForm() {
        var valid = false;
        if ($('#code').val() != '' || $("#code").val().length > 150) {
            valid = true;
        }
        if (!valid) {
            $('#code').css('border-color', 'red');
        }

        return valid;
    }
</script>
