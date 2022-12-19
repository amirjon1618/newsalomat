<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Статьи</li>
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
                    <h3 class="box-title">СПИСОК СТАТЬЕЙ</h3>
                    <a href="{base_url}index.php/admin/addBlog" class="add_btns add_btns_color btn btn-primary">
                        <i class="fa fa-plus"></i> Добавить статьи
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Заголовок</th>
                                <!-- <th>Текст</th> -->
                                <th>Дата добавления</th>
                                <th>Аватар</th>
                                <th>Изображения</th>
                                <th style="text-align: center;">Изменить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody id="dragAndDrop" draggable="true">
                            <?php foreach ($list as $item) : ?>
                                <tr ondrop="onDrop()">
                                    <td><?= $item['id'] ?></td>
                                    <td class="blog_title_list"><?= $item['blog_title'] ?></td>
                                    <!-- <td><?= $item['blog_about'] ?></td> -->
                                    <td><?= $item['blog_created_at'] ?></td>
                                    <td style="text-align: center;width: 100px;">
                                        <?php if ($item['blog_pic']) : ?>
                                            <a target="_blank" href="<?= $item['base_url'] ?>upload_blog/<?= $item['blog_pic'] ?>">
                                                <img src="<?= $item['base_url'] ?>upload_blog/<?= $item['blog_pic'] ?>" style="width: 100px;" /></a>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;width: 100px;">
                                        <a href="{base_url}index.php/admin/blogImages/<?= $item['id'] ?>">
                                            <i style="font-size: 24px;" class="fa fa-picture-o"> </i>
                                        </a>
                                    </td>
                                    <td style="text-align: center;width: 100px;">
                                        <a href="{base_url}index.php/admin/editBlog/<?= $item['id'] ?>">
                                            <i style="font-size: 24px;" class="fa fa-edit"> </i>
                                        </a>
                                    </td>
                                    <td style="text-align: center;width: 100px;">
                                        <a class="confirmation" href="<?= $item['base_url'] ?>index.php/Admin/blogs?do=remove&blog_id=<?= $item['id'] ?>">
                                            <i style="font-size: 24px;color:red;" class="fa fa-remove"> </i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button class="form-btn" onclick="javascript:window.location.reload()">Сохранить</button>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- <div id="edit_loading" style="display: none;">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->
</section><!-- /.content -->

<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    function onDrop() {
        const sort = [];
        const childs = document.querySelectorAll("#dragAndDrop tr td:first-child");
        childs.forEach(elem => {
            const numbers = Number(elem.textContent);
            sort.push(Number(elem.textContent));
        })
        $.ajax({
            type: "POST",
            url: "{base_url}products/updateOrderInBlog",
            headers: {
                "Accept": "application/json",
            },
            data: {
                sort
            },
        })
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
    /*===== DRAG and DROP =====*/
    const dropItems = document.getElementById('dragAndDrop')

    new Sortable(dropItems, {
        animation: 350,
        chosenClass: "sortable-chosen",
        dragClass: "sortable-drag"
    });
</script>
<style>
    .form-btn {
    float: right;
    color: #fff;
    background: #1EBEBE;
    border-radius: 5px;
    border: none;
    margin: 20px 10px 20px 0;
    padding: 10px 40px;
  }

  .form-btn:hover {
    background: #18A1A1;
  }
</style>