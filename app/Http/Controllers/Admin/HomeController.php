<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends BaseController
{
    protected $data;

    public function __construct(){
    	$this->middleware('cms_auth');

    	$this->data['title'] = "dashboard";
        $this->data['objectName'] = "home";

    }

    public function dashboard(){
    	$this->data['adminInfo'] = $this->__getUserInfo();
    	return view('admin/dashboard', $this->data);
    }

    public function getTotal(Request $request){
        $response = ['total' => 0, 'message' => ''];

        try{
            $db = $request->input('entity');

            $total = DB::table($db)->where('is_deleted', 0)->count();
            $response = ['total' => $total, 'message' => 'success'];
        }catch(\Exception $e){
            $response['message'] = $e->getMessage();
        }       

        return response()->json($response);
    }

    public function getLatestFeedback(){
        $contactUs = new \App\Models\ContactUs;

        $feedbackList = $contactUs->where('is_deleted', 0)->orderBy('id', 'desc')->limit(5)->get();

        return response()->json($feedbackList);
    }

    public function getLatestUsers(){
        $users = new \App\Models\User;

        $userList = $users->where('is_deleted', 0)->orderBy('id', 'desc')->limit(3)->get();

        return response()->json($userList);
    }

    public function logout(Request $request){
    	$request->session()->forget('cms_admin_id');
    	$request->session()->forget('cms_admin_name');

    	return Redirect('/admin');
    }
}
