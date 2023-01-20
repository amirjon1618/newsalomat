<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Заказы</li>
  </ol>
</section>
{alert}
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header order_box_header">
          <div class="prods_buttons">
            <div id="add_prod_btn">
              <a href="{base_url}index.php/admin/addOrder">
                <button class="add_btns add_btns_color btn btn-primary"><i class="fa fa-plus"></i>Добавить заявку</button>
              </a>
            </div>
            <div id="order_excel">
              <a href="{base_url}index.php/admin/orderExportExcel" class="btn btn-primary">Excel</a>
            </div>
          </div>
          <h3 class="box-title">СПИСОК ЗАЯВОК</h3>
        </div><!-- /.box-header -->
        <div class="add_sort_div">
          <form id="order_sort_form" method="get" action="">
            <div id="order_status_list_div">
              <div class="order_search_div">
                <i class="fa fa-search"></i>
                <input value="<?= $sort_search_input ?>" type="text" name="order_inp" id="" placeholder="Найти заявку">
              </div>
              <div class="order_date_div">
                <input type="date" class="order_date" name="order_date" value="<?= $sort_date ?>" onchange="show_order_cancel_btn()">
                <div><i class="fa fa-calendar" aria-hidden="true"></i></div>
                <i class="fa fa-times cancel_date" onclick="cancel_date()"></i>
              </div>
              <!-- <label id="status_list_select_label" for="status_list_select">Статус</label> -->
              <select name="status_list_select" id="status_list_select">
                <option value="" <?php if ($status_sort == '') echo 'selected' ?>>Все</option>
                <?php foreach ($status as $st) : ?>
                  <option value="<?= $st['id'] ?>" <?php if ($status_sort == $st['id']) echo 'selected' ?>>
                    <?= $st['status_text'] ?></option>
                <?php endforeach; ?>
              </select>
              <!-- <div class="order_sort_div"> -->
              <!-- <label for="order_date_sort">Сортировка по дате</label> -->
              <select name="order_date_sort" id="order_date_sort">
                <option value="" <?php if ($order_date_sort == '') echo 'selected' ?>><span class="text-muted">Сортировка по дате</span></option>
                <option value="desc" <?php if ($order_date_sort == 'desc') echo 'selected' ?>>По убыванию</option>
                <option value="asc" <?php if ($order_date_sort == 'asc') echo 'selected' ?>>По возрастанию</option>
              </select>
              <!-- </div> -->
            </div>
            <input type="submit" class="btn btn-primary" name="order_sort_btn" value="Найти">
          </form>
        </div>

        <div class="box-body">
          <br />
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Имя Фамилия</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Комментарий</th>
                <!-- <th>Через кошелёк</th> -->
                <th>Доставка</th>
                <th>Цена доставки</th>
                <th>Итого заказа</th>
                <th>Дата</th>
                <th>Статус</th>
                <th style="text-align: center;">Подробно</th>
                <!-- <th style="text-align: center;">Удалить</th> -->
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $item) : ?>
                <tr>
                  <td><?= $item['id'] ?></td>
                  <td><?= $item['full_name'] ?></td>
                  <td><?= $item['phone_number'] ?></td>
                  <td><?= $item['address'] ?></td>
                  <td><?= $item['comment'] ?></td>
                  <!-- <?php if($item['wallet_name'] && $item['wallet_name'] == "MyBabilon") : ?> -->
                    <!-- <td>Через кошелёк <?= $item['wallet_name'] ?></td> -->
                  <!-- <?php endif; ?> -->
                  <td><?= $item['delivery_name'];?></td>
                  <td><?= $item['delivery_price'];?> сом</td>
                  <td><?= $item['total_price'];?> сом</td>
                  <td><?= $item['created_at'] ?></td>
                  <td style="width: 100px;"><span class="label" style="background:<?= $item['status_color'] ?>; border-radius:.5em"><?= $item['status'] ?></span></td>
                  <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/orderProducts/<?= $item['id'] ?>"><i style="font-size: 24px;color:grey" class="fa fa-edit"> </i></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php if (isset($info['pages'])) : ?>
            <nav aria-label="">
              <ul class="pagination" id="admin_orders_pagination">
                <?php if (isset($info['prev_page'])) : ?>
                  <li><a href="<?= $info['link'] . '' . $info['prev_page'] ?>"><i class="icon-chevron-left"></i>Пред. страница</a></li>
                <?php endif; ?>
                <?php foreach ($info['pages'] as $page) : ?>
                  <li class="<?= $page['current'] ?>"><a href="<?= $page['link'] . '' . $page['page'] ?>"><?= $page['page'] ?></a></li>
                <?php endforeach; ?>
                <?php if (isset($info['next_page'])) : ?>
                  <li><a href="<?= $info['link'] . '' . $info['next_page'] ?>">След. страница<i class="icon-chevron-right"></i></a></li>
                <?php endif; ?>
              </ul>
            </nav>
          <?php endif; ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

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

  function show_order_cancel_btn() {
    if ($('.cancel_date').length) {
      $('.cancel_date').css('display', 'flex');
      $('.cancel_date').show();
    } else {
      $('.cancel_date').hide();
    }
  }

  function cancel_date() {
    $('.order_date').val('');
    $('.cancel_date').hide();
  }
</script>