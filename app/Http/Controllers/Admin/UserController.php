<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

class UserController extends BaseController
{
    protected $model;
    protected $data;

    public function __construct(){
        $this->middleware('cms_auth');

        $this->model = new \App\Models\User;
        $this->data['title'] = "Users";

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
        $this->data['objectName'] = 'user';
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
                where('name', 'LIKE', "%".$this->data['keyword']."%")->
                orWhere('email', 'LIKE', "%".$this->data['keyword']."%");
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
        $this->data['obj']['name'] = '';
        $this->data['obj']['email'] = '';
        $this->data['obj']['address'] = '';
        $this->data['obj']['phone_number'] = '';
        return view('admin/'.$this->data['objectName'].'/add', $this->data);
    }

    public function addProcess(Request $request){
        $this->data['adminInfo'] = $this->__getUserInfo();
        $this->data['obj'] = [];

        $this->data['obj']['name'] = $request->input('name');
        $this->data['obj']['email'] = $request->input('email');
        $this->data['obj']['address'] = $request->input('address');
        $this->data['obj']['phone_number'] = $request->input('phone_number');

        //process data
        $is_active = $request->input('is_active')=="on" ? 1 : 0;

        $checkObj = $this->model->where('email', $request->input('email'))->count();
        if($checkObj > 0){
            Session::flash('message', "<div class='alert alert-warning'>Email already taken ".$this->model->name."</div>");
            //already taken
            return view('admin/'.$this->data['objectName'].'/add', $this->data);
        }else{
            //insert data to model
            $this->model->name = $this->data['obj']['name'];
            $this->model->email = $this->data['obj']['email'];
            $this->model->password = sha1($request->input('password'));
            $this->model->address = $this->data['obj']['address'];
            $this->model->phone_number = $this->data['obj']['phone_number'];
            $this->model->is_active = $is_active;
            $this->model->is_deleted = 0;

            //save model
            $this->model->save();

            //trigger flash message
            Session::flash('message', "<div class='alert alert-primary'>Successfully insert ".$this->model->name."</div>");

            return Redirect('/admin/'.$this->data['objectName'].'/edit/'.$this->model->id);
        }       
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
        $this->data['user_default_password'] = $this->__getSettingValueByName('user_default_password');
        if($this->data['user_default_password']==null){
            $this->data['user_default_password'] = "123456";
        }

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

        //check email
        $checkEmail = $this->model->where('email', $request->input('email'))->where('email', '!=', $obj->email)->count();
        if($checkEmail > 0){
            //trigget flash message
            Session::flash('message', "<div class='alert alert-warning'>Email: ".$request->input('email')." already taken</div>");
        }else{
            //insert data to model
            $obj->name = $request->input('name');
            $obj->email = $request->input('email');
            $obj->address = $request->input('address');
            $obj->phone_number = $request->input('phone_number');
            $obj->is_active = $is_active;

            //save model
            $obj->save();

            //trigget flash message
            Session::flash('message', "<div class='alert alert-primary'>Successfully edit ".$obj->name."</div>");
        }

        

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
            $message = "<div class='alert alert-primary'>Successfully delete ".$obj->name."</div>";
        }else{
            $message = "<div class='alert alert-primary'>Successfully restore ".$obj->name."</div>";
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
        $message = "<div class='alert alert-primary'>Successfully permanent delete on ".$obj->name."</div>";

        Session::flash('message', $message);

        return Redirect::back();
    }

    public function truncate(){
        //delete data
        $this->model->where('is_deleted', 1)->delete();

        //trigger flash message
        $message = "<div class='alert alert-primary'>Recycle bin is empty now</div>";

        Session::flash('message', $message);

        return Redirect::back();
    }

    public function resetPassword($id){
        //check if user exist
        $user = $this->model->where('id', $id)->first();
        if($user!=null){
            //get default password
            $user_default_password = $this->__getSettingValueByName('user_default_password');
            if($user_default_password==null){
                $user_default_password = "123456";
            }

            //update user password
            $user->password = sha1($user_default_password);
            $user->save();

            Session::flash('message', "<div class='alert alert-primary'>Password has been reset to ".$user_default_password."</div>");
            return Redirect('/admin/'.$this->data['objectName'].'/edit/'.$user->id);
        }else{
            Session::flash('message', "<div class='alert alert-danger'>user did not exist!");
            return Redirect('/admin/'.$this->data['objectName']);
        }
    }
}
