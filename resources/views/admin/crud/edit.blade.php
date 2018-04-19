@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
               <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
        	<div class="content-title">Edit {{ $title }}</div>  

        	<form action="{{ url('/admin/'.$objectName.'/editProcess') }}" method="post" class="disable-form box">
                {{ csrf_field() }}   
                <input type="hidden" name="id" value="{{ $obj->id }}">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" maxlength="150" value="{{ $obj->name }}" required>
                </div>
                <div class="form-group">
                    <label>Value</label>
                    <input type="text" name="value" class="form-control" placeholder="value" maxlength="150" value="{{ $obj->value }}" required>
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
