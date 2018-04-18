@extends('layouts.admin-layout')

@section('title', $title)
@section('admin-name', $adminInfo['name'])
@section($objectName, "active")

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	@if (Session::has('message'))
			   <div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
        	<div class="content-title">{{ $contentTitle }}</div>  
            <div class="box">
            	<div class="row">
            		<div class="col-sm-4">
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
            		<div class="col-sm-8" align="right">
            			<a href="{{ url('/admin/'.$objectName.'/add') }}" class="btn btn-primary" data-toggle="tooltip" title="Add {{ $objectName }}"><i class="fa fa-plus"></i> Add {{ $objectName }}</a>
            			@if($is_deleted==0)
            				<a href="{{ url('/admin/'.$objectName.'?is_deleted=1') }}" class="btn btn-light" data-toggle="tooltip" title="Recycle bin"><i class="fa fa-trash"></i></a>
            			@else
                            <a href="{{ url('/admin/'.$objectName.'?is_deleted=0') }}" class="btn btn-success" data-toggle="tooltip" title="Active List"><i class="fa fa-star"></i></a>
            				<a href="{{ url('/admin/'.$objectName.'/truncate') }}" class="btn btn-danger confirm-modal" data-content="Delete all data on recycle bin?" data-url="{{ url('/admin/'.$objectName.'/truncate') }}" data-toggle="modal" data-target="#confirmModal" data-toggle="tooltip" title="Truncate">Truncate</a>
            			@endif
            		</div>
            	</div>  
            	<br/>
            	<table class="table table-hover">
            		<thead>
            			<tr>
            				<th>No</th>
            				<th>
                                <a href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=name&order_type='.$order_type) }}">Name</a>
                            </th>
            				<th>
                                <a href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=value&order_type='.$order_type) }}">Value</a>
                            </th>
            				<th>
                                <a href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=created_at&order_type='.$order_type) }}">Created on</a>
                            </th>
            				<th>
                                <a href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=updated_at&order_type='.$order_type) }}">Updated on</a>
                            </th>
            				@if($is_deleted==0)
            				<th>
                                <a href="{{ url('admin/'.$objectName.'/?keyword='.$keyword.'&is_deleted='.$is_deleted.'&sort_by=is_active&order_type='.$order_type) }}">Is Active</a>
                            </th>
            				@endif
            				<th>Actions</th>
            			</tr>
            		</thead>
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
