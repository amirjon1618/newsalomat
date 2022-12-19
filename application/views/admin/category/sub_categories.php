<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="{base_url}index.php/admin/Categories"><i class="fa fa-list-ul"></i>
        Категории</a></li>
    <?php if (sizeof($parent_cat['parent_cat']) == 0) : ?>
      <li class="active">
        <?php echo $parent_cat['category_name'] ?></li>
    <?php endif; ?>
    <?php if (sizeof($parent_cat['parent_cat']) != 0) : ?>
      <li><a href="{base_url}index.php/admin/subCategories/<?php echo $parent_cat['parent_cat']['id'] ?>"><i class="fa fa-list-ul"></i>
          <?php echo $parent_cat['parent_cat']['category_name'] ?></a></li>
      <li class="active">
        <?php echo $parent_cat['category_name'] ?></li>
    <?php endif; ?>

    <li class="active">Подкатегории</li>
  </ol>
</section>
{alert}
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">СПИСОК ПОДКАТЕГОРИЙ</h3>
          <a href="{base_url}Admin/addCategory/{category_id}" class="add_btns btn btn-primary">
            <i class="fa fa-plus"></i> Добавить подкатегорию
          </a>
        </div><!-- /.box-header -->

        <div class="box-body">
          <br />
          <br />
          <table id="TableUser" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Название</th>
                <!-- <th>Подкатегория</th> -->
                <!-- <th>Под-подкатегория</th> -->
                <!-- <th>Изображение</th> -->
                <?php if (sizeof($parent_cat['parent_cat']) == 0) : ?>
                  <th style="text-align: center;">Подкатегории</th>
                <?php endif; ?>
                <th style="text-align: center;">Изменить</th>
                <th style="text-align: center;">Удалить</th>
              </tr>
            </thead>
            <tbody>
              {list}
              <tr>
                <td>{id}</td>
                <td>{category_name}</td>
                <!-- <td>{category_name}</td> -->
                <!-- <td>{category_name}</td> -->
                <!-- <td><a target="_blank" href="/upload_banner/{product_pic}"><img src="/upload_product/{product_pic}" style="width: 100px;" /></a></td>-->
                <?php if (sizeof($parent_cat['parent_cat']) == 0) : ?>
                  <td style="text-align: center;width: 96px;"> <a href="{base_url}index.php/Admin/subCategories/{id}"><i style="font-size: 24px;" class="fa fa-list"> </i></a></td>
                <?php endif; ?>
                <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/editCategory/{id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/subCategories/<?= $category_id ?>?do=remove&cat_id={id}" onclick="onPsBlockRight()"><i style="font-size: 24px;color:red" class="fa fa-remove"> </i></a></td>
              </tr>

              {/list}
            </tbody>
          </table>
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
                  <a href="#"><input type="submit" name="register" class="cancel ef1" value="Отмена"></a>
                  <a href="{base_url}index.php/Admin/subCategories/<?= $category_id ?>?do=remove&cat_id={id}"><input type="button" name="register" class="remove rf1" value="Удалить"></a>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
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
</style>