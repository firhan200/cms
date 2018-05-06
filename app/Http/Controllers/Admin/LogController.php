<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Mail;
use Carbon\Carbon;
use Redirect;

class LogController extends BaseController
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
                //check if active
                if($adminObj->is_active){
                    //set session
                    Session::put('cms_admin_id', $adminObj->id);
                    Session::put('cms_admin_name', $adminObj->name);
                    Session::put('cms_admin_type', $adminObj->type);

                    return Redirect('admin/home');
                }else{
                    Session::flash('message', "<div class='alert alert-warning'>Your account is not active yet!</div>");
                }            
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

    public function forgotPassword(){
        return view('admin/forgot_password');
    }

    public function forgotPasswordProcess(Request $request){
        $email = $request->input('email');

        //validating email input
        $adminObj = $this->admin::where('email' , $email)->first();
        if($adminObj!=null){
            //update reset password token
            $resetPasswordToken = sha1(md5("secret".date("d-M-Y, H:i:s", strtotime(Carbon::now()))));

            //update reset_password_token
            $adminObj->reset_password_token = $resetPasswordToken;
            $adminObj->reset_password_sent = Carbon::now('UTC');
            $adminObj->save();

            //send email
            $resetPasswordUrl = $this->__getSettingValueByName('admin_url')."/resetPassword/?token=".$resetPasswordToken;
            $data = array('name'=>$adminObj->name, "url" => $resetPasswordUrl);
            $this->data['email'] = $adminObj->email;
            Mail::send('emails.admin_forgot_password', $data, function($message) {
                $message->to('firhan.faisal1995@gmail.com', 'Administrator')
                ->subject('CMS Forgot Password');
            });

            $message = '<div class="alert alert-primary">Link to reset password has been send to your email</div>';
        }else{
            $message = '<div class="alert alert-warning">E-mail not found!</div>';
        }

        //trigger flash message
        Session::flash('message', $message);

        return Redirect(url('/admin/forgotPassword'));
    }

    public function resetPassword(Request $request){
        $resetPasswordToken = $request->input('token');

        //validating
        $adminObj = $this->admin->where('reset_password_token', $resetPasswordToken)->first();
        if($adminObj!=null){
            //check if link has been seen over 2 hour
            $reset_password_sent = Carbon::parse($adminObj->reset_password_sent)->addHours(2);
            //return $reset_password_sent." > ".Carbon::now('UTC');
            if(!$reset_password_sent->gt(Carbon::now('UTC'))){
                $message = '<div class="alert alert-warning">Link Expired!</div>';
                Session::flash('message', $message);
                return Redirect(url('/admin'));
            }
        }else{
            //trigger flash message
            $message = '<div class="alert alert-danger">Token invalid!</div>';
            Session::flash('message', $message);
            return Redirect(url('/admin'));
        }

        $this->data['resetPasswordToken'] = $resetPasswordToken;
        return view('admin/reset_password', $this->data);
    }

    public function resetPasswordProcess(Request $request){
        $this->data['resetPasswordToken'] = $request->input('resetPasswordToken');
        $password = sha1($request->input('password'));
        $repeatPassword = sha1($request->input('repeat_password'));

        //validating
        $adminObj = $this->admin->where('reset_password_token', $this->data['resetPasswordToken'])->first();
        if($adminObj!=null){
            //check if link has been seen over 2 hour
            $reset_password_sent = Carbon::parse($adminObj->reset_password_sent)->addHours(2);
            if($reset_password_sent->gt(Carbon::now('UTC'))){
                //check repeat password
                if($password!=$repeatPassword){
                    $message = '<div class="alert alert-warning">Repeat password must be same with Password</div>';
                }else{
                    $adminObj->password = $password;
                    $adminObj->save();

                    $message = '<div class="alert alert-primary">Password has been reset</div>';

                    Session::flash('message', $message);
                    return Redirect(url('/admin'));
                }
                
            }else{
                $message = '<div class="alert alert-warning">Link Expired!</div>';
            }
        }else{
            //trigger flash message
            Session::flash('message', '<div class="alert alert-danger">Token invalid!</div>');
            return Redirect(url('/admin'));
        }

        //trigger flash messahe
        Session::flash('message', $message);

        return Redirect(url('admin/resetPassword/').'?token='.$this->data['resetPasswordToken']);
    }

    public function sendEmail(){
        
        return view('emails/admin_forgot_password');
    }
}
