@extends('../layouts/admin_default')

@section('default_body')
	<div class="sidenav sidenav-large">			
		<ul class="menu">
			<a href="{{ url('/admin/home') }}" class="@yield('home')" title="Home"><li><i class="fa fa-dashboard"></i> Dashboard</li></a>
			<a href="{{ url('/admin/article') }}" class="@yield('article')" title="Articles"><li><i class="fa fa-newspaper-o"></i> Articles</li></a>
			<a href="{{ url('/admin/user') }}" class="@yield('user')" title="Users"><li><i class="fa fa-users"></i> Users</li></a>
			<a href="{{ url('/admin/message') }}" class="@yield('message')" title="Messages"><li><i class="fa fa-envelope"></i> Messages</li></a>
			<a href="{{ url('/admin/contact_us') }}" class="@yield('contact_us')" title="Contact Us"><li><i class="fa fa-comments"></i> Contact Us</li></a>
			@if(Session::get('cms_admin_type')==1)
			<a href="{{ url('/admin/admin_account') }}" class="@yield('admin_account')" title="Admin account"><li><i class="fa fa-user-circle"></i> Admin</li></a>
			@endif
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
					<li class="nav-item dropdown messages-container">
		        		<a class="nav-link dropdown-toggle notification-head" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          			<i class="fa fa-envelope-open notifications-bell"></i> <span style="display:none" class="badge notifications-count">0</span><span class="fa fa-spinner loading"></span></a>
		        		</a>
		        		<div class="dropdown-menu dropdown-menu-right dropdown-notifications big-dropdown" aria-labelledby="navbarDropdown">
		          			<a class="dropdown-item notification-content-loading" style="display:none" href="#"><center><i class="fa fa-spinner loading"></i></center></a>
		        		</div>
		      		</li>
					<li class="nav-item dropdown notifications-container">
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
@endsection