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

        	<form action="{{ url('/admin/'.$objectName.'/editProcess') }}" method="post" class="disable-form box" enctype="multipart/form-data">
                {{ csrf_field() }}   
                <input type="hidden" name="id" value="{{ $obj->id }}">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" maxlength="150" value="{{ $obj->title }}" required>
                </div>
                <div class="form-group">
                    <label>Uploaded Cover:</label>
                    <br/>
                    <img src="{{ asset('images/'.$objectName.'/'.$obj->cover) }}" class="img-thumbnail img-small">
                    <br/>
                    <label>Change Cover</label>
                    <input type="file" name="cover" class="form-control" id="cover">
                    <div class="help">
                        Leave this field empty if you do not want to change cover.<br/>Allowed image extension : {{ $allowed_image_extension }}
                    </div>
                </div>
                <div class="form-group">
                    <label>Summary</label>
                    <textarea name="summary" rows="4" class="form-control" placeholder="news summary" maxlength="250" required>{{ $obj->summary }}</textarea>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <input type="hidden" id="content" value="{{ $obj->body }}">
                    <textarea name="body" id="newsContent" class="form-control ckeditor" placeholder="news content" required></textarea>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <input type="text" name="tags" value="{{ $obj->tags }}" id="tags" class="form-control">
                    <div class="help">Example: Laravel,jQuery,Bootstrap</div>
                    <br/>
                    Tags result:
                    <div id="tags-result"></div>
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
