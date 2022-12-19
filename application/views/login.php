<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Panel | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{base_url}css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{base_url}css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{base_url}css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{base_url}css/AdminLTE.min.css">

  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="{base_url}"><b>Login Panel</b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"><a href="{base_url}auth/register">Авторизируйтесь</a></p>
      {alert}
      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="login" class="form-control" placeholder="Login">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" minlength="8" maxlength="32" pattern="^[a-zA-Z0-9]+$" title="только английские буквы и цифры" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" name="EnterBtn" id="EnterBtn" value="EnterBtn" class="btn btn-primary btn-block btn-flat">Войти</button>
          </div><!-- /.col -->
        </div>
      </form>
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->
  <!-- jQuery 2.1.4 -->
  <script src="{base_url}plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="{base_url}js/bootstrap.min.js"></script>
  <script>
  </script>
</body>

</html>