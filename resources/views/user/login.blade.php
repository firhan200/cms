@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4 form-box">
			<div class="title">Login</div>
			<form action="{{ url('/loginProcess') }}" method="post" class="disable-form-unconfirm">
				{{ csrf_field() }}

				<div class="form-group has-icon">
					<div class="icon-container" align="center">
						<i class="fa fa-envelope"></i>
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
					<button type="submit" class="btn btn-info full btn-default btn-submit">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
