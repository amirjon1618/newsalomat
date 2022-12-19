<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Баннеры</li>
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
          <h3 class="box-title">СПИСОК СЛАЙДЕРОВ</h3>
          <a href="{base_url}index.php/admin/addBanner" class="add_btns add_btns_color btn btn-primary">
            <i class="fa fa-plus"></i> Добавить баннер
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
                <th>Линк</th>
                <th>Изображение</th>
                <th style="text-align: center;">Изменить</th>
                <th style="text-align: center;">Удалить</th>
              </tr>
            </thead>
            <tbody id="dragAndDrop" draggable="true">
              <?php foreach ($list as $item) : ?>
                <tr ondrop="onDrop()">
                  <td><?= $item['slider_id'] ?></td>
                  <td><?= $item['slider_name'] ?></td>
                  <td><a href="<?= $item['slider_link'] ?>"><?= $item['slider_link'] ?></a></td>
                  <td style="text-align: center;width: 100px;"><a target="_blank" href="<?= $item['base_url'] ?>upload_banner/<?= $item['slider_pic'] ?>"><img src="<?= $item['base_url'] ?>upload_banner/<?= $item['slider_pic'] ?>" style="width: 100px;" /></a></td>
                  <td style="text-align: center;width: 100px;">
                    <a href="{base_url}index.php/admin/editBanner/<?= $item['slider_id'] ?>">
                      <i style="font-size: 24px;" class="fa fa-edit"> </i>
                    </a>
                  </td>
                  <td style="text-align: center;width: 100px;"> <a href="#" onclick="onPsBlockRight()"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
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
<div class="enter-btn-bg">
  <div class="enter-btn-modal">
    <div class="page-content">
      <div class="form-v8-content">
        <div class="enter-form">
          <div class="enter-form_reg efr1">
            <div class="tab">
              <div class="tab-inner pb-5">
                <h3 class="tablinks text-center">Хотите удалить ?</h3>
              </div>
            </div>
            <form class="form-detail">
              <div class="tabcontent" id="sign-phone">
                <div class="form-row-last d-flex justify-content-between">
                  <a href="#"><input type="submit" name="register" class="cancel ef1" value="Отмена"></a>
                  <a href="<?= $item['base_url'] ?>index.php/Admin/banners?do=remove&slider_id=<?= $item['slider_id'] ?>"><input type="button" name="register" class="remove rf1" value="Удалить"></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
      url: "{base_url}products/updateOrderInSlider",
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

  function change_status(id) {
    var checked = 0;
    if ($('#stat_checkbox' + id).is(':checked')) {
      checked = 1;
    } else {
      checked = 0;
    }
    $.getJSON("<?= base_url() ?>index.php/admin/addCategoryToMain?main=" + checked + "&id=" + id, function(data, status) {
      if (data == 1) {
        location.reload();
      } else {
        alert(data);
      }
    });
  }

  function onPsBlockRight() {
    document.querySelector(".enter-btn-bg").style.display = "flex";
    document.querySelector(".enter-btn-bg").classList.add("active-animation");
    document.querySelector(".enter-btn-bg").classList.remove("disactive-animation");
  }
  document.querySelector(".enter-btn-bg").addEventListener('click', ({
    target
  }) => {
    if (target.classList.contains("enter-btn-bg")) {
      document.querySelector(".enter-btn-bg").classList.remove("active-animation");
      document.querySelector(".enter-btn-bg").classList.add("disactive-animation");
      document.querySelector(".enter-btn-bg").style.display = "none";
    }
  })
  /*===== DRAG and DROP =====*/
  const dropItems = document.getElementById('dragAndDrop')

  new Sortable(dropItems, {
    animation: 350,
    chosenClass: "sortable-chosen",
    dragClass: "sortable-drag"
  });
</script>
<style>
  .enter-btn-bg {
    justify-content: center;
    align-items: center;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 10000;
    width: 100vw;
    height: 100vh;
    transition: 1000ms;
    display: none;
  }

  .enter-btn-modal {
    background-color: #fff;
    padding: 45px;
    border-radius: 5px;
  }

  .tablinks {
    font-size: 22px;
    font-weight: 700;
    text-align: center;
    line-height: 28px;
    padding-bottom: 35px;
  }

  .cancel {
    background: transparent;
    padding: 10px 45px;
    border: 1px solid #A8A8A8;
    color: #A8A8A8;
    border-radius: 5px;
    font-size: 18px;
    margin-right: 16px;
  }

  .remove {
    background: #EF5D70;
    padding: 10px 45px;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 18px;
  }

  .form-btn {
    float: right;
    color: #fff;
    background: #1EBEBE;
    border-radius: 5px;
    border: none;
    margin: 10px 10px 20px 0;
    padding: 10px 40px;
  }

  .form-btn:hover {
    background: #18A1A1;
  }
</style>