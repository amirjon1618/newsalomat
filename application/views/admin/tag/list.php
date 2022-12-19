<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Тэги</li>
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
                    <h3 class="box-title">СПИСОК ТЭГОВ</h3>
                    <button onclick="addTag()" class="add_btns add_btns_color btn btn-primary">
                        <i class="fa fa-plus"></i> Добавить тэг
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
                                <td>{tag_name}</td>
                                <td style="text-align: center;width: 100px;">
                                    <a onclick="getTagInfo({id})" href="#">
                                        <i style="font-size: 24px;" class="fa fa-edit"> </i>
                                    </a>
                                </td>
                                <td style="text-align: center;width: 96px;">
                                 <a class="confirmation" href="{base_url}index.php/admin/tags?do=remove&tag_id={id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i>
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
                    <h4 class="modal-title">Добавить Тэг</h4>
                </div>
                <div class="modal-body">
                    <form class="modal_form" role="form" method="POST" enctype="multipart/form-data" onsubmit="return validateTagForm()">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input type="text" id="tag_name" name="tag_name" class="form-control" placeholder="Вводите ...">
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

    function getTagInfo(id) {
        $('#tag_name').css('border-color', '#d2d6de');
        $('#edit_loading').show();
        $.getJSON('<?= $base_url ?>index.php/api/GetTagInfo/' + id, function(data, status) {
            $('.modal_form').attr('action', '{base_url}index.php/admin/editTag/' + id);
            $('.modal-title').text('Изменить Тэг');
            $('#tag_name').val(data.tag_name);
            $('#edit_loading').hide();
            $('#addModal').modal('show');
        });
    }

    function addTag() {
        $('#tag_name').css('border-color', '#d2d6de');
        $('.modal_form').attr('action', '{base_url}index.php/admin/addTag');
        $('.modal-title').text('Добавить Тэг');
        $('#tag_name').val('');
        $('#addModal').modal('show');
    }
    function validateTagForm() {
        var valid = false;
        if ($('#tag_name').val() != '' || $("#tag_name").val().length > 150) {
            valid = true;
        }
        if (!valid) {
            $('#tag_name').css('border-color', 'red');
        }
        return valid;
    }
</script>
