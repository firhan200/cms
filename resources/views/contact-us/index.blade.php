@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
    <div class="row">
    	<div class="col-sm-12">
            <div class="box">
        		<div class="row">
        			<div class="col-md-6 offset-md-3">
                        <form action="{{ url('contactUsProcess') }}" method="post" class="disable-form-unconfirm form-box">
                            {{ csrf_field() }}
                            <!-- Heading -->
                            <h3 class="dark-grey-text text-center">
                                <strong>WRITE US A FEEDBACK</strong>
                            </h3>
                            <div class="md-form">
                                <i class="fa fa-user prefix grey-text"></i>
                                <input type="text" name="name" class="form-control" maxlength="100" value="{{ $obj['name'] }}" <?php echo (Session::get('user_id')!=null) ? 'readonly' : ''; ?> required>
                                <label for="form8">Name</label>
                            </div>
                            <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="email" name="email" class="form-control" maxlength="200" value="{{ $obj['email'] }}" <?php echo (Session::get('user_id')!=null) ? 'readonly' : ''; ?> required>
                                <label for="form8">E-mail</label>
                            </div>
                            <div class="md-form">
                                <i class="fa fa-lock prefix grey-text"></i>
                                <textarea type="text" name="message" class="form-control md-textarea" rows="5" maxlength="700" required>{{ $obj['message'] }}</textarea>
                                <label for="form8">Message</label>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-default btn-submit" disabled="disabled">Submit</button>
                                <br/>
                                <br/>
                                Get to know us:
                                <div class="social-icon">
                                    <a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-facebook-official"></i></a>
                                    <a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-github"></i></a>                  
                                    <a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-google-plus-square"></i></a>      
                                    <a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-instagram"></i></a>
                                    <a href="#" data-toggle="tooltip" title="social" data-placement="top"><i class="fa fa-twitter-square"></i></a>
                                </div>
                            </div>
                        </form>             				
        			</div>
        		</div>
            </div>
    	</div>
    </div>
</div>
@endsection
