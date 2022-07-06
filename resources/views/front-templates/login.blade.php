@extends('layouts.front-layouts.app')
@section('content')
<section id="form">
  <div class="container">
	<div class="row">
	  <div class="col-sm-4 col-sm-offset-1">
		<div class="login-form">
		  <h2>Вход в аккаунт</h2>
		  <form action="{{ route('front.login.check') }}" method="POST">
			{{ csrf_field() }}
		    <input type="text" name="email" class="form-control" placeholder="Email" required>
            <div class="password-left">
			  <input type="password" class="password-login form-control" name="password" placeholder="Пароль" required>
			</div>
            <div class="password-right">
			  <i class="fa fa-eye-slash" data-class="password-login" aria-hidden="true" style="font-size: 20px;"></i>
			</div>
			<a href="{{ route('front.password.forgot_form') }}">Забыл(а) пароль</a>
			<button type="submit" class="btn btn-success margin-button">Войти</button>
		  </form>
		</div>
	  </div>
	  <div class="col-sm-4">
		<div class="signup-form">
		  <h2>Регистрация</h2>
		  <form action="{{ route('front.register.new_customer') }}" method="POST">
            {{ csrf_field() }}
			<input type="text" name="first_name" class="form-control" placeholder="Имя" required>
			<input type="text" name="last_name" class="form-control" placeholder="Фамилия" required>
		    <input type="text" name="email" class="form-control" placeholder="Email" required>
			<input type="text" name="phone" class="form-control" id="phone" placeholder="Телефон" required>
            <div class="password-left">
			  <input type="password" class="password-register form-control" name="password" placeholder="Пароль" require>
			</div>
            <div class="password-right">
			  <i class="fa fa-eye-slash" data-class="password-register" aria-hidden="true" style="font-size: 20px;"></i>
			</div>
            <button type="submit" class="btn btn-success margin-button">Зарегистрироваться</button>
		  </form>
		</div>
	  </div>
    </div>
  </div>
</section>
@push('auth')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ url('admin-template/dist/js/input-mask.js') }}"></script>
<script src="{{ url('front-template/dist/js/pages/auth.js') }}"></script>
<script> 
  $(document).ready(function(){   
    $('#phone').inputmask("+38(999) 999-99-99");
  });
</script>
@endpush
@endsection