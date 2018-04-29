@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4 form-box">
			<form action="{{ url('/loginProcess') }}" method="post" class="disable-form-unconfirm">
				{{ csrf_field() }}
				<!-- Heading -->
              	<h3 class="dark-grey-text text-center">
                	<strong>LOGIN</strong>
              	</h3>
              	<hr>
              	<div class="md-form">
                	<i class="fa fa-envelope prefix grey-text"></i>
                    <input value="firhan.faisal1995@gmail.com" type="email" name="email" class="form-control" maxlength="200" required/>
                    <label for="form2">E-mail</label>
              	</div>
              	<div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input value="123456" type="password" name="password" class="form-control" maxlength="20" required/>
                    <label for="form8">Password</label>
              	</div>

              	<div class="text-center">
                    <button class="btn btn-default btn-submit">Login</button>
                    <hr>
                    Not already member? 
            		<a href="{{ url('/sign-up') }}">
                      	Sign up now!
                  	</a>
              	</div>
			</form>
		</div>
	</div>
</div>
@endsection
