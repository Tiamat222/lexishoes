<html>
  <head>
    <meta charset="utf-8">
    <title>Вход в админ-панель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('admin-template/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="login-page" style="min-height: 512.781px;">
    <div class="login-box">
      <div class="card">
        <div class="card-body login-card-body" style="border-radius: 15px;">
          <p class="login-box-msg">Вход в админ панель</p>
          @include('admin-templates.info-messages')
          <form action="{{ route('admin.check') }}" method="post">
            {{ csrf_field() }}
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Логин" name="login" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Пароль" name="password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <a href="{{ route('admin.forgot.get') }}">Забыл(а) пароль</a>
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
  <script src="{{ url('admin-template/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('admin-template/dist/js/adminlte.js') }}"></script>
  </body>
</html>