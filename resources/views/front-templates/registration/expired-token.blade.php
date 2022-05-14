@extends('layouts.front-layouts.app')
@section('title', 'Срок действия токена истек')
@section('content')
<section id="form">
  <div class="container">
	<div class="row">
      <div class="col-sm-12">
	    @include('front-templates.info-messages')
	  </div>
	  <div class="col-sm-12 center-align">
        <p>Регистрация не удалась! Срок действия токена истек. Для повторной отправки письма введите email, который Вы указывали 
        при регистрации. Обращаем Ваше внимание на то, что срок действия ссылки в письме составляет 24 часа.</p>
	    <div class="col-sm-8 col-sm-offset-2">
		  <div class="login-form">
		    <form action="{{ route('front.register.resending') }}" method="POST">
              {{ csrf_field() }}
              <div class="col-sm-9">
		        <input type="text" class="form-control" name="email" class="email_login" placeholder="Email" required>
              </div>
              <div class="col-sm-3">
			    <button type="submit" class="btn btn-success">Отправить письмо</button>
              </div>
		    </form>
		  </div>
	    </div>
	  </div>
    </div>
  </div>
</section>
@endsection