@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 form-box">
            <form action="{{ url('profile/editProcess') }}" method="post" class="disable-form-unconfirm change-password-form">
                {{ csrf_field() }}
                <!-- Heading -->
                <h3 class="dark-grey-text text-center">
                    <strong>{{ $title }}</strong>
                </h3>
                <div class="md-form">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" readonly required>
                    <label for="form8">Name</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" readonly required>
                    <label for="form8">E-mail</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-phone prefix grey-text"></i>
                    <input type="text" id="phone_number" value="{{ $user->phone_number }}" name="phone_number" class="form-control" pattern="[0-9-]{1,50}" maxlength="50">
                    <label for="form8">Phone Number</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <textarea type="text" rows="5" id="address" name="address" class="form-control md-textarea" maxlength="300">{{ $user->address }}</textarea>
                    <label for="form8">Address</label>
                </div>

                <div class="text-center">
                    <a href="{{ url('/profile') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Abort</a>
                    <button class="btn btn-default btn-submit"><i class="fa fa-save"></i> Save</button>
                </div>
            </form> 
        </div>
	</div>
</div>
@endsection