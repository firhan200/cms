<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class BaseController extends Controller
{
    public function __getUserInfo(){
    	$admin = array(
    		'id'=>Session::get('cms_admin_id'),
    		'name'=>Session::get('cms_admin_name')
    	);
    	return $admin;
    }

    public function __getSettingValueByName($settingName){
    	$settings = new \App\Models\Setting;
    	$setting = $settings::where('name', $settingName)->first();
    	if($setting!=null){
    		//found
    		return $setting->value;
    	}else{
    		//not found
    		return null;
    	}
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
            $obj = DB::table($tableName)->where($field, $value)->where('is_deleted', 0)->count();
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
}
