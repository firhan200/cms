<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class BaseController extends Controller
{
    public function __getUserInfo(){
    	$admin = array(
    		'id'=>Session::get('cms_admin_name'),
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
}
