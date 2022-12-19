<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Страницы</li>
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
                    <h3 class="box-title">СПИСОК СТРАНИЦ</h3>
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
                            </tr>
                        </thead>
                        <tbody id="#" draggable="false">
                            {list}
                            <tr>
                                <td>{id}</td>
                                <td>{name}</td>
                                <td style="text-align: center;width: 100px;"> <a href="{base_url}index.php/admin/editPage/{id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                            </tr>
                            {/list}
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    /*===== DRAG and DROP =====*/
    const dropItems = document.getElementById('dragAndDrop')

    new Sortable(dropItems, {
        animation: 350,
        chosenClass: "sortable-chosen",
        dragClass: "sortable-drag"
    });
</script>