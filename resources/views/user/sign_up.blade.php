@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
    <div class="row">
		<div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 form-box">
			<div class="title">Sign up</div>
			<form action="{{ url('/signUpProcess') }}" method="post" class="disable-form-unconfirm sign-up-form">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" placeholder="name" maxlength="100" required/>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email" name="email" class="form-control" placeholder="email" maxlength="200" autocomplete="off" required/>
							<div class="email-feedback feedback"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Password</label>					
							<input id="password" type="password" name="password" class="form-control" placeholder="password" maxlength="20" required/>
							<div class="password-error feedback"></div>
						</div>
						<div class="form-group">
							<label>Repeat Password</label>					
							<input id="repeat_password" type="password" name="repeat_password" class="form-control" placeholder="repeat password" maxlength="20" required/>
							<div class="repeat-password-error feedback"></div>
						</div>
					</div>
				</div>							
				<div class="form-group-btn" align="right">
					<button type="submit" class="btn btn-info btn-default btn-submit" disabled="disabled">Sign up</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
