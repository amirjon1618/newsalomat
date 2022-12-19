<style>
.hidden
{
  display: none;
}
</style>
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
                        <div class="col-xs-4">
                          <input type="text" name="delivery_barcode" placeholder="delivery_barcode" value="<?=$this->input->get("delivery_barcode")?>" class="form-control">
                        </div>
                        <div class="col-xs-2">
                          <input placeholder="от" type="date" value="<?=$this->input->get("date1")?>" name="date1" id="date1" class="form-control" />
                        </div>
                        <div class="col-xs-2">
                          <input placeholder="до" type="date" value="<?=$this->input->get("date2")?>" name="date2" id="date2" class="form-control" />
                        </div>
                        <div class="col-xs-1">
                          <input type="submit" name="q" value="search" class="btn btn-default pull-right" />
                        </div>
                      </form>
                    </div>
                <br />
                  <table id="TableUser" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Имя и фамилия</th>
                        <th>Штрих-код</th>
                        <th>Статус</th>
                        <th>Дата заказа</th>
                        <th style="text-align: center;">Изменить</th>
                        <th style="text-align: center;">Обработать</th>
                        <th style="text-align: center;">Удалить</th>
                      </tr>
                    </thead>
                    <tbody>
                      {list}
                      <tr>
                        <td>{delivery_id}</td>
                        <td>{delivery_fullname}</td>
                        <td>{delivery_barcode}</td>
                        <td>{status_text}</td>
                        <td>{delivery_create}</td>
                        <td style="text-align: center;width: 100px;"><a class="{edit_deny}" href="{base_url}index.php/Admin/editDelivery/{delivery_id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                        <td style="text-align: center;width: 100px;"><a class="{status_deny}" href="{base_url}index.php/Admin/statusDelivery/{delivery_id}"><i style="font-size: 24px;" class="fa fa-check-square-o"> </i></a></td>
                        <td style="text-align: center;width: 100px;"><?php if($this->user->myData['access'] == 100) { ?>  <a class="confirmation" href="{base_url}index.php/Admin/deliverys?do=remove&delivery_id={delivery_id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a><?php } ?></td>
                      </tr>
                      {/list}
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

        if($("#date1").val().length>0)
        {
          if($("#date2").val() == "")
          {
            $("#date2").css("border-color", "red");
            b = false;
          }
        }

        if($("#date2").val().length>0)
        {
          if($("#date1").val() == "")
          {
            $("#date1").css("border-color", "red");
            b = false;
          }
        }

        return b;
      }
    </script>
