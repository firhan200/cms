<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

class ProfileController extends BaseController
{
    protected $model;
    protected $data;

    public function __construct(){
    	$this->middleware('cms_auth');

        $this->model = new \App\Models\Admin;
        $this->data['title'] = "Profile";
        $this->data['objectName'] = 'profile';      
    }

    public function profile(){
    	$this->data['adminInfo'] = $this->__getUserInfo();

    	$this->data['obj'] = $this->model->where('id', $this->data['adminInfo']['id'])->first();

    	return view('admin/profile', $this->data);
    }

    public function changePassword(){
        $this->data['adminInfo'] = $this->__getUserInfo();
        $this->data['title'] = "Change Password";       

        return view('admin/change_password', $this->data);
    }

    public function changePasswordProcess(Request $request){
        $this->data['adminInfo'] = $this->__getUserInfo();

        $message = "";

        //get data
        $old_password = sha1($request->input('old_password'));
        $password = sha1($request->input('password'));
        $repeat_password = sha1($request->input('repeat_password'));

        //check old password
        $admin = $this->model->where('id', $this->data['adminInfo']['id'])->first();
        if($admin!=null){
            if($admin->password==$old_password){
                //same with old password
                if($password==$repeat_password){
                    //update
                    $admin->password = $password;
                    $admin->save();

                    $message = "<div class='alert alert-primary'>Password updated</div>";
                }else{
                    $message = "<div class='alert alert-warning'>Password not same with repeat password</div>";
                }
            }else{
                $message = "<div class='alert alert-warning'>Wrong old password!</div>";
            }
        }else{
            $message = "<div class='alert alert-warning'>Administrator not found!</div>";
        }

        //trigger flash message
        Session::flash('message', $message);

        return Redirect('/admin/changePassword');
    }
}
