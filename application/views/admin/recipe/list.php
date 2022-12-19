<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">э-Рецепты</li>
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
          <h3 class="box-title">СПИСОК Э-РЕЦЕПТОВ</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <br />
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Телефон</th>
                <th>Дата и время</th>
                <th>Имя Фамилия</th>
                <th>Комментарий</th>
                <th>Статус</th>
                <th style="text-align: center;">Подробно</th>
                <th style="text-align: center;">Удалить</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $item) : ?>
                <tr>
                  <td><?= $item['recipe_phone'] ?></td>
                  <td><?= $item['created_at'] ?></td>
                  <td><?= $item['full_name'] ?></td>
                  <td><?= $item['comment'] ?></td>
                  <td style="width: 100px;"><span class="label" style="background:<?=$item['status_color']?>;border-radius:.5em"><?= $item['status']?></span></td>
                  <td style="text-align: center;width: 100px;">
                    <a href="{base_url}index.php/admin/recipePics/<?= $item['id'] ?>">
                    <i style="font-size: 24px;" class="fa fa-edit"> </i>
                    </a>
                  </td>
                  <td style="text-align: center;width: 100px;"> <a class="confirmation" href="<?= $item['base_url'] ?>index.php/Admin/recipes?do=remove&recipe_id=<?= $item['id'] ?>"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
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
  <div class="modal fade" id="recipePics" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Фотографии</h4>
        </div>
        <div class="modal-body">
          <br />
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Изображение</th>
              </tr>
            </thead>
            <tbody class="recipe_pics_tbody">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section><!-- /.content -->
<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  function getRecipePhotos(id) {
    $('#edit_loading').show();
    $('.recipe_pics_tbody').html('');
    $.getJSON('<?= $base_url ?>index.php/api/GetRecipePics/' + id, function(data, status) {
      $('.modal-title').text(data.recipe_phone + ' фотографии');
      data.pics.forEach(function(item, index) {
        var html = `<tr> +
                    <td>${item.id}</td>
                    <td  style="text-align: center;width: 100px;">
                      <a target="_blank" href="${item.base_url}upload_recipe/${item.pic}">
                      <img src="${item.base_url}upload_recipe/${item.pic}" style="width: 100 px;" />
                      </a>
                    </td>
                  </tr>`;
        $('.recipe_pics_tbody').append(html);
      })
      $('#edit_loading').hide();
      $('#recipePics').modal('show');
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