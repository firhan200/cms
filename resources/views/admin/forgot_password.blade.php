@extends('../layouts/admin_default')

@section('title', 'Forgot Password')

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
			Link to reset password will be sent to your email.
			<br/>
			<br/>
			<form action="{{ url('/admin/forgotPasswordProcess') }}" method="post" class="disable-form-unconfirm">
				{{ csrf_field() }}	
				<div class="form-group has-icon">
					<div class="icon-container" align="center">
						<i class="fa fa-envelope"></i>
					</div>
					<input value="firhan.faisal1995@gmail.com" type="email" name="email" class="form-control" placeholder="email" maxlength="200" required/>
				</div>			
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<a href="{{ url('admin/') }}"><button type="button" class="btn btn-warning btn-login">Back</button></a>
						</div>
						<div class="col-sm-6">
							<button type="submit" class="btn btn-submit btn-info btn-login">Send</button>
						</div>
					</div>		
				</div>
			</form>
			<div class="form-footer">
				version 1.0
			</div>
		</div>
	</div>
</div>
@endsection