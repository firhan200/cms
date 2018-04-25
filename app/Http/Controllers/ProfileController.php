<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class ProfileController extends Controller
{
    public $model;
    public $data;

    public function __construct(){
        $this->model = new \App\Models\User;

    	//constructor
    	$this->data['title'] = 'Profile';

    	/* folder in views  */
        $this->data['objectName'] = 'profile';

        /*active menu*/
        $this->data['activeMenu'] = 'profile';

        $this->middleware('user_auth');
    }

    public function index(){
        $this->data['user'] = $this->model->where('id', Session::get('user_id'))->first();

    	return view($this->data['objectName'].'/index', $this->data);
    }

    public function edit(){
        $this->data['title'] = 'Edit Profile';

        $this->data['user'] = $this->model->where('id', Session::get('user_id'))->first();

        return view($this->data['objectName'].'/edit_profile', $this->data);
    }

    public function editProcess(Request $request){
        //check user
        $user = $this->model->where('id', Session::get('user_id'))->first();
        if($user!=null){
            $user->phone_number = $request->input('phone_number');
            $user->address = $request->input('address');
            $user->save();

            $message = '<div class="alert alert-primary"><i class="fa fa-check-circle"></i> Successfully edit profile</div>';
        }else{
            $message = '<div class="alert alert-warning"><i class="fa fa-info-circle"></i> User Not Found!</div>';
        }

        //trigger flash message
        Session::flash('message', $message);

        return Redirect('/profile/edit');
    }

    public function changePassword(){
        $this->data['title'] = 'Change Password';
        return view($this->data['objectName'].'/change_password', $this->data);
    }

    public function changePasswordProcess(Request $request){
        $message = "";

        //get data
        $old_password = sha1($request->input('old_password'));
        $password = sha1($request->input('password'));
        $repeat_password = sha1($request->input('repeat_password'));

        //check old password
        $user = $this->model->where('id', Session::get('user_id'))->first();
        if($user!=null){
            if($user->password==$old_password){
                //same with old password
                if($password==$repeat_password){
                    //update
                    $user->password = $password;
                    $user->save();

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

        return Redirect('/profile/change-password');
    }
}
