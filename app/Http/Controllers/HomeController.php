<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
	public $data;

    public function __construct(){
    	//constructor
    	$this->data['title'] = 'Home';

    	/* folder in views */
        $this->data['objectName'] = 'home';

        /*active menu*/
        $this->data['activeMenu'] = 'home';
    }

    public function index(){
    	return view($this->data['objectName'].'/index', $this->data);
    }

    public function logout(Request $request){
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');

        return Redirect('/');
    }
}
