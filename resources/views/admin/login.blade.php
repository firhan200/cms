@extends('../layouts/admin_default')

@section('title', 'Login')

@section('default_body')
@if (Session::has('message'))
   {!! Session::get('message') !!}
@endif
<div class="container-fluid pad">
    <div class="row">
		<div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4 form-box">
			<div class="form-title">
				CMS
			</div>		
			<form action="{{ url('/admin/login') }}" method="post">
				{{ csrf_field() }}

				<div class="form-group has-icon">
					<div class="icon-container" align="center">
						<i class="fa fa-user-circle"></i>
					</div>
					<input value="firhan.faisal1995@gmail.com" type="email" name="email" class="form-control" placeholder="email" maxlength="200" required/>
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
							<a href="{{ url('/admin/forgotPassword') }}">Forgot Password?!</a>
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
@endsection