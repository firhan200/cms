<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public $data;

    public function __construct(){
    	//constructor
    	$this->data['title'] = 'Contact Us';

    	/* folder in views */
        $this->data['objectName'] = 'contact-us';

        /*active menu*/
        $this->data['activeMenu'] = 'contact-us';
    }

    public function index(){
    	return view($this->data['objectName'].'/index', $this->data);
    }
}
