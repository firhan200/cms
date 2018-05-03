@extends('../layouts/admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, 'active')

@section('body')
<div class="container dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="content-title">Dashboard</div>
            <div class="row">
            	<div class="col-md-4 col-lg-3 col-sm-4">
            		<div class="box dashboard-total" data-entity="users">
            			<div class="row">
            				<div class="col-md-8 col-sm-8 col-xs-6">
            					<div class="big total-result">
                                                <i class="fa fa-spinner loading"></i>                         
                                          </div>
            					<div class="label">User</div>
            				</div>
            				<div class="col-md-4 col-sm-4 col-xs-6" align="right">
            					<i class="fa fa-users"></i>
            				</div>
            			</div>           			
            		</div>
                        <div class="box dashboard-total" data-entity="article">
                              <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                          <div class="big total-result">
                                                <i class="fa fa-spinner loading"></i>                         
                                          </div>
                                          <div class="label">Article</div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6" align="right">
                                          <i class="fa fa-newspaper-o"></i>
                                    </div>
                              </div>                        
                        </div>
                        <div class="box dashboard-total" data-entity="contact_us">
                              <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                          <div class="big total-result">
                                                <i class="fa fa-spinner loading"></i>                         
                                          </div>
                                          <div class="label">Contact Us</div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6" align="right">
                                          <i class="fa fa-envelope"></i>
                                    </div>
                              </div>                        
                        </div>   
                        <div class="box">
                              <div class="box-title">Latest Users <span class="loader"></span></div>
                              <div class="latest-users">
                                    <center><i class="fa fa-spinner loading"></i></center>
                              </div>    
                        </div>           
            	</div>
            	<div class="col-md-5 col-lg-5 col-sm-8"> 
            		<div class="box">
                              <div class="box-title">Latest Feedbacks <span class="loader"></span></div>
                              <div class="latest-feedback">
                                    <center><i class="fa fa-spinner loading"></i></center>
                              </div>    
                        </div>
            	</div>
            	<div class="col-md-6 col-lg-4 col-sm-6">
                        <div class="box">
                              <div class="box-title">Users</div>
                              <canvas id="users-chart" class="chart" height="200px"></canvas>
                        </div>
                        <div class="box">
                              <div class="box-title">Feedbacks</div>
                              <canvas id="feedback-chart" class="chart" height="180px"></canvas>
                        </div>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection
