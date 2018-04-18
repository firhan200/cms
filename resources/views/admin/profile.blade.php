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
        	<div class="content-title">{{ $title }}</div>  
        	
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <i class="fa fa-user-circle" style="font-size:50pt"></i>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-8">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $obj->name }}</td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td>{{ $obj->email }}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{ date("d-m-Y, H:i", strtotime($obj->created_at)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
