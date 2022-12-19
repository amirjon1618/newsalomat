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
                            <th>Название</th>
                            <th style="text-align: center;">Изменить</th>
                            <th style="text-align: center;">Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        {list}
                        <tr>
                            <td>{id}</td>
                            <td>{country_name}</td>
                            <td style="text-align: center;width: 100px;"> <a class="" href="{base_url}index.php/Admin/editCountry/{id}"><i style="font-size: 24px;" class="fa fa-edit"> </i></a></td>
                            <td style="text-align: center;width: 96px;"> <a class="confirmation" href="{base_url}index.php/Admin/countries?do=remove&id={id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i></a></td>
                        </tr>
                        {/list}
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
