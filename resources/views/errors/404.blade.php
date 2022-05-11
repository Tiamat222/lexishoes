@extends('layouts.front-layouts.app')
@section('content')
<section>
  <div class="container">
	  <div class="row">
	    <div class="col-sm-12 center-align">
          <p class="page-404">404</p>
          <p>Страница не найдена. Перейти на <a href="{{ route('front.index') }}">главную</a></p>
	    </div>
    </div>
  </div>
</section>
@endsection