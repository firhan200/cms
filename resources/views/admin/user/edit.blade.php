@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">Edit {{ $title }}</div>  

        	<form action="{{ url('/admin/'.$objectName.'/editProcess') }}" method="post" class="disable-form box">
                {{ csrf_field() }}   

                <div align="right">
                    <a href="#" class="btn btn-success confirm-modal" data-toggle="modal" data-target="#confirmModal" data-content="reset {{ $obj->name }} password to {{ $user_default_password }}" data-url="{{ url('admin/'.$objectName.'/resetPassword/'.$obj->id) }}"><i class="fa fa-lock"></i> Reset Password</a>
                </div>

                <input type="hidden" name="id" value="{{ $obj->id }}">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" maxlength="150" value="{{ $obj->name }}" required>
                </div>
                <div class="form-group unique-form">
                    <label>* E-mail</label>
                    <input type="email" id="email" name="email" class="form-control unique-validation-edit" data-entity="users" data-field="email" placeholder="email" maxlength="200" data-old-value="{{ $obj->email }}" value="{{ $obj->email }}" required>
                    <div class="unique-feedback"></div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" value="{{ $obj->address }}" name="address" class="form-control" placeholder="address" maxlength="200">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="{{ $obj->phone_number }}" name="phone_number" class="form-control" placeholder="Phone Number" maxlength="50">
                </div>
                <div class="form-group">
                    <label>Is Active</label>
                    &nbsp;
                    <input type="checkbox" name="is_active"
                    <?php
                    if($obj->is_active==1){
                        echo "checked";
                    }
                    ?>
                    >
                </div>
                <br/>
                <div class="form-group" align="right">
                    <a href="{{ url('/admin/'.$objectName) }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Save</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
