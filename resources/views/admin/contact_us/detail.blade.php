@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">Detail {{ $title }}</div>  

            <div class="box">
            	<div class="content">
            		<div class="label">Name</div>
            		{{ $obj->name }}
            	</div>
            	<div class="content">
            		<div class="label">E-mail</div>
            		{{ $obj->email }}
            	</div>
                <div class="content">
                    <div class="label">Message</div>
                    {{ $obj->message }}
                </div>
            	<div class="content">
            		<div class="label">Created At</div>
            		{{ date("d-m-Y, H:i", strtotime($obj->created_at)) }}
            	</div>
            	<div class="content">
            		<div class="label">Updated At</div>
            		{{ date("d-m-Y, H:i", strtotime($obj->updated_at)) }}
                </div>
        	</div>
        </div>
    </div>
</div>
@endsection
