@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">Add {{ $title }}</div>  

        	<form action="{{ url('/admin/'.$objectName.'/addProcess') }}" method="post" class="disable-form form-with-check-passsword box">
                {{ csrf_field() }}   
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" maxlength="150" value="{{ $obj['name'] }}" required>
                </div>
                <div class="form-group unique-form">
                    <label>E-mail</label>
                    <input type="text" name="email" value="{{ $obj['email'] }}" class="form-control unique-validation" data-entity="admin" data-field="email" placeholder="email" maxlength="200" required>
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
                    <label>Is Active</label>
                    &nbsp;
                    <input type="checkbox" name="is_active" checked>
                </div>
                <br/>
                <div class="form-group" align="right">
                    <a href="{{ url('/admin/'.$objectName) }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-send"></i> Submit</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
