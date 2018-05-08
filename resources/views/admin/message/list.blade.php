@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
<div class="content-title">{{ $contentTitle }}</div>  
    <div class="row">
		<div class="col-sm-12 col-md-12 col-lg-3">
			@include('admin.message.navigation', ['objectName' => $objectName, 'on' => 'inbox'])
		</div>
		<div class="col-md-12 col-md-12 col-lg-9">	
            <div class="box">
            	<div class="row">
					<div class="col-md-3 offset-md-3" align="right">
						<div class="dropdown">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								Sort by
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=created_at&order_type='.$order_type) }}">Date</a>
								<a class="dropdown-item" href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=subject&order_type='.$order_type) }}">Subject</a>
							</div>
						</div>
					</div>
            		<div class="col-md-6" align="right">
            			<form>
            				<div class="form-group has-icon">
                                <input type="hidden" name="is_deleted" value="{{ $is_deleted }}">
                                <input type="hidden" name="sort_by" value="{{ $sort_by }}">
            					<input type="hidden" name="order_type" value="{{ $order_type }}">
                                <div class="icon-container" align="center">
                                    <i class="fa fa-search"></i>
                                </div>
            					<input type="text" name="keyword" placeholder="search" class="form-control" value="{{ $keyword }}">
            				</div>
            			</form>
            		</div>
            	</div>  
            	<br/>
            	<table class="table table-hover">
            		<tbody>
            			@if($objList->count() < 1)
            				<tr>
            					<td colspan="7" class="alert alert-light"><center>No message</center></td>
            				</tr>
            			@else
    	        			@foreach($objList as $obj)
                            <?php
                            //utc date to local
							$dateInLocal = date("Y-m-d H:i:s", strtotime($obj->created_at));
							//$message_id = ($obj->message_parent_id!=null ? $obj->message_parent_id : $obj->message_id); 
							$message_id = $obj->message_id;
							?>
    	        			<tr class="message-row <?php echo ($obj->is_read==0 ? 'unread':'read' ); ?>" data-href="{{ url('/admin/message/'.$message_id) }}">
                                <td width="20%">{{ $obj->admin->email }}</td>
    	        				<td>
									<?php
										$max = 50;
										$subject = "";
										if(strlen($obj->subject) > $max){
											$subject = substr($obj->subject, 0, $max)."...";
										}else{
											$subject = $obj->subject;
										}
									?>
									{{ $subject }}
								</td>
                                <td align="right">
									<?php
										$date = "";
										if(date("d-m-Y", strtotime($obj->created_at))==date("d-m-Y", time())){
											$date = date("H:i", strtotime($obj->created_at));
										}else{
											$date = date("m M", strtotime($obj->created_at));
										}
									?>
									<b>{{ $date }}</b>
								</td>    	        				
    	        			</tr>
    	        			<?php $counter++; ?>
    	        			@endforeach
            			@endif
            	</table> 
            	<div align="center">
            		{{ $objList->links() }} 
        		</div> 	     
            </div>
        </div>
    </div>
</div>
@endsection
