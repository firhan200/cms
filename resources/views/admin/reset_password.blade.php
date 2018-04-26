@extends('../layouts/admin_default')

@section('title', 'Reset Password')

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
			<form action="{{ url('/admin/resetPasswordProcess') }}" method="post" class="form-with-check-passsword">
				{{ csrf_field() }}	
				<input type="hidden" name="resetPasswordToken" value="{{ $resetPasswordToken }}">
				<div class="form-group">
                    <label>* Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="password" maxlength="20" minlength="6" required>
                    <div class="password-error"></div>
                </div>
                <div class="form-group">
                    <label>* Repeat Password</label>
                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" placeholder="repeat password" maxlength="20" required>
                    <div class="repeat-password-error"></div>
                </div>		
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<a href="{{ url('admin/') }}"><button type="button" class="btn btn-warning btn-login">Go To Login</button></a>
						</div>
						<div class="col-sm-6">
							<button type="submit" class="btn btn-info btn-submit btn-login" disabled="disabled">Reset</button>
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