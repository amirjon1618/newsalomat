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
                <br />
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
                  <nav aria-label="">
                    <ul class="pagination">
                    {pages}
                      <li class="{current}"><a href="{link}?page={page}">{page} <span class="sr-only"></span></a></li>
                    {/pages}
                    </ul>
                  </nav>
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
    </script>
