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
					  <h3 class="box-title">Статус</h3>
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
						  <input readonly="readonly" value="{delivery_fullname}" type="text" id="delivery_fullname" name="delivery_fullname" class="form-control" placeholder="Укажите полное имя" >
						</div>
						<div class="form-group">
						  <label>Номер телефона</label>
						  <input readonly="readonly" value="{delivery_phone}" type="text" id="delivery_phone" name="delivery_phone" class="form-control" placeholder="Номер телефона" >
						</div>
						<div class="form-group">
						  <label>Штрих код (ID)</label>
						  <input readonly="readonly" value="{delivery_barcode}" type="text" id="delivery_barcode" name="delivery_barcode" maxlength="20" class="form-control" placeholder="Укажите номер доставки (Штрих код/ID)" >
						</div>
						<div class="form-group">
						  <label>Содержимое товара, описание</label>
						  <input readonly="readonly" value="{delivery_description}" type="text" id="delivery_description" name="delivery_description" class="form-control" placeholder="Описание доставки" >
						</div>
						<div class="form-group">
						  <label>К оплате</label>
						  <input readonly="readonly" value="{delivery_price}" type="text" id="delivery_price" name="delivery_price" class="form-control" placeholder="" >
						</div>
						<div class="form-group">
						  <label>Статус</label>
							<select id="delivery_status" name="delivery_status" class="form-control">
							{status}
								<option value="{id}">{status_text}</option>
							{/status}
							</select>
						</div>
					
						<div class="box-header with-border">
					  	<h3 class="box-title">История статуса</h3>
						</div>
						
						<div class="form-group">
						{history}
							<div class="row">
								<div class="col-md-4">
									<label>Статус:</label> {history_status_str}
								</div>
								<div class="col-md-4">
									<label>Дата:</label> {history_date}
								</div>
								<div class="col-md-4">
									<label>Изменил:</label> {login} ({name})
								</div>
							</div>
							{/history}
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

			$("#delivery_status").val('{delivery_status}');

      function onsub()
      {
				var b = true;
       
        return b;
      }
      
      </script>

