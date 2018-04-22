<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title') | CMS</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/preloader.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/admin-main.css') }}">
	</head>

	<body>
		<div class="preloader-wrapper">
		    <div class="preloader" align="center">
		    	Loading...<br/>
		        <i class="fa fa-spinner loading"></i>
		    </div>
		</div>
		<div class="sidenav sidenav-large">			
			<ul class="menu">
				<a href="{{ url('/admin/home') }}" class="@yield('home')" title="Home"><li><i class="fa fa-home"></i> Home</li></a>
				<a href="{{ url('/admin/article') }}" class="@yield('article')" title="Articles"><li><i class="fa fa-newspaper-o"></i> Articles</li></a>
				<a href="{{ url('/admin/user') }}" class="@yield('user')" title="Users"><li><i class="fa fa-users"></i> Users</li></a>
				<a href="{{ url('/admin/contact_us') }}" class="@yield('contact_us')" title="Contact Us"><li><i class="fa fa-envelope"></i> Contact Us</li></a>
				<a href="{{ url('/admin/setting') }}" class="@yield('setting')" title="Settings"><li><i class="fa fa-cogs"></i> Setting</li></a>
			</ul>
		</div>

		<div class="main main-large">
			<nav class="navbar navbar-expand fixed-top navbar-expand-lg navbar-light bg-light">
			  	<a class="navbar-brand" href="#">CMS</a>
			  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    		<span class="navbar-toggler-icon"></span>
			  		</button>

			  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			    	<ul class="navbar-nav ml-auto">
			    		<li class="nav-item"><a href="#" class="nav-link toggle-sidebar"><i class="fa fa-chevron-left"></i></a></li>
			      		<li class="nav-item dropdown">
			        		<a class="nav-link dropdown-toggle notification-head" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          			<i class="fa fa-bell notifications-bell"></i> <span style="display:none" class="badge notifications-count">0</span><span class="fa fa-spinner loading"></span></a>
			        		</a>
			        		<div class="dropdown-menu dropdown-menu-right dropdown-notifications" aria-labelledby="navbarDropdown">
			          			<a class="dropdown-item notification-content-loading" style="display:none" href="#"><center><i class="fa fa-spinner loading"></i></center></a>
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
				@if (Session::has('message'))            
					<div class="row">
						<div class="col-md-12">{!! Session::get('message') !!}</div>
					</div>	
				@endif		
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
		<script src="{{ asset('js/preloader.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
		<script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('js/config.js') }}"></script>
		<script src="{{ asset('js/admin-main.js') }}"></script>
			
		@yield('additional-script')
		</script>
	</body>
</html>