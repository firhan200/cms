@extends('../layouts/admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-title">Dashboard</div>
            <div class="row">
            	<div class="col-md-6 col-lg-4 col-sm-6">
            		<div class="box box-blue">
            			<div class="row">
            				<div class="col-md-8 col-sm-8 col-xs-6">
            					<div class="big">24</div>
            					<div class="label">News</div>
            				</div>
            				<div class="col-md-4 col-sm-4 col-xs-6" align="right">
            					<i class="fa fa-newspaper-o"></i>
            				</div>
            			</div>           			
            		</div>
            	</div>
            	<div class="col-md-6 col-lg-4 col-sm-6">
            		<div class="box box-blue">
            			<div class="row">
            				<div class="col-md-8 col-sm-8 col-xs-6">
            					<div class="big">24</div>
            					<div class="label">News</div>
            				</div>
            				<div class="col-md-4 col-sm-4 col-xs-6" align="right">
            					<i class="fa fa-newspaper-o"></i>
            				</div>
            			</div>           			
            		</div>
            	</div>
            	<div class="col-md-6 col-lg-4 col-sm-6">
            		<div class="box box-blue">
            			<div class="row">
            				<div class="col-md-8 col-sm-8 col-xs-6">
            					<div class="big">24</div>
            					<div class="label">News</div>
            				</div>
            				<div class="col-md-4 col-sm-4 col-xs-6" align="right">
            					<i class="fa fa-newspaper-o"></i>
            				</div>
            			</div>           			
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection
