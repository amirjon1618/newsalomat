<section class="content-header">
  <h1>
   <br />
  </h1>
  <ol class="breadcrumb">
	<li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
	<li class="active">Обработать</li>
  </ol>
</section>
{alert}
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Обработать</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <form role="form" action="" onsubmit="return onsub();" method="POST">
						<table id="TableUser" style="{table_display}" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th colspan="4" style="text-align: center;font-size: 14;">Ожидаемый список для этого клиента</th>
								</tr>
								<tr>
									<th>delivery_id</th>
									<th>delivery_barcode</th>
									<th>delivery_status</th>
									<th>delivery_create</th>
								</tr>
							</thead>
							<tbody>
							{delivery_list}
								<tr>
									<td>{delivery_id}</td>
									<td>{delivery_barcode}</td>
									<td>{status_text}</td>
									<td>{delivery_create}</td>
								</tr>
								{/delivery_list}
							</tbody>
						</table>
						<!-- text input -->
						<div class="form-group">
						  <label>Имя и Фамилия</label>
						  <input value="{delivery_fullname}" type="text" id="delivery_fullname" name="delivery_fullname" class="form-control" placeholder="Укажите полное имя" >
						</div>
						<div class="form-group">
						  <label>Номер телефона</label>
						  <input value="{delivery_phone}" type="text" id="delivery_phone" name="delivery_phone" class="form-control" placeholder="Номер телефона" >
						</div>
						<div class="form-group">
						  <label>Штрих код (ID)</label>
						  <input value="{delivery_barcode}" type="text" id="delivery_barcode" name="delivery_barcode" maxlength="20" class="form-control" placeholder="Укажите номер доставки (Штрих код/ID)" >
						</div>
						<div class="form-group">
						  <label>Содержимое товара, описание</label>
						  <input value="{delivery_description}" type="text" id="delivery_description" name="delivery_description" class="form-control" placeholder="Описание доставки" >
						</div>
						<div class="form-group">
						  <label>Тип доставки</label>
							<select id="delivery_type" name="delivery_type" class="form-control">
								<option value="0">Выберите</option>
								{delivery_type_list}
								<option value="{id}">{delivery_type_name}</option>
								{/delivery_type_list}
							</select>
						</div>
						<div class="form-group">
						  <label>В какой склад</label>
							<select id="delivery_to" name="delivery_to" class="form-control">
								<option value="0">Выберите</option>
								{delivery_to_list}
								<option value="{id}">{delivery_to_name} ({delivery_type_address})</option>
								{/delivery_to_list}
							</select>
						</div>
						<div style="display: none;" class="form-group">
						  <label>Цена</label>
							<input value="{delivery_unit_price}" readonly="readonly" type="number" onkeyup="calc();" step="0.01" id="delivery_unit_price" name="delivery_unit_price" class="form-control" placeholder="Цена" >
						</div>
						<div class="form-group">
						  <label>Объем товара</label>
							<div class="row">
								<div class="col-md-4">
									<input style="" value="{delivery_length}" onkeyup="calc1();" type="number" step="0.01" id="delivery_length" name="delivery_length" class="form-control" placeholder="Длина (метров)" >
								</div>
								<div class="col-md-4">
									<input style="" value="{delivery_width}" onkeyup="calc1();" type="number" step="0.01" id="delivery_width" name="delivery_width" class="form-control" placeholder="Ширина (метров)" >
								</div>
								<div class="col-md-4">
									<input style="" value="{delivery_height}" onkeyup="calc1();" type="number" step="0.01" id="delivery_height" name="delivery_height" class="form-control" placeholder="Высота (метров)" >
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Вес товара</label>
							<input value="{delivery_weight}"  type="number" onkeyup="calc2();" step="0.01" id="delivery_weight" name="delivery_weight" class="form-control" placeholder="Вес (кг)" >
						</div>
						<div style="display: none;" class="form-group">
						  <label>Цена доставки</label>
							<input value="{delivery_price}" readonly="readonly" type="number" step="0.01" id="delivery_price" name="delivery_price" class="form-control" placeholder="Цена за доставку" >
						</div>
						<div class="box-footer">
							<button type="button" onclick="backAway()" class="btn btn-default">Cancel</button>
							<input type="submit" name="AddBtn" value="Сохранить" class="btn btn-primary pull-right" />
						 </div>
						<input type="hidden" name="referral" value="{referral}" />
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

			function calc()
			{
				if($("#delivery_unit_price").val()!=0)
				{
					if(($("#delivery_length").val().length>0) && ($("#delivery_width").val().length>0) && ($("#delivery_height").val().length>0))
					{
						calc1();
					}
					else if($("#delivery_weight").val().length>0)
					{
						calc2();
					}
				}
			}


			function calc1()
			{

				$("#delivery_weight").val("");

				var x = $("#delivery_length").val();
				var y = $("#delivery_width").val();
				var z = $("#delivery_height").val();
				var price = $("#delivery_unit_price").val();
				var sum = (x*y*z*price).toFixed(2);

				$("#delivery_price").val(sum);
			}

			function calc2()
			{
				if($("#delivery_weight").val().length>0)
				{
					$("#delivery_length").val('');
					$("#delivery_width").val('');
					$("#delivery_height").val('');

					var x = $("#delivery_weight").val();
					var price = $("#delivery_unit_price").val();
					var sum = (x*price).toFixed(2);
					$("#delivery_price").val(sum);
				}
			}
      
      </script>

