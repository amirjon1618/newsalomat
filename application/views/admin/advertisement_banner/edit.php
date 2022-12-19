<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="{base_url}admin/advertisementBanners"><i class="fa fa-list"></i> Рекламные баннеры</a></li>
    <li class="active">Добавить рекламный баннер</li>
  </ol>
</section>
{alert}
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Добавить рекламный баннер</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <form role="form" action="" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="form-group">
              <label>Наименование </label>
              <input type="text" value="{advertisement_name}" id="ad_slider_name" name="ad_slider_name" class="form-control" placeholder="Вводите ...">
            </div>
            <div class="form-group">
              <label>Ссылка (полная) </label>
              <input type="text" id="ad_slider_link" value="{advertisement_link}" name="ad_slider_link" class="form-control" placeholder="Вводите ...">
            </div>
            <div class="form-group" id="file_div">
              <label class="userfile_label">Изображение </label>
              <input type="file" name="userfile" class="file_inp" size="20" />
              <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input()"></i>
            </div>
            <!-- textarea -->
            <div class="form-group">
              <label>Тип</label>
              <select name="ad_type" id="ad_type">
                <option value="">Выберите</option>
                <option value="slider" <?php if ($advertisement_type == 'slider') echo 'selected' ?>>Слайдер</option>
                <option value="mini_pic" <?php if ($advertisement_type == 'mini_pic') echo 'selected' ?>>Мини фото</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ad_banner_category" class="ad_banner_category_label">Под-категория </label>
              <select data-placeholder="Выберите ..." name="ad_banner_category" id="ad_banner_category" class="chosen-select">
                <?php if (sizeof($adv_category)) : ?>
                  <option value="<?php echo $adv_category['id']; ?>" selected>
                      <?php echo $adv_category['category_name']; ?></option>
                <?php endif; ?>
              </select>
            </div>
            <div class="box-footer">
              <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/advertisementBanners'" class="btn btn-default">Отмена</button>
              <input type="submit" name="AddBtn" value="Изменить" class="btn btn-primary pull-right" />
            </div>

          </form>
        </div><!-- /.box-body -->
</section>
<script>
  function cancel_file_input() {
    $('.file_inp').val('');
  }
  $(document).ready(function() {
    $("#ad_banner_category").select2({
      width: "auto",
      dropdownAutoWidth: true,
      minimumInputLength: 1,
      allowClear: true,
      ajax: {
        url: '{base_url}Api/GetSubCategory',
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
</script>