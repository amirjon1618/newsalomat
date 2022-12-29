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

<!-- Button HTML (to Trigger Modal) -->
<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Success!</h5>
                </div>
                <div class="modal-body">
                    <p>Рассылка отправлено успешно.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button HTML (to Trigger Modal) -->

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
                                <th>Тип рассылки</th>
                                <th>Фото для рассылки</th>
                                <th style="text-align: center;">Отправить</th>
                                <th style="text-align: center;">Изменить</th>
                                <th style="text-align: center;">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $item): ?>
                            <tr>
                                <td style="text-align: center"><?= $item['id']?></td>
                                <td style="text-align: center"><?= $item['name']?></td>
                                <td style="text-align: center"><?= $item['description']?></td>
                                <td style="width: 200px; text-align: center;"><span class="label" style="background:
                                    <?php
                                    if ($item['type']=='holidays'){
                                        echo '#ffff00';
                                    }
                                    if ($item['type']=='promotions'){
                                        echo '#ff0000';
                                    }
                                    if ($item['type']=='events'){
                                        echo '#00bfff';
                                    }?>
                                ; border-radius:.5em"><?php
                                        if ($item['type']=='holidays'){
                                            echo 'Праздники';
                                        }
                                        if ($item['type']=='promotions'){
                                            echo 'Акции';
                                        }
                                        if ($item['type']=='events'){
                                            echo 'События';
                                        }?></span></td>
                                <td style="text-align: center;width: 400px;"><a target="_blank" href="<?= $base_url ?>img/icons/<?= $item['img']?>"><img src="{base_url}img/icons/<?= $item['img']?>" style="width: 400px;" /></a></td>

                                <td  style="text-align: center;width: 100px;">
                                    <a class="btn" onclick="sendNotification(<?= $item['id']?>)">
                                        <i style="font-size: 24px;" class="fa fa-paper-plane"> </i>
                                    </a>
                                </td>
                                <td  style="text-align: center;width: 100px;">
                                    <a  href="<?= $base_url ?>index.php/admin/editNotification/<?= $item['id']?>">
                                        <i style="font-size: 24px;" class="fa fa-edit"> </i>
                                    </a>
                                </td>
                                <td style="text-align: center;width: 96px;">
                                 <a class="confirmation" href="<?= $base_url ?>index.php/admin/notification?do=remove&id=<?= $item['id']?>"><i style="font-size: 24px;color:red;" class="fa fa-remove"> </i>
                                </a></td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->

<style>
    .bs-example{
        margin: 20px;
    }
</style>

<script>
    $(document).ready(function(){
        $(".btn").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>

<script>
    function sendNotification(id) {
        $.post('<?= $base_url ?>index.php/PushNotification/sendPushNotification/' + id , res => {
        })
    }

</script>
