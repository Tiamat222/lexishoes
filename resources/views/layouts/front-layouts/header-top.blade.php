<div class="header_top">
  <div class="container">
	<div class="row">
	  <div class="col-sm-12">
	    <div class="col-xs-6 col-md-8">
		  <div class="search_box">
		    <form action="" method="GET">
			  <div class="row">
				<div class="col-md-10">
			      <div class="input-group">
					<input type="text" class="form-control" placeholder="Поиск..." id="txtSearch"/>
					<div class="input-group-btn">
					  <button class="btn btn-search" type="submit">
					    <span class="glyphicon glyphicon-search"></span>
					  </button>
					</div>
				  </div>
				</div>
			  </div>
			</form>
		  </div>
		</div>
		<div class="col-sm-4 links-right">
		  <div class="links">
			@if(check_auth_user('customers'))
			<a href="{{ route('front.login.logout_customer') }}"><i class="fa fa-sign-out" aria-hidden="true" title="Выйти"></i></a>
			@endif
			<a href="{{ (check_auth_user('customers')) ? route('front.customer.profile') : route('front.login.show_form') }}" title="Войти"><i class="fa fa-user"></i></a>
			<a href="cart.html"><i class="fa fa-shopping-cart"></i></a>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>