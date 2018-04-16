<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends BaseController
{
    protected $data;

    public function __construct(){
    	$this->middleware('cms_auth');

    	$this->data['title'] = "dashboard";

    }

    public function dashboard(){
    	$this->data['adminInfo'] = $this->__getUserInfo();
    	return view('admin/dashboard', $this->data);
    }

    public function logout(Request $request){
    	$request->session()->forget('cms_admin_id');
    	$request->session()->forget('cms_admin_name');

    	return Redirect('/admin');
    }
}
