<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

/* 
views in resources/views/admin/crud
*/

class MessageController extends BaseController
{
    protected $model;
    protected $data;

    public function __construct(){
    	//authorize
        $this->middleware('cms_auth');

        //init model
        $this->model = new \App\Models\Message;
        $this->data['title'] = "Message";
        
        //set pagination
        $paginate = $this->__getSettingValueByName('pagination');
        if(ctype_digit(strval($paginate))){
            if($paginate < 1){
                $paginate = 1;
            }
        }else{
            //default
            $paginate = 10;
        }
        $this->data['paginate'] = $paginate;

        /* folder in views & routes name */
        $this->data['objectName'] = 'message';
    }

    //inbox
    public function list(Request $request){
        $this->data['adminInfo'] = $this->__getUserInfo();
        $this->data['counter'] = 1;
        $this->data['keyword'] = "";
        $this->data['is_deleted'] = 0;
        $this->data['sort_by'] = 'id';
        $this->data['order_type'] = 'desc';
        $this->data['contentTitle'] = $this->data['title'];
        //local var
        $order_type = 'desc';

        //set counter
        if($request->query('page')!=null){
            $this->data['counter'] = ($request->query('page')*$this->data['paginate'])-($this->data['paginate'] - 1);
        }   

        //get & set query string
        if($request->query('keyword')!=null){
            $this->data['keyword'] = $request->query('keyword');
        }
        if($request->query('is_deleted')!=null){     
            $this->data['is_deleted'] = $request->query('is_deleted');
            if($this->data['is_deleted']==1){
                $this->data['contentTitle'] = "Deleted ".$this->data['title'];
            }
        }
        if($request->query('sort_by')!=null){
            $this->data['sort_by'] = $request->query('sort_by');
        }
        if($request->query('order_type')!=null){
            $this->data['order_type'] = $request->query('order_type');
        }
        $querystringArray = [
            'keyword' => $this->data['keyword'], 
            'is_deleted' => $this->data['is_deleted'],
            'sort_by' => $this->data['sort_by'],
            'order_type' => $this->data['order_type']
        ];
        
        //procedure query
        $this->data['objList'] = $this->model->
            where('is_deleted', $this->data['is_deleted'])->
            where(function($query){
                $query->
                where('subject', 'LIKE', "%".$this->data['keyword']."%");
            })->
            join('message_receiver', 'message.id', '=', 'message_receiver.message_id')->
            where('message_receiver.user_id', $this->data['adminInfo']['id'])->
            orderBy('message.'.$this->data['sort_by'], $this->data['order_type'])->
            select('*', 'message.id as message_id')->
            paginate($this->data['paginate']);

        //append query string to laravel pagination
        $this->data['objList']->appends($querystringArray);

        //var send to view
        if($this->data['order_type']=="desc"){
            $this->data['order_type'] = "asc";
        }else{
            $this->data['order_type'] = "desc";
        }

        return view('admin/'.$this->data['objectName'].'/list', $this->data);
    }

