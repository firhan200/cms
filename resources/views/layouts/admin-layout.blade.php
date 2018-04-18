<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title') | CMS</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
	</head>

	<body>
		<div class="sidenav">
			<ul class="menu">
				<a href="{{ url('/admin/home') }}" class="@yield('home')"><li><i class="fa fa-home"></i> Home</li></a>
				<a href="{{ url('/admin/user') }}" class="@yield('user')"><li><i class="fa fa-users"></i> Users</li></a>
				<a href="{{ url('/admin/setting') }}" class="@yield('setting')"><li><i class="fa fa-cogs"></i> Setting</li></a>
			</ul>
		</div>

		<div class="main">
			<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
			  	<a class="navbar-brand" href="#">CMS</a>
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    		<span class="navbar-toggler-icon"></span>
			  		</button>

			  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			    	<ul class="navbar-nav ml-auto">
			      		<li class="nav-item dropdown">
			        		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          			<i class="fa fa-bell"></i></a>
			        		</a>
			        		<div class="dropdown-menu dropdown-menu-right dropdown-notifications" aria-labelledby="navbarDropdown">
			          			<a class="dropdown-item" href="#"><i class="fa fa-plus-circle"></i> <b>4</b> new user sign up</a>
			          			<div class="dropdown-divider"></div>
			          			<a class="dropdown-item" href="#"><i class="fa fa-plus-circle"></i> <b>4</b> new feedback</a>		
			        		</div>
			      		</li>
			      		<li class="nav-item dropdown">
			        		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          			<i class="fa fa-user-circle"></i> @yield('admin-name')
			        		</a>
			        		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			          			<a class="dropdown-item" href="{{ url('/admin/profile') }}">Profile</a>
			          			<a class="dropdown-item" href="{{ url('/admin/changePassword') }}">Change Password</a>
			          			<div class="dropdown-divider"></div>
			          			<a class="dropdown-item confirm-modal" data-toggle="modal" data-target="#confirmModal" data-url="{{ url('admin/logout') }}" data-content="Logout from system?" href="#"><i class="fa fa-sign-out"></i> Logout</a>
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
		<script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
			
		@yield('additional-script')
		</script>
	</body>
</html>