<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <br />
          </h1>
          <ol class="breadcrumb">
            <li><a href="{base_url}"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Новости</li>
          </ol>
        </section>
         {alert}
        <!-- Main content -->
        <section class="content">
         <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Новости</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="TableUser" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 70px;">#</th>
                        <th>Название</th>
                        <th>Ссылка</th>
						            <th style="text-align: center;">Редактировать</th>
                        <th style="text-align: center;">Удалить</th>
                      </tr>
                    </thead>
                    <tbody>
                    {newsList}
                      <tr>
                        <td>{id}</td>
                        <td>{static_name}</td>
                        <td><input style="width: 100%" type="text" value="{base_url}index.php/main/page/{alias}" /></td>
						            <td style="text-align: center;width: 100px;"><a href="{base_url}index.php/admin/editArticle/{id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a> </td>
                        <td style="text-align: center;width: 100px;"><a class="confirmation" href="{base_url}index.php/admin/articles?do=remove&id={id}"><i style="font-size: 24px;color: red;" class="fa fa-remove"> </i></a></td>
                      </tr>
                      {/newsList}
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="width: 70px;">#</th>
                        <th>Название</th>
                        <th>Ссылка</th>
					            	<th style="text-align: center;">Редактировать</th>
                        <th style="text-align: center;">Удалить</th>
                      </tr>
                    </tfoot>
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
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });
      </script>