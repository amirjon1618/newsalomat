<section class="content-header">
  <h1>
   <br />
  </h1>
  <ol class="breadcrumb">
	<li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
	<li class="active">Добавить</li>
  </ol>
</section>
{alert}
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Добавить</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <form role="form" action="" onsubmit="return onsub();" method="POST">
						<!-- text input -->
						<div class="form-group">
						  <label>Имя и Фамилия</label>
						  <input type="text" id="delivery_fullname" name="delivery_fullname" class="form-control" placeholder="Укажите полное имя" >
						</div>
						<div class="form-group">
						  <label>Номер телефона</label>
						  <input type="text" id="delivery_phone" name="delivery_phone" class="form-control" placeholder="Номер телефона" >
						</div>
						<div class="form-group">
						  <label>Штрих код (ID)</label>
						  <input type="text" id="delivery_barcode" name="delivery_barcode" maxlength="20" class="form-control" placeholder="Укажите номер доставки (Штрих код/ID)" >
						</div>
						<div class="form-group">
						  <label>Содержимое товара, описание</label>
						  <input type="text" id="delivery_description" name="delivery_description" class="form-control" placeholder="Описание доставки" >
						</div>
						<div class="form-group">
						  <label>Тип доставки</label>
							<select id="delivery_type" name="delivery_type" class="form-control">
								<option value="0">Выберите</option>
								{delivery_type}
								<option value="{id}">{delivery_type_name} ({delivery_type_address})</option>
								{/delivery_type}
							</select>
						</div>
						<div class="box-footer">
							<button type="button" onclick="javascript:window.location.href='{base_url}index.php/Admin/deliverys'" class="btn btn-default">Cancel</button>
							<input type="submit" name="AddBtn" value="Сохранить" class="btn btn-primary pull-right" />
						 </div>
					  </form>
					</div><!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
      <script>
			
      function onsub()
      {
				var b = true;

				$("#delivery_type").css("border-color", "");
				if($("#delivery_type").val()=="0")
				{
					$("#delivery_type").css("border-color", "red");
					b = false;
				}

				if($("#delivery_to").val()=="0")
				{
					$("#delivery_to").css("border-color", "red");
					b = false;
				}

				if($("#delivery_fullname").val()=="")
				{
					$("#delivery_fullname").css("border-color", "red");
					b = false;
				}
        return b;
      }
      
      </script>

