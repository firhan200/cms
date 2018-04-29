<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/mdb.min.css') }}">
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
		<!--Main Navigation-->
	    <header>
	        <!-- Navbar -->
	        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
	            <div class="container">
	                <!-- Brand -->
	                <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/material-design-for-bootstrap/" target="_blank">
	                    <strong class="blue-text">CMS</strong>
	                </a>
	                <!-- Collapse -->
	                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
	                    aria-expanded="false" aria-label="Toggle navigation">
	                    <span class="navbar-toggler-icon"></span>
	                </button>
	                <!-- Links -->
	                <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                    <!-- Left -->
	                    <ul class="navbar-nav mr-auto">
	                        <li class="nav-item @yield('home')">
	                            <a class="nav-link waves-effect" href="{{ url('/') }}">Home
	                                <span class="sr-only">(current)</span>
	                            </a>
	                        </li>
	                        <li class="nav-item @yield('article')">
	                            <a class="nav-link waves-effect" href="{{ url('/articles') }}">Articles</a>
	                        </li>
	                        <li class="nav-item @yield('contact-us')">
	                            <a class="nav-link waves-effect" href="{{ url('/contact-us') }}">Contact Us</a>
	                        </li>
	                    </ul>
	                    <!-- Right -->
	                    <ul class="navbar-nav nav-flex-icons">
	                    	@if(Session::has('user_id'))
	                        <li class="nav-item dropdown">
				                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					                <i class="fa fa-user-circle mr-2"></i> {{ Session::get('user_name') }}
					            </a>
				                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
				                    <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
				                    <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
				                </div>
				            </li>
	                        @else
				      		<li class="nav-item @yield('login')">
	                            <a class="nav-link waves-effect" href="{{ url('/login') }}">Login</a>
	                        </li>
				      		@endif
	                    </ul>
	                </div>
	            </div>
	        </nav>
	        <!-- Navbar -->
	    </header>
	    <!--Main Navigation-->

	    <!--Main layout-->
	    <main class="mt-5 pt-5">
	        <div class="container">
				@if (Session::has('message'))
				   {!! Session::get('message') !!}
				@endif
				@yield('body')
			</div>
		</main>
		<div class="footer">
			tes
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
		<script src="{{ asset('js/mdb.min.js') }}"></script>
		<script src="{{ asset('js/moment.js') }}"></script>
		<script src="{{ asset('js/config.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
			
		@yield('additional-script')
		</script>
	</body>
</html>