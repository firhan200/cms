@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-lg-4 offset-md-2 offset-lg-4 form-box">
            <form action="{{ url('profile/changePasswordProcess') }}" method="post" class="change-password-form disable-form-unconfirm">
                {{ csrf_field() }}
                <!-- Heading -->
                <h3 class="dark-grey-text text-center">
                    <strong>{{ $title }}</strong>
                </h3>
                <hr>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" name="old_password" class="form-control"required>
                    <label for="form8">Old Password</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" id="password" name="password" class="form-control" maxlength="20" minlength="6" required>
                    <div class="password-error"></div>
                    <label for="form8">Password</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" maxlength="20" required>
                    <div class="repeat-password-error"></div>
                    <label for="form8">Repeat Password</label>
                </div>

                <div class="text-center">
                    <button class="btn btn-default btn-submit" disabled="disabled">Submit</button>
                    <hr>
                    <a href="{{ url('/profile') }}">
                        Back to profile
                    </a>
                </div>
            </form>       
        </div>
	</div>
</div>
@endsection