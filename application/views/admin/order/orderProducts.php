<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="{base_url}index.php/admin/orders"><i class="fa fa-list"></i> Заказы</a></li>
    <li class="active"><?= $order['full_name'] ?></li>
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
          <div class="order_status_title_div">
            <h4 class="box-title">СПИСОК ТОВАРОВ ЗАКАЗА</h3>
              <p>Статус - <span class="label" style="background:<?= $current_status['status_color'] ?>;border-radius:.5em"><?= $current_status['status_text'] ?></span></p>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          <br />
            <?php if ( $user_info) : ?>
                <table id="TableUser" class="table table-bordered table-hover">
                   <tr> <thead><h3>Пользователь</h3></thead></tr>
                    <tr>
                        <th>Имя: <h4><?= $user_info[0]['name']?></h4></th>
                        <th>Номер телефона: <h4><?= $user_info[0]['login']?></h4></th>
                    </tr>
                </table>
            <?php endif; ?>
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID Заказа</th>
                <th>Имя товара</th>
                <th>Количество</th>
                <th>Цена одного товара</th>
                <th>Сумма</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($list as $item): ?>
              <tr>
                <td><?= $item['order_id']?></td>
                <td><?= $item['product_name']?></td>
                <td><?= $item['total_count']?></td>
                <td><?= $item['product_price']?></td>
                <td><?= ($item['product_price'] * $item['total_count']) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <br />

          <?php if ($current_status_id != -1) : ?>
            <?php if ($current_status_id != 4) : ?>
              <div id="status_div">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="status" id="status_label">Изменить статус</label>
                    <select name="status" id="status_select" required>
                      <option value="">Выберите...</option>
                      <?php foreach ($status as $st) : ?>
                        <?php if ($current_status_id != $st['id']) : ?>
                          <option value="<?= $st['id'] ?>">
                            <?= $st['status_text'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <textarea class="form-control" required maxlength="500" name="user_order_comment" id="user_order_comment" rows="3" cols="25">

              </textarea>
                  <button name="saveBtn" value="Сохранить" onclick="sendNotification(<?php echo $list[0]['order_id']?>)" type="submit" class="btn btn-info save_user_order_changes">Сохранить</button>
                </form>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <hr>
          <?php foreach ($user_changes as $user_change) : ?>
            <h3><span class="text-muted">Имя:</span> <?= $user_change['user_name'] ?></h3>
            <h6><span class="text-muted">Изменённое время:</span> <?= $user_change['created_at'] ?></h6>
            <p>Статус из <strong>"<?= $user_change['previous_status_text'] ?>"</strong> на <strong>"<?= $user_change['status_text'] ?>"</strong></p>
            <p><span class="text-muted">Комментарий:</span> <?= $user_change['user_comment'] ?></p>
            <hr>
          <?php endforeach; ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

</script>
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
  $(document).ready(function() {});


  function sendNotification(id) {
      let status = $('#status_select').val();

      $.post('<?= $base_url ?>index.php/PushNotification/orderPushNotification/' + id , {
          'status_id': status
      })
  }
</script>