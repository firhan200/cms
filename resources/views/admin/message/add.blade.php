@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="content-title">Add {{ $title }}</div> 
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">
			@include('admin.message.navigation', ['objectName' => $objectName, 'on' => 'compose'])
		</div>
        <div class="col-sm-12 col-md-12 col-lg-9 compose-message">
        	<form action="{{ url('/admin/'.$objectName.'/addProcess') }}" method="post" class="disable-form box">
                {{ csrf_field() }}   
                <div class="form-group">
                    <div class="row">
                        <div class="col-1 col-sm-1 horizontal-label">To:</div>
                        <div class="col-11 col-sm-11">
                            <select class="form-control message-to" placeholder="To" name="user_ids[]" multiple="multiple">
                                @foreach($to as $user)
                                <option value="{{ $user->id.':on:'.$user->name }}">{{ $user->name.' ('.$user->email.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" maxlength="150" required>
                </div>
                <div class="form-group">
                    <textarea name="body" rows="5" class="form-control" placeholder="Message" maxlength="2000" required></textarea>
                </div>
                <br/>
                <div class="form-group" align="right">
                    <a href="{{ url('/admin/'.$objectName) }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-send"></i> Send</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection
