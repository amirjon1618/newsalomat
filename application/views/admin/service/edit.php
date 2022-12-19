<section class="content-header">
<h1>
<br />
</h1>
<ol class="breadcrumb">
    <li><a href="{base_url}admin"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Изменить</li>
</ol>
</section>
{alert}
<section class="content">
  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Изменить</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="form-group">
                <label>Наименование </label>
                <input value="{title}" type="text" id="title" name="title" class="form-control" placeholder="Вводите ..." >
            </div>
            <div class="form-group">
                <label>Описание </label>
                <input value="{description}" type="text" id="description" name="description" class="form-control" placeholder="Вводите ..." >
            </div>
            <div class="form-group">
                <label>Изображение </label>
                <br />
                <img style="max-width: 200px;" src="{base_url}upload_banner/{image}" />
                <br />
                <br />
                <input type="file" name="userfile" size="20" />
            </div>
            <!-- textarea -->
            <div class="form-group">
                <label>Текст</label>
                <textarea id="text" name="text" rows="10" cols="25" class="form-control" >{text}</textarea>
            </div>
            <div class="box-footer">
                <button type="button" onclick="javascript:window.location.href='{base_url}index.php/Admin/services'" class="btn btn-default">Cancel</button>
                <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                </div>
            </form>
        </div><!-- /.box-body -->
        </section >
        <script src="{base_url}plugins/ckeditor/ckeditor.js"></script> 
      <!-- Bootstrap WYSIHTML5 -->
      <script>
         CKEDITOR.replace( 'text' , {
            filebrowserBrowseUrl: '/plugins/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        } );
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
