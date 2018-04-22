<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

/* 
views in resources/views/admin/crud
*/

class ArticleController extends BaseController
{
    protected $model;
    protected $data;

    public function __construct(){
    	//authorize
        $this->middleware('cms_auth');

        //init model
        $this->model = new \App\Models\Article;
        $this->data['title'] = "Article";
        
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
        $this->data['objectName'] = 'article';

        $this->data['allowed_image_extension'] = $this->__getSettingValueByName('allowed_image_extension');
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
            	where('title', 'LIKE', "%".$this->data['keyword']."%")->
            	orWhere('summary', 'LIKE', "%".$this->data['keyword']."%");
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
        //processing image cover
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            //validate image
            $imageValidated = $this->__validateImage($image);
            if($imageValidated){
                $fileName = gmdate("d-m-y-H-i-s", time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/'.$this->data['objectName']);
                $image->move($destinationPath, $fileName);

                //insert data to model
                $is_active = $request->input('is_active')=="on" ? 1 : 0;
                $this->model->title = $request->input('title');
                $this->model->cover = $fileName;
                $this->model->summary = $request->input('summary');
                $this->model->body = $request->input('body');
                $this->model->tags = $request->input('tags');
                $this->model->is_active = $is_active;
                $this->model->is_deleted = 0;

                //save model
                $this->model->save();

                //trigger flash message
                Session::flash('message', '<div class="alert alert-primary">Successfully insert '.$this->model->title.'</div>');

                return Redirect('/admin/'.$this->data['objectName'].'/edit/'.$this->model->id);
            }else{
                //extension error

                //trigger flash message
                Session::flash('message', '<div class="alert alert-warning">Invalid image extension, allowed extension: '.$this->data['allowed_image_extension'].'</div>');
            }
        }else{
            //cover null
            //trigger flash message
            Session::flash('message', '<div class="alert alert-warning">Cover is required</div>');
        }

        return Redirect('/admin/'.$this->data['objectName'].'/add');
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

        //processing image cover
        $newImage = false;
        $fileName = '';
        $imageError = '';
        if ($request->hasFile('cover')) {
            $newImage = true;
            $image = $request->file('cover');
            //validate image
            $imageValidated = $this->__validateImage($image);
            if($imageValidated){
                $fileName = gmdate("d-m-y-H-i-s", time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/'.$this->data['objectName']);
                $image->move($destinationPath, $fileName);
            }else{
                $imageError = '<div class="alert alert-warning">Invalid image extension, allowed extension: '.$this->data['allowed_image_extension'].'</div>';
            }
        }else{
            $imageError = 'kosong';
        }

        $is_active = $request->input('is_active')=="on" ? 1 : 0;
        //insert data to model
        $obj->title = $request->input('title');
        if($newImage){
            if($imageError==''){
                $obj->cover = $fileName;
            }else{
                //trigget flash message
                Session::flash('message', $imageError);

                return Redirect('/admin/'.$this->data['objectName'].'/edit/'.$id);
            }           
        }
        $obj->summary = $request->input('summary');
        $obj->body = $request->input('body');
        $obj->tags = $request->input('tags');
        $obj->is_active = $is_active;

        //save model
        $obj->save();

        //trigget flash message
        Session::flash('message', '<div class="alert alert-primary">Successfully edit '.$obj->title.'</div>');

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
            $message = '<div class="alert alert-primary">Successfully delete '.$obj->title.'</div>';
        }else{
            $message = '<div class="alert alert-primary">Successfully restore '.$obj->title.'</div>';
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
        $message = '<div class="alert alert-primary">Successfully permanent delete on '.$obj->title.'</div>';

        Session::flash('message', $message);

        return Redirect::back();
    }

    public function truncate(){
        //delete data
        $this->model->where('is_deleted', 1)->delete();

        //trigger flash message
        $message = '<div class="alert alert-primary">Recycle bin is empty now</div>';

        Session::flash('message', $message);

        return Redirect::back();
    }
}
