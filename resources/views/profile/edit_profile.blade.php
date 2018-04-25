@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 form-box">
			<div class="title">{{ $title }}</div>
            <form action="{{ url('profile/editProcess') }}" class="change-password-form disable-form-unconfirm" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name" readonly required>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="E-mail" readonly required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" id="phone_number" value="{{ $user->phone_number }}" name="phone_number" class="form-control" pattern="[0-9-]{1,50}" placeholder="Phone Number" maxlength="50">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea type="text" rows="5" id="address" name="address" class="form-control" placeholder="Adress" maxlength="300">{{ $user->address }}</textarea>
                </div>
                <div class="form-group" align="right">
                    <a href="{{ url('/profile') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Abort</a>
                    <button type="submit" class="btn btn-info btn-default btn-submit"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
	</div>
</div>
@endsection