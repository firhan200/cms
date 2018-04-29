@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
    <div class="row">
		<div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 form-box">
			<form action="{{ url('/signUpProcess') }}" method="post" class="disable-form-unconfirm sign-up-form">
				{{ csrf_field() }}
				<!-- Heading -->
              	<h3 class="dark-grey-text text-center">
                	<strong>SIGN UP</strong>
              	</h3>
              	<hr>
              	<div class="md-form">
                	<i class="fa fa-user prefix grey-text"></i>
                    <input type="text" name="name" class="form-control" maxlength="100" required/>
                    <label for="form2">Name</label>
              	</div>
              	<div class="md-form">
                	<i class="fa fa-envelope prefix grey-text"></i>
                    <input type="email" id="email" name="email" class="form-control" maxlength="200" autocomplete="off" required/>
							<div class="email-feedback feedback"></div>
                    <label for="form2">E-mail</label>
              	</div>
              	<div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input id="password" type="password" name="password" class="form-control" maxlength="20" required/>
							<div class="password-error feedback"></div>
                    <label for="form8">Password</label>
              	</div>
              	<div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input id="repeat_password" type="password" name="repeat_password" class="form-control" maxlength="20" required/>
							<div class="repeat-password-error feedback"></div>
                    <label for="form8">Repeat-Password</label>
              	</div>

              	<div class="text-center">
                    <button class="btn btn-default btn-submit" disabled="disabled">Login</button>
                    <hr>
                    Already have account?
            		<a href="{{ url('/login') }}">
                      	Log in now!
                  	</a>
              	</div>
			</form>
		</div>
	</div>
</div>
@endsection
