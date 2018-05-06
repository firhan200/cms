@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">Add {{ $title }}</div>  

        	<form action="{{ url('/admin/'.$objectName.'/addProcess') }}" method="post" class="disable-form box">
                {{ csrf_field() }}   
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" maxlength="150" required>
                </div>
                <div class="form-group">
                    <label>Value</label>
                    <input type="text" name="value" class="form-control" placeholder="value" maxlength="150" required>
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
