<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{base_url}index.php/admin/recipes"><i class="fa fa-list"></i> э-Рецепты</a></li>
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
                    <h3 class="box-title">Список</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изображение</th>
                                <!-- <th style="text-align: center;">Удалить</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $item) : ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td>
                                        <a href="<?= $item['base_url'] ?>upload_recipe/<?= $item['pic'] ?>">
                                            <img src="<?= $item['base_url'] ?>upload_recipe/<?= $item['pic'] ?>" style="width: 100px;" />
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        $('#TableUser').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false
        });
    });
</script>