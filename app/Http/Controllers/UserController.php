<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $data;

    public function __construct(){
    	//constructor
    	$this->data['title'] = 'User';

    	/* folder in views  */
        $this->data['objectName'] = 'user';

        /*active menu*/
        $this->data['activeMenu'] = 'user';
    }

    public function login(){
    	$this->data['activeMenu'] = 'login';
    	return view($this->data['objectName'].'/login', $this->data);
    }

    public function signUp(){
    	$this->data['activeMenu'] = 'sign-up';
    	return view($this->data['objectName'].'/sign_up', $this->data);
    }
}
