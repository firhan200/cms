<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login | CMS</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
	</head>

	<body class="bg-login">
		<div class="container-fluid pad">
			<div class="row">
				<div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4 form-box">
					<div class="form-title">
						CMS
					</div>
					@if (Session::has('message'))
					   {!! Session::get('message') !!}
					@endif
					<form action="{{ url('/admin/login') }}" method="post">
						{{ csrf_field() }}

						<div class="form-group has-icon">
							<div class="icon-container" align="center">
								<i class="fa fa-user-circle"></i>
							</div>
							<input value="firhan.faisal1995@gmail.com" type="email" name="email" class="form-control" placeholder="username / email" maxlength="200" required/>
						</div>
						<div class="form-group has-icon">
							<div class="icon-container" align="center">
								<i class="fa fa-lock"></i>
							</div>						
							<input value="123456" type="password" name="password" class="form-control" placeholder="password" maxlength="20" required/>
						</div>
						<div class="form-group">
							<div class="row pad-row">
								<div class="col">
									<input type="checkbox" name="remember_me">
									remember me
								</div>
								<div class="col" align="right">
									<a href="#">Forgot Password?!</a>
								</div>
							</div>							
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-login">Login</button>
						</div>
					</form>
					<div class="form-footer">
						version 1.0
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		</script>
	</body>
</html>