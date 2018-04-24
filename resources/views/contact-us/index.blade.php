@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
    <div class="row">
    	<div class="col-sm-12">
            <div class="box">
        		<div class="title">Contact Us</div>
        		<div class="row">
        			<div class="col-md-4">
        				We'd love to hear your feedback about us.<br/>
        				<div class="social-icon">
    	    				<a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-facebook-official"></i></a>
    	    				<a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-github"></i></a>   				
    	    				<a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-google-plus-square"></i></a>		
    	    				<a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-instagram"></i></a>
    	    				<a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-twitter-square"></i></a>
    	    			</div>
        			</div>
        			<div class="col-md-8">
        				<form action="{{ url('contactUsProcess') }}" method="post" class="disable-form-unconfirm">
        					{!! csrf_field() !!}

        					<div class="row">
        						<div class="col-md-6">
        							<div class="form-group">
        								<input type="text" name="name" class="form-control" placeholder="Name" maxlength="100" value="{{ $obj['name'] }}" <?php echo (Session::get('user_id')!=null) ? 'readonly' : ''; ?> required>
        							</div>
        						</div>
        						<div class="col-md-6">
        							<div class="form-group">
        								<input type="email" name="email" class="form-control" placeholder="E-mail" maxlength="200" value="{{ $obj['email'] }}" <?php echo (Session::get('user_id')!=null) ? 'readonly' : ''; ?> required>
        							</div>
        						</div>
        					</div>
        					<div class="row">
        						<div class="col-md-12">
        							<div class="form-group">
        								<textarea type="text" name="message" class="form-control" placeholder="Message" rows="5" maxlength="700" required>{{ $obj['message'] }}</textarea>
        							</div>
        						</div>
        					</div>
        					<div align="right">
        						<button type="submit" class="btn btn-info btn-default btn-submit">Submit</button>
        					</div>
        				</form>
        			</div>
        		</div>
            </div>
    	</div>
    </div>
</div>
@endsection
