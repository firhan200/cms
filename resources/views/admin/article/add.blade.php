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
        	<div class="content-title">Add {{ $title }}</div>  

        	<form action="{{ url('/admin/'.$objectName.'/addProcess') }}" method="post" class="disable-form box" enctype="multipart/form-data">
                {{ csrf_field() }}   
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" maxlength="150" value="Title" required>
                </div>
                <div class="form-group">
                    <label>Cover</label>
                    <input type="file" name="cover" class="form-control" id="cover" required>
                    <div class="help">
                        Allowed image extension : {{ $allowed_image_extension }}
                    </div>
                </div>
                <div class="form-group">
                    <label>Summary</label>
                    <textarea type="text" name="summary" class="form-control" placeholder="Summary" maxlength="250" required>Summarynya</textarea>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea name="body" class="form-control ckeditor" placeholder="news content" required>what</textarea>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <input type="text" name="tags" id="tags" class="form-control">
                    <div class="help">Example: Laravel,jQuery,Bootstrap</div>
                    <br/>
                    Tags result:
                    <div id="tags-result"></div>
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
