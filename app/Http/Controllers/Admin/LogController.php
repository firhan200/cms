<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class LogController extends Controller
{
    protected $data;
	private $admin;

    public function __construct(){
    	$this->admin = new \App\Models\Admin;

    	$this->middleware('cms_guest');
    }

    public function login(){
    	return view('admin/login');
    }

    public function loginProcess(Request $request){
    	$email = $request->input('email');
    	$password = sha1($request->input('password'));

    	//check login
    	$adminObj = $this->admin::where('email' , $email)->first();
    	if($adminObj!=null){
            if($adminObj->password==$password){
                //set session
                Session::put('cms_admin_id', $adminObj->id);
                Session::put('cms_admin_name', $adminObj->name);

                return Redirect('admin/home');
            }else{
                //password incorrect
                Session::flash('message', "<div class='alert alert-danger'>Incorrect password!</div>");
            }
    		
    	}else{
            //account not found
            Session::flash('message', "<div class='alert alert-warning'>Account not found!</div>");
        }

        

    	return view('admin/login');
    }
}
