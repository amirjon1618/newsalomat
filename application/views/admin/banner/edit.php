<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <?php if (isset($category)) : ?>
      <li><a href="{base_url}index.php/admin/categories">Категории</a></li>
      <li class="active"><?= $category['category_name'] ?></li>
    <?php endif; ?>
    <li class="active">{slider_name}</li>
    <li class="active">Изменить баннер</li>
  </ol>
</section>
{alert}
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Изменить баннер
            <?php if (isset($category)) : ?>
              в категории <?= $category['category_name'] ?>
            <?php endif; ?>
          </h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <form role="form" action="" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="form-group">
              <label>Наименование </label>
              <input type="text" value="{slider_name}" id="slider_name" name="slider_name" class="form-control" placeholder="Вводите ...">
            </div>
            <div class="form-group">
              <label>Ссылка (полная) </label>
              <input required type="text" value="{slider_link}" id="slider_link" name="slider_link" class="form-control" placeholder="Вводите ...">
            </div>
              <div class="form-group">
                  <label>Тип </label>
                  <select class="form-control" name="type">
                      <?php if ($type == '1') : ?>
                          <option selected value="1">ДЛЯ ПК ВЕРСИИ</option>
                          <option value="2">ДЛЯ МОБИЛЬНОЙ ВЕРСИИ</option>
                      <?php elseif ($type == '2') : ?>
                          <option selected value="2">ДЛЯ МОБИЛЬНОЙ ВЕРСИИ</option>
                          <option value="1">ДЛЯ ПК ВЕРСИИ</option>
                      <?php else : ?>
                          <option selected value="2">ДЛЯ МОБИЛЬНОЙ ВЕРСИИ</option>
                          <option value="1">ДЛЯ ПК ВЕРСИИ</option>
                      <?php endif; ?>
                  </select>

              </div>
            <div class="form-group">
              <label class="userfile_label">Изображение </label>
              <input type="file" name="userfile" size="50" class="file_inp" />
              <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input()"></i>
            </div>
            <div class="box-footer">
              <?php if (isset($category)) : ?>
                <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/categoryBanners/<?= $category['id'] ?>'" class="btn btn-default">Отмена</button>
              <?php else : ?>
                <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/banners'" class="btn btn-default">Отмена</button>
              <?php endif; ?>
              <input type="submit" name="AddBtn" value="Изменить" class="btn btn-primary pull-right" />
            </div>
          </form>
        </div><!-- /.box-body -->
</section>
<!-- Bootstrap WYSIHTML5 -->
<script>
  function cancel_file_input() {
    $('.file_inp').val('');
  }
</script>
<script>
  /*$(function() {
  var availableTags = [
    {directions}
  ];
  $( "#tags" ).autocomplete({
    source: availableTags
  });
});*/
</script>