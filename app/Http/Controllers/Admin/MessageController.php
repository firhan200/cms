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

        return view('admin/'.$this->data['objectName'].'/list', $this->data);
    }

    public function add(){
        $this->data['adminInfo'] = $this->__getUserInfo();
        return view('admin/'.$this->data['objectName'].'/add', $this->data);
    }

    public function addProcess(Request $request){
        //process data
        $is_active = $request->input('is_active')=="on" ? 1 : 0;

        //insert data to model
        $this->model->name = $request->input('name');
        $this->model->value = $request->input('value');
        $this->model->is_active = $is_active;
        $this->model->is_deleted = 0;

        //save model
        $this->model->save();

        //trigger flash message
        Session::flash('message', "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully insert ".$this->model->name."</div>");

        return Redirect('/admin/'.$this->data['objectName'].'/edit/'.$this->model->id);
    }

    public function detail($id){
        $this->data['adminInfo'] = $this->__getUserInfo();

        //validating data 
        $this->data['obj'] = $this->model->where('id', $id)->first();
        if($this->data['obj']==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
        }

        return view('admin/'.$this->data['objectName'].'/detail', $this->data);
    }

    public function edit($id){
        $this->data['adminInfo'] = $this->__getUserInfo();

        //validating data
        $this->data['obj'] = $this->model->where('id', $id)->first();
        if($this->data['obj']==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
        }

        return view('admin/'.$this->data['objectName'].'/edit', $this->data);
    }

    public function editProcess(Request $request){
        //validating data
        $id = $request->input('id');
        $obj = $this->model->where('id', $id)->first();
        if($obj==null){
            //not found
            return Redirect('/admin/'.$this->data['objectName']);
        }

        $is_active = $request->input('is_active')=="on" ? 1 : 0;
        //insert data to model
        $obj->name = $request->input('name');
        $obj->value = $request->input('value');
        $obj->is_active = $is_active;

        //save model
        $obj->save();

        //trigget flash message
        Session::flash('message', "<div class='alert alert-primary'><i class='fa fa-check-circle'></i> Successfully edit ".$obj->name."</div>");

        return Redirect('/admin/'.$this->data['objectName'].'/edit/'.$id);
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
