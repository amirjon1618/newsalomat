<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"> Отзывы</li>
        <li class="active"> Список</li>
    </ol>
</section>
{alert}
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">СПИСОК ОТЗЫВОВ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Отзыва</th>
                                <th>Название Продукта</th>
                                <th>Имя</th>
                                <th>Оценка</th>
                                <th>Комментарий</th>
                                <th>Статус</th>
                                <th>Одобрить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $item) : ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['product_name'] ?></td>
                                    <td><?= $item['user_name'] ?></td>
                                    <td><?= $item['star_rating'] ?></td>
                                    <td><?= $item['user_comment'] ?></td>
                                    <?php if ($item['status'] == 0) : ?>
                                        <td style="text-align: center;width: 100px;">
                                            Не Одобрено
                                        </td>
                                    <?php else : ?>
                                        <td>Одобрено</td>
                                    <?php endif; ?>

                                    <td style="text-align: center;width: 100px;">
                                    <!-- <?php if ($item['status'] != 0) echo 'checked'; ?>     -->
                                    <input id="stat_checkbox<?= $item['id']?>" type="checkbox" onclick="change_status(<?= $item['id'] ?>)" <?php if ($item['status'] != 0) echo 'checked="checked"'; ?>>
                                    </td>
                                    <td style="text-align: center;width: 100px;">
                                        <a class="confirmation" href="{base_url}index.php/admin/reviews?do=remove&review_id=<?= $item['id'] ?>"><i style="font-size: 24px;color:red;" class="fa fa-trash"> </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- <nav aria-label="">
                    <ul class="pagination">
                    {pages}
                      <li class="{current}"><a href="{link}?page={page}">{page} <span class="sr-only"></span></a></li>
                    {/pages}
                    </ul>
                  </nav> -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    function change_status(id) {
        var checked = 0;
        if ($('#stat_checkbox' + id).is(':checked')) {
            checked = 1;
        } else {
            checked = 0;
        }
        $.getJSON("<?= base_url() ?>index.php/admin/changeReviewStatus", {stat: checked, review_id: id}, function(data, status) {
            if (data == 1) {
                location.reload();
            }
        });
    }

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