    public function sent(Request $request){
        $this->data['adminInfo'] = $this->__getUserInfo();
        $this->data['counter'] = 1;
        $this->data['keyword'] = "";
        $this->data['is_deleted'] = 0;
        $this->data['sort_by'] = 'id';
        $this->data['order_type'] = 'desc';
        $this->data['contentTitle'] = $this->data['title'];
        //local var
        $order_type = 'desc';

        //set counter
        if($request->query('page')!=null){
            $this->data['counter'] = ($request->query('page')*$this->data['paginate'])-($this->data['paginate'] - 1);
        }   

        //get & set query string
        if($request->query('keyword')!=null){
            $this->data['keyword'] = $request->query('keyword');
        }
        if($request->query('is_deleted')!=null){     
            $this->data['is_deleted'] = $request->query('is_deleted');
            if($this->data['is_deleted']==1){
                $this->data['contentTitle'] = "Deleted ".$this->data['title'];
            }
        }
        if($request->query('sort_by')!=null){
            $this->data['sort_by'] = $request->query('sort_by');
        }
        if($request->query('order_type')!=null){
            $this->data['order_type'] = $request->query('order_type');
        }
        $querystringArray = [
            'keyword' => $this->data['keyword'], 
            'is_deleted' => $this->data['is_deleted'],
            'sort_by' => $this->data['sort_by'],
            'order_type' => $this->data['order_type']
        ];
        
        //procedure query
        $this->data['objList'] = $this->model->
            where('is_deleted', $this->data['is_deleted'])->
            where(function($query){
                $query->
                where('subject', 'LIKE', "%".$this->data['keyword']."%");
            })->
            where('admin_id', $this->data['adminInfo']['id'])->
            select('*', 'message.id as message_id')->
            orderBy($this->data['sort_by'], $this->data['order_type'])->
            paginate($this->data['paginate']);

        //append query string to laravel pagination
        $this->data['objList']->appends($querystringArray);

        //var send to view
        if($this->data['order_type']=="desc"){
            $this->data['order_type'] = "asc";
        }else{
            $this->data['order_type'] = "desc";
        }

        return view('admin/'.$this->data['objectName'].'/sent', $this->data);
    }

    public function add(){
        $this->data['adminInfo'] = $this->__getUserInfo();

        //get all user admin
        $admin = new \App\Models\Admin;
        $this->data['to'] = $admin::where('id', '!=', $this->data['adminInfo']['id'])->
                            where('is_active', 1)->
                            where('is_deleted', 0)->
                            get();

        return view('admin/'.$this->data['objectName'].'/add', $this->data);
    }

    public function addProcess(Request $request){
        $this->data['adminInfo'] = $this->__getUserInfo();

        $user_ids = $request->input('user_ids');

        //get message receiver email
        $receivers = "";
        foreach($user_ids as $user_id){
            $user_id_array = explode(":on:", $user_id);
            if($receivers==""){
                $receivers = $user_id_array[1];
            }else{
                $receivers = $receivers." , ".$user_id_array[1];
            }  
        }

        //insert message
        $this->model->admin_id = $this->data['adminInfo']['id'];
        $this->model->subject = $request->input('subject');
        $this->model->body = $request->input('body');
        $this->model->message_receivers = $receivers;
        $this->model->is_active = 1;
        $this->model->is_deleted = 0;

        //save message
        $this->model->save();

        $message_id = $this->model->id;

        //insert message receiver
        foreach($user_ids as $user_id){
            $user_id_array = explode(":on:", $user_id);
            $message_receiver = new \App\Models\Message_Receiver;
            $message_receiver->message_id = $message_id;
            $message_receiver->user_id = $user_id_array[0];
            $message_receiver->is_read = 0;
            $message_receiver->save();
        }  

        //trigger flash message
        Session::flash('message', "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully insert ".$this->model->name."</div>");

        return Redirect('/admin/'.$this->data['objectName'].'/'.$message_id);
    }

    public function detail($message_id){
        $this->data['adminInfo'] = $this->__getUserInfo();

        //validating data
        $message = $this->model->where('id', $message_id)->first();
        if($message!=null){
            $message_receiver = new \App\Models\Message_Receiver;
            $total_user_included = $message::where(function($query) use ($message_id){
                                $query->
                                where('message.message_parent_id', $message_id)->
                                orWhere('message.id', $message_id);
                            })->
                            where(function($query){
                                $query->
                                where('message.admin_id', $this->data['adminInfo']['id'])->
                                orWhere('message_receiver.user_id', $this->data['adminInfo']['id']);
                            })->
                            join('message_receiver', 'message.id', 'message_receiver.message_id')->
                            count();
            if($total_user_included < 1){
                return Redirect('/admin/'.$this->data['objectName']);
            }

            //check if from inbox / sent
            $message_receiver_obj = $message_receiver::where('message_id', $message_id)->where('user_id', $this->data['adminInfo']['id'])->first();
            if($message_receiver_obj!=null){
                //make message is read
                $message_receiver_obj->is_read = 1;
                $message_receiver_obj->save();   
            } 

            //check if child or parent
            if($message->message_parent_id!=null){
                $message_id = $message->message_parent_id;
            }

            $this->data['messages'] = $this->model->
                    where(function ($query) use ($message_id){
                        $query->
                        where('message.id', $message_id)->
                        orWhere('message.message_parent_id', $message_id);
                    })->
                    join('admin', 'admin.id', 'message.admin_id')->
                    select('*', 'message.created_at as message_date')->
                    orderBy('message.id', 'asc')->
                    get();

            if($this->data['messages']==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
            }

            $this->data['message_id'] = $message_id;
            return view('admin/'.$this->data['objectName'].'/detail', $this->data);
        }else{
            return Redirect('/admin/'.$this->data['objectName']);
        }   
    }

    public function reply($message_id, Request $request){
        $this->data['adminInfo'] = $this->__getUserInfo();

        //validating data
        $checkMessage = $this->model->where('id', $message_id)->first();
        if($checkMessage==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
        }

        //insert data to model
        $message = new \App\Models\Message;
        $message->message_parent_id = $message_id;
        $message->admin_id = $this->data['adminInfo']['id'];
        $message->subject = 'Re: '.$checkMessage->subject;
        $message->body = $request->input('body');
        $message->message_receivers = $checkMessage->message_receivers;
        $message->is_active = 1;
        $message->is_deleted  = 0;

        //save model
        $message->save();

        //get last inserted id
        $inserted_message_id = $message->id;

        //insert message receiver
        //check if replier is original sender / not
        if($checkMessage->admin_id!=$this->data['adminInfo']['id']){
            $message_receiver_obj = new \App\Models\Message_Receiver;
            $message_receiver_obj->message_id = $inserted_message_id;
            $message_receiver_obj->user_id = $checkMessage->admin_id;
            $message_receiver_obj->is_read = 0;
            $message_receiver_obj->save();
        }   

        $message_receiver = new \App\Models\Message_Receiver;
        $receivers = $message_receiver::where('message_id', $message_id)->where('user_id', '!=', $this->data['adminInfo']['id'])->get();
        foreach($receivers as $receiver){
            $message_receiver_obj = new \App\Models\Message_Receiver;
            $message_receiver_obj->message_id = $inserted_message_id;
            $message_receiver_obj->user_id = $receiver->user_id;
            $message_receiver_obj->is_read = 0;
            $message_receiver_obj->save();
        }

        //trigget flash message
        Session::flash('message', "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully Reply message</div>");

        return Redirect('/admin/'.$this->data['objectName'].'/'.$message_id);
    }

    public function deleteProcess($id, $is_deleted){
        //validating data
        $obj = $this->model->where('id', $id)->first();
        if($obj==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
        }

        //insert data to model
        $obj->is_deleted = $is_deleted;

        //save model
        $obj->save();

        //trigger flash message
        if($is_deleted==1){
            $message = "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully delete ".$obj->name."</div>";
        }else{
            $message = "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully restore ".$obj->name."</div>";
        }
        Session::flash('message', $message);

        return Redirect::back();
    }

    public function deletePermanentProcess($id){
        //validating data
        $obj = $this->model->where('id', $id)->first();
        if($obj==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
        }

        //save model
        $obj->delete();

        //trigger flash message
        $message = "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully permanent delete on ".$obj->name."</div>";

        Session::flash('message', $message);

        return Redirect::back();
    }

    public function truncate(){
        //delete data
        $this->model->where('is_deleted', 1)->delete();

        //trigger flash message
        $message = "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Recycle bin is empty now</div>";

        Session::flash('message', $message);

        return Redirect::back();
    }
}
