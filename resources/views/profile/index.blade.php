@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 form-box">
			<div class="title">My Profile</div>
			<div class="row">
				<div class="col-md-3" align="center">
					<i class="fa fa-user-circle avatar"></i>
				</div>
				<div class="col-md-4">
					<div class="text-group">
						<label>Name</label>
						<div class="value">
							{{ $user->name }}
						</div>
					</div>
					<div class="text-group">
						<label>E-mail</label>
						<div class="value">
							{{ $user->email }}
						</div>
					</div>
				</div>
				<div class="col-md-4">
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