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
            		<div class="label">Title</div>
            		{{ $obj->title }}
            	</div>
                <div class="content">
                    <div class="label">Cover</div>
                    <img src="{{ asset('images/'.$objectName.'/'.$obj->cover) }}" class="img-thumbnail img-small">
                </div>
            	<div class="content">
            		<div class="label">Summary</div>
            		{{ $obj->summary }}
            	</div>
                <div class="content">
                    <div class="label">Body</div>
                    {!! $obj->body !!}
                </div>
                <div class="content">
                    <div class="label">Tags</div>
                    <input type="hidden" name="tags" value="{{ $obj->tags }}" id="tags" class="form-control">
                    <div id="tags-result"></div>
                </div>
                <div class="content">
                    <div class="label">Active</div>
                    @if($obj->is_active)
                        <span class="badge badge-success">active</span>
                    @else
                        <span class="badge badge-danger">un-active</span>
                    @endif
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
