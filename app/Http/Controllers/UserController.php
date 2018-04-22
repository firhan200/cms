<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class UserController extends BaseController
{
    public $model;
    public $data;

    public function __construct(){
        $this->model = new \App\Models\User;

    	//constructor
    	$this->data['title'] = 'User';

    	/* folder in views  */
        $this->data['objectName'] = 'user';

        /*active menu*/
        $this->data['activeMenu'] = 'user';

        $this->middleware('guest_auth');
    }

    public function login(){
    	$this->data['activeMenu'] = 'login';
    	return view($this->data['objectName'].'/login', $this->data);
    }

    public function loginProcess(Request $request){
        $this->data['email'] = $request->input('email');
        $password = $request->input('password');

        $validating = $this->loginValidation($this->data['email'], $password);
        if($validating['isValid']){
            Session::flash('message', $validating['message']);
            return Redirect(url('/'));
        }else{
            Session::flash('message', $validating['message']);
        }

        return view($this->data['objectName'].'/login', $this->data);
    }

    public function loginValidation($email, $password){
        $responses = ['isValid' => false, 'message' => ''];

        //check login
        $userObj = $this->model::where('email' , $email)->first();
        if($userObj!=null){
            if($userObj->password==sha1($password)){
                //set session
                Session::put('user_id', $userObj->id);
                Session::put('user_name', $userObj->name);

                $responses = ['isValid' => true, 'message' => '<div class="alert alert-primary">Welcome, '.Session::get('user_name').'</div>'];
            }else{
                //password incorrect
                $responses = ['isValid' => false, 'message' => "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Incorrect password!</div>"];
            }
            
        }else{
            //account not found
            $responses = ['isValid' => false, 'message' => "<div class='alert alert-warning'>Account not found!</div>"];
        }

        return $responses;
    }

    public function signUp(){
    	$this->data['activeMenu'] = 'sign-up';
    	return view($this->data['objectName'].'/sign_up', $this->data);
    }

    public function signUpProcess(Request $request){
        $this->data['obj']['name'] = $request->input('name');
        $this->data['obj']['email'] = $request->input('email');

        //process data
        $checkObj = $this->model->where('email', $request->input('email'))->count();
        if($checkObj > 0){
            Session::flash('message', '<div class="alert alert-danger">Email <b>'.$this->data['obj']['email'].'</b> already taken</div>');
            //already taken
            return view($this->data['objectName'].'/sign_up', $this->data);
        }else{
            //insert data to model
            $this->model->name = $this->data['obj']['name'];
            $this->model->email = $this->data['obj']['email'];
            $this->model->password = sha1($request->input('password'));
            $this->model->is_active = 1;
            $this->model->is_deleted = 0;

            //save model
            $this->model->save();

            $validating = $this->loginValidation($this->data['obj']['email'], $request->input('password'));
            if($validating['isValid']){
                //create notification
                $this->__createNotification('new user', $this->model->name, url('/admin/user/'.$this->model->id));

                Session::flash('message', $validating['message']);
                return Redirect(url('/'));
            }else{
                Session::flash('message', $validating['message']);
            }
        }
    }
}
