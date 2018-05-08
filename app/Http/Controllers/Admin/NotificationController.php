<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends BaseController
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

    public function checkMessages(){
        $this->data['adminInfo'] = $this->__getUserInfo();

        $message_receiver = new \App\Models\Message_Receiver;
        $notifications = $message_receiver::where('user_id', $this->data['adminInfo']['id'])->where('is_read', 0)->count();
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

    public function getMessages(){
        $this->data['adminInfo'] = $this->__getUserInfo();
        
    	$message_receiver = new \App\Models\Message_Receiver;
        $messages = $message_receiver::where('user_id', $this->data['adminInfo']['id'])->where('is_read', 0)->orderBy('id', 'desc')->get();

        $message_list = [];

        foreach($messages as $message){
            $message_list[] = [
                'link' => url('/admin/message/'.$message->message_id),
                'name' => $message->message->admin->name,
                'email' => $message->message->admin->email,
                'subject' => $message->message->subject,
                'message' => $message->message->body,
                'date' => date("H:i, d M Y", strtotime($message->message->created_at))
            ];
        }

    	$response = ['messages' => $message_list];

    	return response()->json($response);
    }

    public function truncate(){
        $this->model->where('id', '>', 0)->delete();

        $response = ['deleted' => true];

        return response()->json($response);
    }
}
