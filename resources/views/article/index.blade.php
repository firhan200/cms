@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="content-pad">
	<div class="row">
		<div class="col-md-4 offset-md-8">
			<form action="{{ url('/loginProcess') }}" method="post" class="content-toolbar articles-search">
				{{ csrf_field() }}
	          	<div class="md-form">
	            	<i class="fa fa-search prefix grey-text"></i>
	                <input type="text" id="keyword" name="keyword" class="form-control" maxlength="100"/>
	                <label class="control-label">Search</label>
	          	</div>
	          	<div align="right">
	          		<span class="total-results"></span> results
	          	</div>
			</form>
		</div>
	</div>
    <div class="row wow fadeIn" id="articles-results">		
	</div>
	<div align="center" class="articles-navigation">			
	</div>
</div>
@endsection