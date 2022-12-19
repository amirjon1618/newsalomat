<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <br />
          </h1>
          <ol class="breadcrumb">
            <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Список</li>
          </ol>
        </section>
         {alert}
        <!-- Main content -->
        <section class="content">
         <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Список</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                      <form action="" onsubmit="return searchForm();" method="get">
                        <div class="col-xs-2">
                          <input placeholder="от" type="date" value="<?=$this->input->get("date1")?>" name="date1" id="date1" class="form-control" />
                        </div>
                        <div class="col-xs-2">
                          <input placeholder="до" type="date" value="<?=$this->input->get("date2")?>" name="date2" id="date2" class="form-control" />
                        </div>
                        <div class="col-xs-1">
                          <input type="submit" name="q" value="Поиск" class="btn btn-default pull-right" />
                        </div>
                      </form>
                    </div>
                <br />
                  <table id="TableUser" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Имя и фамилия</th>
                        <th>Штрих-код</th>
                        <th>Вес</th>
                        <th>Цена</th>
                        <th>Статус</th>
                        <th>Дата заказа</th>
                        <th>Дата последнего обновления статуса</th>
                      </tr>
                    </thead>
                    <tbody>
                      {list}
                      <tr>
                        <td>{delivery_fullname}</td>
                        <td>{delivery_barcode}</td>
                        <td>{delivery_weight}</td>
                        <td>{delivery_price}</td>
                        <td>{status_text}</td>
                        <td>{delivery_create}</td>
                        <td>{delivery_update}</td>
                      </tr>
                      {/list}
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Итого: {total_weight}</td>
                        <td>Итого: {total_price}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
	<script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
	 <script>
      $(function () {
        $('#TableUser').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
      });

      function searchForm()
      {
        var b;
        $("#date2").css("border-color", "");
        $("#date1").css("border-color", "");

        if($("#date1").val().length==0)
        {
          $("#date1").css("border-color", "red");
          b = false;
        }

        if($("#date2").val().length==0)
        {
          
          $("#date2").css("border-color", "red");
          b = false;
          
        }

        return b;
      }
    </script>
