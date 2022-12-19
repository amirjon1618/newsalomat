<!-- Content Header (Page header) -->
    <link rel="stylesheet" href="{base_url}plugins/iCheck/all.css">   
     <section class="content-header">
          <h1>
           <br />
          </h1>
          <ol class="breadcrumb">
            <li><a href="{base_url}index.php/admin/"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Изменить</li>
          </ol>
        </section>
         {alert}
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Изменить</h3>
                </div><!-- /.box-header -->
                
                 <form action="" method="post" onsubmit="return tryReg();" role="form">
                  <div class="box-body pad">
                    <!-- text input -->
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tab_1" data-toggle="tab">RU</a></li>
						  <li><a href="#tab_2" data-toggle="tab">TJ</a></li>
						  <li><a href="#tab_3" data-toggle="tab">EN</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active" id="tab_1">
							<div class="form-group">
							  <label>Alias:</label>
							  <input type="text" maxlength="150" value="{alias}" class="form-control" name="alias" id="alias">
							</div>
							<div class="form-group">
							  <label>Название (RU):</label>
							  <input type="text" maxlength="150" value="{static_name}" class="form-control" name="static_name" id="static_name" placeholder="Title">
							</div>
							
							<div class="form-group">
							  <label>Текст (RU):</label>
							  <textarea id="static_text" name="static_text" rows="10" cols="80">{static_text}</textarea>
							</div>
						  </div><!-- /.tab-pane -->
						  <div class="tab-pane" id="tab_2">
							<div class="tab-pane active" id="tab_1">
								<div class="form-group">
								  <label>Название (TJ):</label>
								  <input type="text" maxlength="150" class="form-control" name="news_title_TJ" id="news_title_TJ" placeholder="Title">
								</div>
								
								<div class="form-group">
								  <label>Текст (TJ):</label>
								  <textarea id="news_text_TJ" name="news_text_TJ" rows="10" cols="80"></textarea>
								</div>
							 </div>
						  </div><!-- /.tab-pane -->
						  <div class="tab-pane" id="tab_3">
							<div class="tab-pane active" id="tab_1">
								<div class="form-group">
								  <label>Название (EN):</label>
								  <input type="text" maxlength="150" class="form-control" name="news_title_EN" id="news_title_EN" placeholder="Title">
								</div>
								
								<div class="form-group">
								  <label>Текст (EN):</label>
								  <textarea id="news_text" name="news_text_EN" rows="10" cols="80"></textarea>
								</div>
							 </div>
						  </div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
					  </div><!-- nav-tabs-custom -->
                    
					
                    <div class="box-footer">
                        <button type="button" onclick="javascript:window.location.href='{base_url}index.php/admin/articles'" class="btn btn-default">Отмена</button>
                        <input type="submit" name="AddBtn" value="Создать" class="btn btn-primary pull-right" />
                     </div>
                 </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
	<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{base_url}plugins/iCheck/icheck.min.js"></script>
	<script src="{base_url}plugins/ckeditor/ckeditor.js"></script>
	 <script>
      $(function () {
       $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
	   
	   
		  CKEDITOR.replace('static_text', {
			  extraPlugins: 'imageuploader'
			});
			
			CKEDITOR.replace('news_text_TJ', {
			  extraPlugins: 'imageuploader'
			});
				
			CKEDITOR.replace('news_text_EN', {
			  extraPlugins: 'imageuploader'
			});
			
			
		CKEDITOR.plugins.add( 'imageuploader', {
		init: function( editor ) {
			editor.config.filebrowserBrowseUrl = '{base_url}plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
		}});
      });

      function tryReg()
      {
        $("#static_name").css('border-color','');		

        var b = true;
       
        if($("#static_name").val().length==0)
        {
            $("#static_name").css('border-color','red');
            $("#static_name").focus();
            b=false;
        }
       

        return b;
      }
    </script>