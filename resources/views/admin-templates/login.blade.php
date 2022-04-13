<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
<body class="login-page" style="min-height: 512.781px;">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Вход в админ панель</p>
      @include('admin-templates.info-messages')
      <form action="{{ route('admin.check') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Ваш логин" name="login">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Ваш пароль" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <a href="{{ route('admin.forget.get') }}">Забыл(а) пароль</a>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-block btn-secondary">Войти</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>