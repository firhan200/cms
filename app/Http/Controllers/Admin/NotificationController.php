<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    protected $model;
    protected $data;

    public function __construct(){
    	//authorize
        $this->middleware('cms_auth');

        //init model
        $this->model = new \App\Models\Notification;
    }

    public function checkNotifications(){
        $notifications = $this->model->count();
        if($notifications > 0){
            $response = ['is_notifications' => true, 'total' => $notifications];
        }else{
            $response = ['is_notifications' => false, 'total' => 0];
        }

        return response()->json($response);
    }

    public function getNotifications(){
    	$notifications = $this->model->orderBy('id', 'desc')->get();

    	$response = ['notifications' => $notifications];

    	return response()->json($response);
    }

    public function truncate(){
        $this->model->where('id', '>', 0)->delete();

        $response = ['deleted' => true];

        return response()->json($response);
    }
}
