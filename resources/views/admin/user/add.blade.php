@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">Add {{ $title }}</div>  

            @if (Session::has('message'))
               <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
        	<form action="{{ url('/admin/'.$objectName.'/addProcess') }}" method="post" class="disable-form form-with-check-passsword box">
                {{ csrf_field() }}   
                <div class="form-group">
                    <label>* Name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" maxlength="100" value="{{ $obj['name'] }}" required>
                </div>
                <div class="form-group unique-form">
                    <label>* E-mail</label>
                    <input type="email" id="email" name="email" class="form-control unique-validation" data-entity="users" data-field="email" placeholder="email" maxlength="200" value="{{ $obj['email'] }}" required>
                    <div class="unique-feedback"></div>
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
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" value="{{ $obj['address'] }}" name="address" class="form-control" placeholder="address" maxlength="200">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="{{ $obj['phone_number'] }}" name="phone_number" class="form-control" placeholder="Phone Number" maxlength="50">
                </div>
                <div class="form-group">
                    <label>Is Active</label>
                    &nbsp;
                    <input type="checkbox" name="is_active" checked>
                </div>
                <br/>
                <div class="form-group" align="right">
                    <a href="{{ url('/admin/'.$objectName) }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-send"></i> Post</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
