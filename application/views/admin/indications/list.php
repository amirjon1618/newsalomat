<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Симтпомы</li>
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
                    <h3 class="box-title">СПИСОК СКИДОЧНЫХ ТЭГОВ</h3>
                    <button data-toggle="modal" data-target="#addModal" class="add_btns add_btns_color btn btn-primary">
                        <i class="fa fa-plus"></i> Добавить симтпом
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
                                <th>Ссылка</th>
                                <th style="text-align: center;">Изменить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            {list}
                            <tr>
                                <td>{id}</td>
                                <td>{tag_name}</td>
                                <td>{url}{id}</td>
                                <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/editIndication/{id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                                <td style="text-align: center;width: 96px;"> <a class="confirmation" href="{base_url}index.php/Admin/indications?do=remove&id={id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
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
                    <h4 class="modal-title">Добавить скидочный тэг</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="{base_url}index.php/admin/addIndication" method="POST" enctype="multipart/form-data">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Наименование </label>
                            <input type="text" id="indication_name" name="indication_name" class="form-control" placeholder="Вводите ...">
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