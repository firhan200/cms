@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-12 col-md-4 offset-md-4 form-box">	
			<div class="row">
				<div class="col-md-12 link-toolbar" align="right">
					<a href="{{ url('/profile/change-password') }}" data-toggle="tooltip" title="Change Password"><i class="fa fa-lock"></i></a>
					<a href="{{ url('/profile/edit') }}" data-toggle="tooltip" title="Edit Profile"><i class="fa fa-cog"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" align="center">
					<i class="fa fa-user-circle avatar"></i>
					<br/>
					<b>{{ $user->name }}</b>
					<br/>
					{{ $user->email }}
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6">
					<div class="text-group">
						<label>Phone Number</label>
						<div class="value">
							@if($user->phone_number!=null)
								{{ $user->phone_number }}
							@else
								-
							@endif						
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-group">
						<label>Address</label>
						<div class="value">
							@if($user->address!=null)
								{{ $user->address }}
							@else
								-
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection