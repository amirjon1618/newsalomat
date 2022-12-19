<!-- Content Header (Page header) -->
	<link rel="stylesheet" href="{base_url}css/jquery-ui.css">
    <link rel="stylesheet" href="{base_url}plugins/iCheck/all.css">   
     <section class="content-header">
          <h1>
           <br />
          </h1>
          <ol class="breadcrumb">
            <li><a href="{base_url}"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Изменить</li>
          </ol>
        </section>
         {alert}
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Изменить</h3>
                </div><!-- /.box-header -->                
                <div class="box-body pad">
                  <form action="" method="post" onsubmit="return tryReg();" role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Логин(Номер телефона):</label>
                      <input value="{login}" readonly="readonly" type="text" maxlength="10" class="form-control" name="login" id="login">
                    </div>
                    <div class="form-group">
                      <label>Имя:</label>
                      <input value="{name}" type="text" maxlength="40" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                      <label>Тип Аккаунта:</label>
                      <select name="access" id="access" class="form-control">
                        <option value="60">Сотрудник</option>
                        <option value="100">Администратор</option>
                      </select>
                    </div>
                    <hr />
                    <div class="form-group">
                      <label>Новый пароль:</label>
                      <input type="text" class="form-control" name="npassword1" id="npassword1">
                    </div>
                    <div class="box-footer">
                      <button type="button" onclick="javascript:window.location.href='{base_url}index.php/Admin/Admins'" class="btn btn-default">Отмена</button>
                      <input type="submit" name="AddBtn" value="Сохранить" class="btn btn-primary pull-right" />
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
	    <script src="{base_url}plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="{base_url}plugins/datatables/dataTables.bootstrap.min.js"></script>
      <script src="{base_url}plugins/iCheck/icheck.min.js"></script>
      <script src="{base_url}js/jquery-ui.js"></script>
      <script>
     
      function tryReg()
      {
        $("#access").css('border-color','');
		    $("#name").css('border-color','');

        var b = true;
		
		    if($("#access").val()==null)
        {
            $("#access").css('border-color','red');
            $("#access").focus();
            b=false;
        }

		    if($("#name").val().length==0)
        {
            $("#name").css('border-color','red');
            $("#name").focus();
            b=false;
        }
                
        return b;
      }
      </script>