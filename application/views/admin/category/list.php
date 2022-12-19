<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Категории</li>
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
          <h3 class="box-title">СПИСОК КАТЕГОРИЙ</h3>
          <a href="{base_url}Admin/addCategory/0" class="add_btns add_btns_color btn btn-primary">
            <i class="fa fa-plus"></i> Добавить категорию
          </a>
        </div><!-- /.box-header -->
        <div class="box-body">
          <br />
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th style="text-align: center;">Иконка</th>
                <th>Название</th>
                <!-- <th>Подкатегория</th> -->
                <!-- <th>Под-подкатегория</th> -->
                <!-- <th>Изображение</th> -->
                <th style="text-align: center;">Подкатегории</th>
                <th style="text-align: center;">Изменить</th>
                <th style="text-align: center;">Добавить в главную</th>
                <th style="text-align: center;">Добавить слайдер</th>
                <th style="text-align: center;">Слайдеры</th>
                <th style="text-align: center;">Удалить</th>
              </tr>
            </thead>
            <tbody id="dragAndDrop" draggable="true">
              <?php foreach ($list as $item) : ?>
                <tr ondrop="onDrop()">
                  <td style="text-align: center;width: 50px;"><?= $item['id'] ?></td>
                  <td style="text-align: center;width: 60px;"><img src="<?= $item['base_url'] ?>img/icons/<?= $item['icon'] ?>" style="width: 30px;" /></a></td>
                  <td><?= $item['category_name'] ?></td>
                  <!-- <td>{category_name}</td> -->
                  <!-- <td>{category_name}</td> -->
                  <!-- <td><a target="_blank" href="/upload_banner/{product_pic}"><img src="/upload_product/{product_pic}" style="width: 100px;" /></a></td>-->
                  <td style="text-align: center;width: 96px;"> <a href="<?= base_url() ?>index.php/Admin/subCategories/<?= $item['id'] ?>"><i style="font-size: 24px;" class="fa fa-list"> </i></a></td>
                  <td style="text-align: center;width: 100px;"> <a class="" href="<?= base_url() ?>index.php/Admin/editCategory/<?= $item['id'] ?>"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                  <td style="text-align: center;width: 100px;">
                    <input id="stat_checkbox<?= $item['id'] ?>" type="checkbox" onclick="change_status(<?= $item['id'] ?>)" <?php if ($item['category_in_main'] == 1) echo 'checked="checked"'; ?> <?php if ($item['total_cat_in_main'] == 3 && !($item['category_in_main'] != 0)) echo 'disabled' ?>>
                  </td>
                  <td style="text-align: center;width: 100px;"> <a class="" href="<?= base_url() ?>index.php/Admin/addBanner/<?= $item['id'] ?>"><i style="font-size: 24px;" class="fa fa-plus-square-o"> </i></a></td>
                  <td style="text-align: center;width: 100px;"> <a class="" href="<?= base_url() ?>index.php/Admin/categoryBanners/<?= $item['id'] ?>"><i style="font-size: 24px;" class="fa fa-list"> </i></a></td>
                  <td style="text-align: center;width: 100px;"> <a class="" onclick="onPsBlockRight(<?php echo $item['id']  ?>)" href="#"><i style="font-size: 24px;color:red" class="fa fa-remove"> </i></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <button class="form-btn" onclick="javascript:window.location.reload()">Сохранить</button>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
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
                  <button type="button" name="register" class="cancel ef1" value="Отмена">Отмена</button>
                  <a href="<?= base_url() ?>index.php/Admin/Categories?do=remove&cat_id=<?= $item['id'] ?>" id="deleteCategories"><input type="button" name="register" class="remove rf1" value="Удалить"></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
      url: "{base_url}products/updateOrderInCategory",
      headers: {
        "Accept": "application/json",
      },
      data: {
        sort
      },
    })
  }

  // Array.from(document.querySelectorAll("#TableUser tr")).forEach(elem => {
  //   elem.addEventListener("mouseup", () => {
  //     alert("")
  //   })
  // })

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


  function onPsBlockRight(id) {
    deleteCategories.href = `<?= base_url() ?>index.php/Admin/Categories?do=remove&cat_id=${id}`;
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
  $(".cancel").on("click", () => {
    $(".enter-btn-bg").hide()
  })
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
    box-shadow: 5px 5px 5px 5px #e5e5e5;
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
    margin: 30px 10px 20px 0;
    padding: 10px 40px;
  }

  .form-btn:hover {
    background: #18A1A1;
  }
</style>