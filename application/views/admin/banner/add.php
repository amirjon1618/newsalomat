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
    <li class="active">Добавить баннер</li>
  </ol>
</section>
{alert}
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Добавить баннер</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <form role="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Наименование </label>
              <input type="text" id="slider_name" name="slider_name" class="form-control" placeholder="Вводите ...">
            </div>
            <div class="form-group">
              <label>Ссылка (полная) </label>
              <input type="text" id="slider_link" name="slider_link" class="form-control" placeholder="Вводите ...">
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
            <div class="form-group" id="file_div">
              <label class="userfile_label">Изображение </label>
              <input type="file" name="userfile" class="file_inp" size="50" />
              <i class="fa fa-times fa_cancel_file" onclick="cancel_file_input()"></i>
            </div>
            <div class="box-footer">
              <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/banners'" class="btn btn-default">Отмена</button>
              <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
            </div>
          </form>
        </div><!-- /.box-body -->
      </div>
    </div>
  </div>
</section>
<script>

</script>
<script>
  function cancel_file_input() {
    $('.file_inp').val('');
  }

  function validate_chekout() {
    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });

    $('form').validate({
      lang: 'ru',
      rules: {
        slider_name: {
          required: true
        },
        slider_link: {
          required: true,
          url: true
        },
          type: {
              required: true,
          },
        userfile: {
          required: false,
          accept: "image/jpg,image/jpeg,image/png",
          // filesize: 4500000
        }
      },
      messages: {
        userfile: {
          required: "Пожалуйста выберите файл"
        }
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  }

  $(document).ready(function() {
    // validate_chekout();
  });
</script>