<header id="header">
@include('layouts.front-layouts.header-top')
  <div class="header-middle">
    <div class="container">
	  <div class="row">
	    <div class="col-md-4 clearfix">
	      <div class="logo pull-left">
			<a href="{{ route('front.index') }}">
			  @if(get_setting('store_logo') !== '' && get_setting('store_logo') !== null)
			    <img src="{{ asset(get_setting('store_logo')) }}" title="{{ get_setting('store_title') }}">
			  @else
			    <img src="{{ asset('storage/images/default-images/default-store.jpg') }}" title="{{ get_setting('store_title') }}">
			  @endif
			</a>
		  </div>
		  <div class="btn-group pull-right clearfix margin-button-header">
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
				USA
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a href="">Canada</a></li>
				<li><a href="">UK</a></li>
			  </ul>
			</div>
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
				DOLLAR
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a href="">Canadian Dollar</a></li>
				<li><a href="">Pound</a></li>
			  </ul>
			</div>
		  </div>
		</div>
		<div class="col-md-8 clearfix">
		  <div class="shop-menu clearfix pull-right header-phones">
			<ul class="nav navbar-nav">
			  @if(count(show_store_phones('store_phone')) > 0)
			    @foreach(show_store_phones('store_phone') as $phone)
				  <li><span><a href="tel:{{ $phone }}">{{ $phone }}</a></span></li>
				@endforeach
			  @endif
			  <li><a href="#" data-toggle="modal" data-target="#flipFlop"><i class="fa fa-phone"></i> Перезвонить вам?</a></li>
			</ul>
		  </div>
		  <!-- Modal start -->
		  <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		    <div class="modal-dialog" role="document">
			  <div class="modal-content">
			    <div class="modal-header" style="border-bottom: 0px solid white;">
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
		        <div class="modal-body">
				  <div class="col-md-12" style="padding-bottom: 10px;">
				    Укажите ваш номер телефона и имя. Мы свяжемся с вами в ближайшее время.
				  </div>
				  <div style="padding:10px 35px 10px 35px;">
					<form method="POST" action="{{ route('front.callback.store') }}">
					  {{ csrf_field() }}
					  <div class="form-group" id="name-input">
					    <input style="margin-bottom: 10px;" type="text" name="name" class="form-control customer-name" placeholder="Имя" required>
			            <div id="name-error"></div>
                      </div>
					  <div class="form-group" id="phone-input">
					    <input style="margin-bottom: 10px;" type="text" name="phone" id="phone-callback" class="form-control customer-phone" placeholder="Телефон" required>
					    <div id="phone-error"></div>
					  </div>
					  <button type="submit" class="btn btn-success" id="send-callback">Отправить</button>
					</form>
				  </div>
		        </div>
		      </div>
		    </div>
		  </div>
          <!-- Modal end -->
		</div>
	  </div>
	</div>
  </div>
  <div class="header-bottom">
	<div class="container">
      <div class="row">
		<div class="col-sm-9">
	      <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
		  </div>
		  <div class="mainmenu pull-left">
		    @if(isset($pages))
			  <ul class="nav navbar-nav collapse navbar-collapse">
			    @foreach($pages as $key => $value)
			      <li><a href="{{ route('front.pages.show', $key) }}">{{ $value }}</a></li>
			    @endforeach
			  </ul>
			@endif
		  </div>
		</div>
		<br>
		@include('front-templates.info-messages')
	  </div>
	</div>
  </div>
</header>