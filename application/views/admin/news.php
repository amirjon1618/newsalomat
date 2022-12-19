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
                        <th>Дата</th>
						            <th style="text-align: center;">Редактировать</th>
                        <th style="text-align: center;">Удалить</th>
                      </tr>
                    </thead>
                    <tbody>
                    {newsList}
                      <tr>
                        <td>{id}</td>
                        <td>{news_title}</td>
                        <td>{news_date_str}</td>
						            <td style="text-align: center;width: 100px;"><a href="{base_url}admin/newsEdit/{id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a> </td>
                        <td style="text-align: center;width: 100px;"><a class="confirmation" href="{base_url}admin/news?do=remove&id={id}"><i style="font-size: 24px;color: red;" class="fa fa-remove"> </i></a></td>
                      </tr>
                      {/newsList}
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="width: 70px;">#</th>
                        <th>Название</th>
                        <th>Дата</th>
						            <th style="text-align: center;">Редактировать</th>
                        <th style="text-align: center;">Удалить</th>
                      </tr>
                    </tfoot>
                  </table>
                  <nav aria-label="Page navigation">
                      <ul class="pagination justify-content-center">
                      {paging}
                      <li style="display: none;" class="page-item {go_to_left_status}">
                          <a class="page-link" href="{base_url}admin/news/{go_to_left}" tabindex="-1"><i class="fa fa-chevron-left"></i></a>
                      </li>
                      {pags}
                      <li class="page-item {page_active}"><a class="page-link" href="{base_url}admin/news/{page_number}">{page_number}</a></li>
                      {/pags}
                      <li style="display: none;" class="page-item {go_to_right_status}">
                          <a class="page-link" href="{base_url}admin/news/{go_to_right}"><i class="fa fa-chevron-right"></i></a>
                      </li>
                      {/paging}
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
            "info": true,
            "autoWidth": false
          });
        });
      </script>