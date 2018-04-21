<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/preloader.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	</head>

	<body>
		<div class="preloader-wrapper">
		    <div class="preloader" align="center">
		    	Loading...<br/>
		        <i class="fa fa-spinner loading"></i>
		    </div>
		</div>
		<div class="main">
			<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
			  	<a class="navbar-brand" href="#">Brand</a>
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    		<span class="navbar-toggler-icon"></span>
			  		</button>

			  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			    	<ul class="navbar-nav ml-auto">
			      		<li class="nav-item @yield('home')"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
			      		<li class="nav-item @yield('about')"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
			      		<li class="nav-item @yield('contact-us')"><a href="{{ url('/contact-us') }}" class="nav-link">Contact us</a></li>
			      		<li class="nav-item dropdown @yield('login')">
			        		<a class="nav-link dropdown-toggle login-form-trigger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          			Login
			        		</a>
			        		<div class="dropdown-menu dropdown-menu-right dropdown-login" aria-labelledby="navbarDropdown">
			          			<form class="form-login" action="#!" method="post">
			          				<div class="form-group has-icon">
			          					<div class="icon-container" align="center">
			          						<i class="fa fa-envelope"></i>
			          					</div>
			          					<input type="text" class="form-control" id="email" placeholder="email">
			          				</div>
			          				<div class="form-group has-icon">
			          					<div class="icon-container" align="center">
			          						<i class="fa fa-lock"></i>
			          					</div>
			          					<input type="password" class="form-control" id="password" placeholder="password">
			          				</div>
			          				<div class="form-group">
			          					<button type="submit" class="btn btn-info btn-login">Login</button>
			          					<a href="url('/sign-up')"><button type="button" class="btn btn-danger btn-login">Sign up</button></a>
			          				</div>
			          			</form>
			        		</div>
			      		</li>
			    	</ul>
			  	</div>
			</nav>
			<div class="container">
				@yield('body')
			</div>
		</div>

		<!-- Logout Modal -->
		<div class="modal fade" id="confirmModal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title"><i class="fa fa-info-circle"></i> Confirmation</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body" id="confirm-content">
		      </div>
		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Abort</button>
		        <a href="#" id="confirm-url" class="btn btn-success">Yes</a>
		      </div>

		    </div>
		  </div>
		</div>

		<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/preloader.js') }}"></script>
		<script src="{{ asset('js/config.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
			
		@yield('additional-script')
		</script>
	</body>
</html>