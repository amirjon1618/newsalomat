<section class="content-header">
  <h1>
    <br />
  </h1>
  <ol class="breadcrumb">
    <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Добавить</li>
  </ol>
</section>
{alert}
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Добавить</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <form role="form" action="" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="form-group">
              <label>Наименование </label>
              <input type="text" id="benefit_name" name="benefit_name" class="form-control" placeholder="Вводите ...">
            </div>
            <div class="form-group">
              <label>Изображение </label>
              <input type="file" name="userfile" size="20" />
            </div>
            <!-- textarea -->
            <div class="form-group">
              <label>Текст</label>
              <textarea id="benefit_text" name="benefit_text" rows="10" cols="25" class="form-control"></textarea>
            </div>
            <div class="box-footer">
              <button type="button" onclick="javascript:window.location.href='{base_url}index.php/Admin/benefits'" class="btn btn-default">Cancel</button>
              <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
            </div>

          </form>
        </div><!-- /.box-body -->
</section>
<!-- Bootstrap WYSIHTML5 -->
<script>

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