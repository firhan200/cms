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
}
