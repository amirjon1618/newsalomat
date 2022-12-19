<section class="content-header">
  <h1>
   <br />
  </h1>
  <ol class="breadcrumb">
	<li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
	<li class="active">О компании</li>
  </ol>
</section>
{alert}
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">О компании</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <form role="form" action="" onsubmit="return onsub();" method="POST">
						<!-- text input -->
						
						<div class="form-group">
						  <label>Текст</label>
							<textarea id="text" name="text" rows="10" class="form-control">{text}</textarea><br />
							<input type="text" name="email" class="form-control" id="email" value="{email}" /><br />
							<input type="text" name="phone" class="form-control" id="phone" value="{phone}" /><br />
						</div>
						
						<div class="box-footer">
							<button type="button" onclick="window.location.href='{base_url}index.php/Admin/'" class="btn btn-default">Отмена</button>
							<input type="submit" name="AddBtn" value="Сохранить" class="btn btn-primary pull-right" />
						 </div>
					  </form>
					</div><!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>

      <script>
			function backAway(){
					//if it was the first page
					if(history.length === 1){
							window.location = "{base_url}Admin/deliverys"
					} else {
							history.back();
					}
			}

			$("#delivery_type").val('{delivery_type}');
			$("#delivery_to").val('{delivery_to}');

      function onsub()
      {
				var b = true;
       
        return b;
      }

		
      
      </script>

