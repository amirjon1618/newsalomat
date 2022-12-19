<!-- Content Header (Page header) -->
    <link rel="stylesheet" href="{base_url}plugins/iCheck/all.css">   
     <section class="content-header">
          <h1>
           <br />
          </h1>
          <ol class="breadcrumb">
            <li><a href="{base_url}"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Добавить</li>
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
                  <h3 class="box-title">Добавить</h3>
                </div><!-- /.box-header -->
                
                 <form action="" method="post" onsubmit="return tryReg();" role="form">
						<div class="box-body pad">
						<!-- text input -->
					
							<div style="display: none" class="form-group">
							  <label>Alias:</label>
							  <input type="text" maxlength="150" class="form-control" name="alias" id="alias">
							</div>
							<div class="form-group">
							  <label>Название (RU):</label>
							  <input type="text" maxlength="150" class="form-control" name="static_name" id="static_name" placeholder="Title">
							</div>
							
							<div class="form-group">
							  <label>Текст (RU):</label>
							  <textarea id="static_text" name="static_text" rows="100" style="height: 500px;" cols="80"></textarea>
							</div>
						  
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
	<!-- <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script> -->
	 <style>
.ck-editor__editable {
    min-height: 400px;
}
</style>
	 <script>
	 //CKEDITOR.plugins.addExternal( 'imagebrowser', '/plugins/imagebrowser/', 'plugin.js' );
	 
	 
	 //CKEDITOR.replace( 'static_text' , {
     //  filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
	   
	//} );
    CKEDITOR.replace( 'static_text' , {
	filebrowserBrowseUrl: '/plugins/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
} );
  //   ClassicEditor
  //      .create( document.querySelector( '#static_text' ), {
	// 	ckfinder: {
	// 		uploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
	// 	},
	// 	toolbar: [ 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'numberedList', 'blockQuote', 'bulletedList' ]
	// } )
	// .catch( error => {
	// 	console.error( error );
	// } );
	</script>
	 <script>
	 
      $(function () {
       $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
	   
	   
	
			
			
		 // CKEDITOR.replace('static_text', {
			  //extraPlugins: 'uploadimage'
			// });
			
      });

      function tryReg()
      {
        $("#static_name").css('border-color','');
				$("#alias").css('border-color','');

        var b = true;
       
			 if($("#alias").val().length==0)
        {
            $("#alias").css('border-color','red');
            $("#alias").focus();
            b=false;
        }

        if($("#static_name").val().length==0)
        {
            $("#static_name").css('border-color','red');
            $("#static_name").focus();
            b=false;
        }
       

        return b;
      }
    </script>