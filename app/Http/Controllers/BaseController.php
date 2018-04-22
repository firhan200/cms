<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BaseController extends Controller
{
	public function __construct(){

	}

    public function __checkUnique(Request $request){
        $response = ['found' => false, 'message'=>''];

        $tableName = $request->input('entity');
        $field = $request->input('field');
        $value = $request->input('value');       
        if($request->input('oldValue')!=null){
            //edit
            $oldValue = $request->input('oldValue');
            $obj = DB::table($tableName)->where($field, $value)->where($field, '!=', $oldValue)->where('is_deleted', 0)->count();
        }else{
            //add
            if($tableName=='users'){
            	//check without is deleted
            	$obj = DB::table($tableName)->where($field, $value)->count();
            }else{
            	$obj = DB::table($tableName)->where($field, $value)->where('is_deleted', 0)->count();
            }         
        }

        try{
            
            if($obj > 0){
                $response = ['found' => true, 'message'=>'<div class="error">email already taken!</div>'];
            }
        }catch(Exception $err){
            $response = ['found' => false, 'message'=>$err];
        }
        

        return response()->json($response);
    }

    public function __createNotification($action, $object, $link){
    	$notification = new \App\Models\Notification;
  		
    	$notification->action = $action;
    	$notification->object = $object;
    	$notification->link = $link;
    	$notification->is_active = 1;
    	$notification->is_deleted = 0;
    	$notification->save();  	
    }
}
