<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Список товаров</li>
  </ol>
</section>
{alert}
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header product_box-header">
          <div class="prods_buttons">
            <div id="add_prod_btn">
              <a href="{base_url}index.php/admin/addProduct?from_page={current_page}">
                <button class="add_btns_color btn btn-primary"><i class="fa fa-plus"></i> Добавить товар</button>
              </a>
            </div>
            <!-- <div id="import_prods">
              <a href="{base_url}index.php/admin/importJsonFile">
                <button class="import_btn btn btn-primary">
                  <i class="fa fa-cloud-download"></i>
                  Импорт товаров
                </button>
              </a>
            </div> -->
          </div>
          <h3 class="box-title">СПИСОК ТОВАРОВ</h3>
          <h4>ОБЩ. КОЛ-ВО ТОВАРОВ: <?= $info['total_products'] ?></h4>
        </div><!-- /.box-header -->
        <div>
          <div class="filter_button">
            <i class="fa fa-filter" aria-hidden="true"></i>
            <h4> Фильтр</h4>
            <i class="fa fa-chevron-down filter_button_arrow_right" aria-hidden="true"></i>
          </div>
        </div>
        <div class="product_sort_form_div">
          <form id="sort_form" method="get" action="">
            <div class="form-group">
              <!-- <label for="search_prod">Поиск</label> -->
              <input value="<?= $search_prod?>" placeholder="Поиск..." class="form-control" type="text" id="search_prod" name="search_prod">
            </div>
            <div class="sort_form_filter_divs">
              <div class="form-group each_sort_div">
                <label for="category_sort">Категория</label>
                <select class="form-control" name="category_sort" type="text" id="category_sort">
                  <?php if (isset($info['product_category_sort'])) : ?>
                    <option value="<?= $info['product_category_sort']['id'] ?>"><?= $info['product_category_sort']['category_name'] ?></option>
                  <?php endif; ?>
                </select>
              </div>

              <div class="form-group each_sort_div">
                <label for="brand_sort">Производитель</label>
                <select class="form-control chosen-select" name="brand_sort" type="text" id="brand_sort">
                  <?php if (isset($info['product_brand_sort'])) : ?>
                    <option value="<?= $info['product_brand_sort']['id'] ?>"><?= $info['product_brand_sort']['brand_name'] ?></option>
                  <?php endif; ?>
                </select>
              </div>
              <div class="form-group each_sort_div">
                <label for="price_sort">Цена</label>
                <select class="form-control" id="price_sort" name="price_sort">
                  <option value=""></option>
                  <option value="asc" <?php if (isset($info['product_price_sort'])) {
                                        if ($info['product_price_sort'] == 'asc') echo 'selected';
                                      } ?>>По возрастанию</option>
                  <option value="desc" <?php if (isset($info['product_price_sort'])) {
                                          if ($info['product_price_sort'] == 'desc') echo 'selected';
                                        } ?>>По убыванию</option>
                </select>
              </div>
              <div class="form-group each_sort_div">
                <label for="export_status_sort">Импортированные товары</label>
                <select class="form-control" id="export_status_sort" name="export_status_sort">
                  <option value=""></option>
                  <option value="0"
                  <?php if (isset($info['export_status_sort'])) {
                    if ($info['export_status_sort'] == '0') echo 'selected';
                  } ?>>Не показываемые товары</option>
                </select>
              </div>
            </div>
            <input type="submit" class="prod_sort_btn btn btn-primary" name="sort_btn" value="Найти">
          </form>
        </div>
        <div class="box-body">
          <br />
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Старая цена</th>
                <th>Реальная цена</th>
                <th>Количество</th>
                <th>Аватарка</th>
                <th>Товар дня</th>
                <th>Рекламный товар</th>
                <th>Товар в категории</th>
                <th>Показывать товар</th>
                <th>Изображения</th>
                <th style="text-align: center;">Изменить</th>
                <th style="text-align: center;">Удалить</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $item) : ?>
                <tr>
                  <td><?= $item['id'] ?></td>
                  <td><?= $item['product_name'] ?></td>
                  <td><?= $item['product_old_price'] ?></td>
                  <td><?= $item['product_price'] ?></td>
                  <td><?= $item['total_count_in_store'] ?></td>
                  <td><img src="<?= $item['base_url'] ?>upload_product/<?= $item['product_pic'] ?>" alt="" style="width: 100px;"></td>
                  <td style="text-align: center;width: 100px;">
                    <input id="prod_of_the_day_checkbox<?= $item['id'] ?>" type="checkbox" onclick="change_prod_of_the_day(<?= $item['id'] ?>)" <?php if ($item['product_of_the_day'] != 0) echo 'checked="checked"'; ?>>
                  </td>
                  <td style="text-align: center;width: 100px;">
                    <input id="prod_suggestions_checkbox<?= $item['id'] ?>" type="checkbox" onclick="change_prod_suggestions(<?= $item['id'] ?>)" <?php if ($item['product_suggestions'] != 0) echo 'checked="checked"'; ?>>
                  </td>
                  <td style="text-align: center;width: 100px;">
                    <input id="prod_in_category_checkbox<?= $item['id'] ?>" type="checkbox" onclick="change_prod_in_category(<?= $item['id'] ?>)" <?php if ($item['product_in_category'] != 0) echo 'checked="checked"'; ?>>
                  </td>
                  <td style="text-align: center;width: 100px;">
                    <input type="checkbox" <?php if ($item['product_status'] != 0) echo 'checked="checked"'; ?> disabled="disabled">
                  </td>
                  <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/productImages/<?= $item['id'] ?>"><i style="font-size: 24px;" class="fa fa-picture-o"> </i></a></td>
                  <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/editProduct/<?= $item['id'] ?>?from_page={current_page}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                  <td style="text-align: center;width: 96px;"> <a class="confirmation" href="{base_url}index.php/Admin/products?do=remove&id=<?= $item['id'] ?>&page={current_page}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <nav aria-label="" class="prods_nav_pagination">
            <div class="go_to_page_div">
              <form class="go_to_page_form" action="{base_url}index.php/admin/productsGoToPage" method="GET">
                <input class="form-control" name="search_prod" type="hidden" value="<?= $search_prod?>" hidden>
                <input class="form-control" name="category_sort" type="hidden" value="<?= $category_sort?>" hidden>
                <input class="form-control" name="brand_sort" type="hidden" value="<?= $brand_sort?>" hidden>
                <input class="form-control" name="price_sort" type="hidden" value="<?= $price_sort?>" hidden>
                <input class="form-control" name="export_status_sort" type="hidden" value="<?= $export_status_sort?>" hidden>
                <input class="form-control" name="go_to_page" type="text" placeholder="Страница ...">
                <button type="submit" class="btn btn-primary">Перейти</button>
              </form>
            </div>
            <ul class="pagination" id="admin_products_pagination">
              <?php if (isset($info['prev_page'])) : ?>
                <li><a href="<?= $info['link'] . '' . $info['prev_page'] ?>"><i class="icon-chevron-left"></i><span class="dnone-text_btn">Пред. стр.</span></a></li>
              <?php endif; ?>
              <?php foreach ($info['pages'] as $page) : ?>
                <li class="<?= $page['current'] ?>"><a href="<?= $page['link'] . '' . $page['page'] ?>"><?= $page['page'] ?></a></li>
              <?php endforeach; ?>
              <?php if (isset($info['next_page'])) : ?>
                <li><a href="<?= $info['link'] . '' . $info['next_page'] ?>"><span class="dnone-text_btn">След. стр.</span><i class="icon-chevron-right"></i></a></li>
              <?php endif; ?>
            </ul>
          </nav>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<script>
  function change_prod_of_the_day(id) {
    var checked = 0;
    if ($('#prod_of_the_day_checkbox' + id).is(':checked')) {
      checked = 1;
    } else {
      checked = 0;
    }
    $.getJSON("<?= base_url() ?>index.php/admin/changeProdOfTheDay", {
      stat: checked,
      prod_id: id
    }, function(data, status) {
      if (data == 1) {
        location.reload();
      }
    });
  }

  function change_prod_suggestions(id) {
    var checked = 0;
    if ($('#prod_suggestions_checkbox' + id).is(':checked')) {
      checked = 1;
    } else {
      checked = 0;
    }
    $.getJSON("<?= base_url() ?>index.php/admin/changeProdSuggestions", {
      stat: checked,
      prod_id: id
    }, function(data, status) {
      if (data == 1) {
        location.reload();
      }
    });
  }

  function change_prod_in_category(id) {
    var checked = 0;
    if ($('#prod_in_category_checkbox' + id).is(':checked')) {
      checked = 1;
    } else {
      checked = 0;
    }
    $.getJSON("<?= base_url() ?>index.php/admin/changeProdInCategory", {
      stat: checked,
      prod_id: id
    }, function(data, status) {
      if (data == 1) {
        location.reload();
      }
    });
  }

  function filter_show() {
    $('.filter_button').click(function() {
      if ($('.product_sort_form_div').is(':visible')) {
        $('.product_sort_form_div').fadeOut();
        $('.filter_button_arrow_right').css('transform', 'rotate(-90deg)');
      } else {
        $('.product_sort_form_div').fadeIn();
        $('.filter_button_arrow_right').css('transform', 'rotate(0deg)');
      }
    });
  }

  $(document).ready(function() {
    filter_show();
    $("#category_sort").select2({
      placeholder: "Выберите категорию",
      allowClear: true,
      width: "auto",
      dropdownAutoWidth: true,
      minimumInputLength: 1,
      ajax: {
        url: '{base_url}Api/GetMinSubCategory',
        dataType: "json",
        data: function(term) {
          return {
            term: term.term
          };
        },
        processResults: function(data) {
          return {
            results: data
          };
        }
      }
    });

    $("#brand_sort").select2({
      placeholder: "Выберите производителя",
      allowClear: true,
      width: "resolve",
      dropdownAutoWidth: true,
      minimumInputLength: 1,
      width: 'resolve',
      ajax: {
        url: '{base_url}Api/GetBrand',
        dataType: "json",
        data: function(term) {
          return {
            term: term.term
          };
        },
        processResults: function(data) {
          return {
            results: data
          };
        }
      }
    });
  });


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
<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>