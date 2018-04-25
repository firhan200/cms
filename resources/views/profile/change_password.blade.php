@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-lg-4 offset-md-2 offset-lg-4 form-box">
			<div class="title">{{ $title }}</div>
            <form action="{{ url('profile/changePasswordProcess') }}" class="change-password-form disable-form-unconfirm" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>* Old Password</label>
                    <input type="password" name="old_password" class="form-control" placeholder="old password" required>
                </div>
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
                <div class="form-group" align="right">
                    <a href="{{ url('/profile') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Abort</a>
                    <button type="submit" class="btn btn-info btn-default btn-submit" disabled="disabled"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
	</div>
</div>
@endsection