@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">{{ $title }}</div>  
        	
            @if (Session::has('message'))
               {!! Session::get('message') !!}
            @endif

            <div class="row">
                <div class="col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4 box">
                    <form action="{{ url('admin/changePasswordProcess') }}" class="form-with-check-passsword" method="post">
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
                            <a href="{{ url('/admin/home') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Abort</a>
                            <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
