@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
	<div class="content-title">Detail {{ $title }}</div>  
    <div class="row">
		<div class="col-sm-12 col-md-12 col-lg-3">
			@include('admin.message.navigation', ['objectName' => $objectName, 'on' => 'inbox'])
		</div>
        <div class="col-md-12 col-md-12 col-lg-9">
            <div class="box">
            	<b>{{ $messages[0]->subject }}</b>
				<hr/>
				@foreach($messages as $message)
				<div class="row message-detail">
					<div class="col-sm-1">
						<i class="fa fa-user-circle-o"></i>
					</div>
					<div class="col-sm-8">
						<div class="from">
							<span class="name">{{ $message->admin->name }}</span> <span class="email">{{ '<'.$message->admin->email.'>' }}</span>
						</div>
						<div class="to">
							to {{$message->message_receivers}}
						</div>
						{!! $message->body !!}
					</div>
					<div class="col-sm-3" align="right">
						<div class="date">{{ date("H:i: d M Y", strtotime($message->message_date)) }}</div>
					</div>
				</div>
				<hr/>
				@endforeach

				<form action="{{ url('/admin/'.$objectName.'/reply/'.$message_id) }}" method="post" class="disable-form-unconfirm">
					{{ csrf_field() }}
					<div class="form-group has-icon">
						<div class="icon-container" align="center">
							<i class="fa fa-pencil"></i>
						</div>
						<textarea type="text" name="body" class="form-control" placeholder="Reply" maxlength="1000" required/></textarea>
					</div>
					<div align="right">
						<button type="submit" class="btn btn-primary btn-submit btn-small">Send</button>
					</div>
				</form>
        	</div>
        </div>
    </div>
</div>
@endsection
