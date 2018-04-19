<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
	public $data;

    public function __construct(){
    	//constructor
    	$this->data['title'] = 'Home';

    	/* folder in views & routes name */
        $this->data['objectName'] = 'home';
    }

    public function index(){
    	return view($this->data['objectName'].'/index', $this->data);
    }
}
