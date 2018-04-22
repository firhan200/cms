@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="content-title">{{ $title }}</div>  
        	
            <div class="row">               
                <div class="col-sm-10 col-md-8 col-lg-6 offset-sm-1 offset-md-2 offset-lg-3 box">
                    <div align="right">
                        <a href="{{ url('admin/changePassword') }}" class="btn btn-success btn-sm"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
                    <div align="center">
                        <i class="fa fa-user-circle" style="font-size:50pt"></i>
                    </div>
                    <br/>
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
