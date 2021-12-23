<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{ url('admin-template/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/dist/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin-template/dist/css/style.css') }}">
    <title>Вход в административную панель</title>
  </head>
  <body>
  <div class="d-md-flex half">
      <div class="contents">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-12">
              <div class="form-block mx-auto">
                <form action="{{ route('admin.check') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group first">
                    <label for="username">Логин</label>
                    <input type="text" class="form-control" placeholder="Ваш логин" id="login">
                  </div>
                  <div class="form-group last mb-3">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" placeholder="Ваш пароль" id="password">
                  </div>
                  <div class="d-sm-flex mb-5 align-items-center">
                    <span class="ml-auto"><a href="#" class="forgot-pass">Забыл пароль</a></span> 
                  </div>
                  <input type="submit" value="Войти" class="btn btn-block btn-secondary">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>