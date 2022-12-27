<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br />
    </h1>
    <ol class="breadcrumb">
        <li><a href="{base_url}index.php/admin"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Промокод</li>
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
                    <h3 class="box-title">СПИСОК РАССЫЛОК</h3>
                    <a href="{base_url}index.php/admin/addNotification" class="add_btns add_btns_color btn btn-primary">
                        <i class="fa fa-plus"></i> Добавить рассылку
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <br />
                    <br />
                    <table id="TableUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название рассылки</th>
                                <th>Текст сообщения</th>
                                <th>Фото для рассылки</th>
                                <th style="text-align: center;">Отправить</th>
                                <th style="text-align: center;">Изменить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            {list}
                            <tr>
                                <td>{id}</td>
                                <td>{name}</td>
                                <td>{description}</td>
                                <td style="text-align: center;width: 400px;"><a target="_blank" href="{base_url}img/icons/{img}"><img src="{base_url}img/icons/{img}" style="width: 400px;" /></a></td>

                                <td style="text-align: center;width: 100px;">
                                    <a  onclick="sendNotification({id})">
                                        <i style="font-size: 24px;" class="fa fa-paper-plane"> </i>
                                    </a>
                                </td>
                                <td style="text-align: center;width: 100px;">
                                    <a  href="{base_url}index.php/admin/editNotification/{id}">
                                        <i style="font-size: 24px;" class="fa fa-edit"> </i>
                                    </a>
                                </td>
                                <td style="text-align: center;width: 96px;">
                                 <a class="confirmation" href="{base_url}index.php/admin/notification?do=remove&id={id}"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i>
                                </a></td>

                            </tr>
                            {/list}
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->
<script>
    function sendNotification(id) {
        $.post('<?= $base_url ?>index.php/PushNotification/sendPushNotification/' + id , res => {
            console.log(res)
        })
    }
</script>
