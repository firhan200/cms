@extends('layouts.layout')

@section('title', $title)
@section($activeMenu, 'active')

@section('body')
<div class="container content-pad">
	<div class="row">
		<div class="col-md-12 form-box">
			<div class="title">Articles</div>
			<form action="#" method="post" class="content-toolbar articles-search">
				<div class="row">
					<div class="col-md-6 col-lg-4 offset-md-6 offset-lg-8">
						<div class="form-group has-icon">
							<div class="icon-container" align="center">
								<i class="fa fa-search"></i>
							</div>
							<input type="text" id="keyword" name="keyword" class="form-control" placeholder="search" maxlength="100"/>
						</div>
					</div>
				</div>			
			</form>
			<div class="row" id="articles-results">				
			</div>
			<div align="center" class="articles-navigation">			
			</div>
		</div>
	</div>
</div>
@endsection