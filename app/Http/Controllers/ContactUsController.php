<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Redirect;

class ContactUsController extends BaseController
{
    public $model;
    public $data;

    public function __construct(){
    	//constructor
    	$this->data['title'] = 'Contact Us';

    	/* folder in views */
        $this->data['objectName'] = 'contact-us';

        /*active menu*/
        $this->data['activeMenu'] = 'contact-us';

        $this->model = new \App\Models\ContactUs;
    }

    public function index(){
        $this->data['obj']['name'] = '';
        $this->data['obj']['email'] = '';
        $this->data['obj']['message'] = '';

        //check if user login / not
        $userId = Session::get('user_id');
        if($userId!=null){
            //get user info
            $model = new \App\Models\User;
            $user = $model->where('id', $userId)->first();
            if($user!=null){
                $this->data['obj']['name'] = $user->name;
                $this->data['obj']['email'] = $user->email;
            }
        }

    	return view($this->data['objectName'].'/index', $this->data);
    }

    public function contactUsProcess(Request $request){
        $this->data['obj']['name'] = $request->input('name');
        $this->data['obj']['email'] = $request->input('email');
        $this->data['obj']['message'] = $request->input('message');

        //process data
        $sameEmailFeedback = $this->model->where('email', $request->input('email'))->orderBy('id', 'desc')->first();
        if($sameEmailFeedback != null){
            if($sameEmailFeedback->created_at->gt(Carbon::now()->addMinutes(-1))){
                //stop here wait for a minute
                Session::flash('message', '<div class="alert alert-danger">You <b>'.$this->data['obj']['email'].'</b> just give us a feedback a minute ago, please wait a minute.</div>');

                return view($this->data['objectName'].'/index', $this->data);
            }
        }

        if($request->session()->has('user_id')){
            //login user
            $user = new \App\Models\User;
            $userObj = $user->where('id', Session::get('user_id'))->first();
            if($userObj!=null){
                $this->data['obj']['name'] = $userObj->name;
                $this->data['obj']['email'] = $userObj->email;
            }else{
                Session::flash('message', '<div class="alert alert-danger">Something wrong, failed to send feedback</div>');
                return Redirect(url('/contact-us'));
            }          
        }
        
        //last feedback from same email already 1 minute ago
        $this->model->name = $this->data['obj']['name'];
        $this->model->email = $this->data['obj']['email'];
        $this->model->message = $this->data['obj']['message'];
        $this->model->is_deleted = 0;

        //save model
        $this->model->save();

        //create notification
        $this->__createNotification('new feedback from', $this->model->name, url('/admin/contact_us/'.$this->model->id));

        Session::flash('message', '<div class="alert alert-primary">Thank you for sending us your feedback</div>');
        return Redirect(url('/contact-us'));
    }
}
