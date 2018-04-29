@extends ('../layouts.email')

@section('body')
<div>
	Hello, <b>{{ $name }}</b>
	<br/>
	<br/>
	To reset your password click link below:
	<br/>
	<br/>
	<br/>
	<a href="{{ $url }}" style="text-decoration: none; background-color:#17a2b8;color:#fff;padding:15px;top:50px">Reset Password</a>
	<br/>
	<br/>
	<br/>
	This link will expire in 2 hours.
	<br/>
	<br/>
	If you did not request to reset your password. Please ignore this message
</div>
@endsection