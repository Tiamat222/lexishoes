<header id="header">
@include('layouts.front-layouts.header-top')
  <div class="header-middle">
    <div class="container">
	  <div class="row">
		<div class="col-md-4 clearfix">
	      <div class="logo pull-left">
			<a href="index.html"><img src="{{ url('front-template/dist/images/home/logo.png') }}" alt="" /></a>
		  </div>
		  <div class="btn-group pull-right clearfix">
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
		  <div class="shop-menu clearfix pull-right">
			<ul class="nav navbar-nav">
		      <li><a href=""><i class="fa fa-user"></i> Account</a></li>
			  <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
			  <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
			  <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
			  <li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
			</ul>
		  </div>
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
	  </div>
	</div>
  </div>
</header>