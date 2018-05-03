@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
<div class="content-title">{{ $contentTitle }}</div>  
    <div class="row">
		<div class="col-sm-12 col-md-3 col-lg-3">
			@include('admin.message.navigation', ['objectName' => $objectName, 'on' => 'inbox'])
		</div>
		<div class="col-md-12 col-md-9 col-lg-9">	
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
            					<td colspan="7" class="alert alert-light"><center>No Data</center></td>
            				</tr>
            			@else
    	        			@foreach($objList as $obj)
                            <?php
                            //utc date to local
                            $dateInLocal = date("Y-m-d H:i:s", strtotime($obj->created_at));
                            ?>
    	        			<tr>
    	        				<td>{{ $counter }}</td>
                                <td>{{ $obj->name }}</td>
    	        				<td>{{ $obj->value }}</td>
                                <td>{{ date("d-m-Y, H:i", strtotime($obj->created_at)) }}</td>
    	        				<td>{{ date("d-m-Y, H:i", strtotime($obj->updated_at)) }}</td>
    	        				@if($is_deleted==0)
    		        				<td>
    		        					@if($obj->is_active==1)
    		        						<span class="badge badge-success">Active</span>
    		        					@else
    		        						<span class="badge badge-danger">No-active</span>
    		        					@endif
    		        				</td>
    	        				@endif
    	        				<td>
    	        					@if($is_deleted==0)
    		        					<div class="dropdown">
    									  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    									    <i class="fa fa-cog"></i>
    									  </button>
    									  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    									    <a class="dropdown-item" href="{{ url('/admin/'.$objectName.'/'.$obj->id) }}"><i class="fa fa-eye"></i> View</a>
    									    <a class="dropdown-item" href="{{ url('/admin/'.$objectName.'/edit/'.$obj->id) }}"><i class="fa fa-cog"></i> Edit</a>
    									    <a class="dropdown-item confirm-modal" data-content="delete {{ $obj->name }} ?" data-url="{{ url('/admin/'.$objectName.'/delete/'.$obj->id.'/1') }}" href="#!" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-remove"></i> Delete</a>
    									  </div>
    								@else
                                        <a href="#!" class="btn btn-sm btn-success confirm-modal" data-content="restore {{ $obj->name }} ?" data-url="{{ url('/admin/'.$objectName.'/delete/'.$obj->id.'/0') }}" data-toggle="modal" data-target="#confirmModal">Restore</a>
    									<a href="#!" class="btn btn-sm btn-danger confirm-modal" data-content="delete permanent {{ $obj->name }} ?" data-url="{{ url('/admin/'.$objectName.'/deletePermanent/'.$obj->id) }}" data-toggle="modal" data-target="#confirmModal">Delete</a>
    							  	@endif
    								</div>
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
