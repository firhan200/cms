<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title') | CMS</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/preloader.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/select2/select2.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/admin-main.css') }}">
	</head>

	<body>
		<div class="preloader-wrapper">
		    <div class="preloader" align="center">
		    	Loading...<br/>
		        <i class="fa fa-spinner loading"></i>
		    </div>
		</div>
		
		@yield('navigation')

		@yield('default_body')

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
		<script type="text/javascript" src="{{ asset('js/chartjs/Chart.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/select2/select2.min.js') }}"></script>
		<script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('js/config.js') }}"></script>
		<script src="{{ asset('js/admin-main.js') }}"></script>
			
		@yield('additional-script')
		</script>
	</body>
</html>