<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public $model;
    public $data;

    public function __construct(){
        $this->model = new \App\Models\Article;

    	//constructor
    	$this->data['title'] = 'Articles';

    	/* folder in views  */
        $this->data['objectName'] = 'article';

        /*active menu*/
        $this->data['activeMenu'] = 'article';
    }

    public function index(){
        return view($this->data['objectName'].'/index', $this->data);
    }

    public function detail($id){
    	//validating article
    	$this->data['article'] = $this->model->
    							where('id', $id)->
    							where('is_deleted', 0)->
    							where('is_active', 1)->
    							first();
    	if($this->data['article']!=null){
    		//get related articles
    		if($this->data['article']->tags!="" && $this->data['article']->tags!=null){
    			$tags = explode(',', $this->data['article']->tags);
    			$this->data['article']['tagList'] = $tags;
    			$counter=1;
    			foreach($tags as $tag){
    				$this->data['tagList']['tag'.$counter] = $tag;
    				$counter++;
    			}
    		}

    		$this->data['related_articles'] = $this->model->
					where('is_deleted', 0)->
					where('is_active', 1)->
					where('id', '!=', $this->data['article']->id)->
					where(function($query){
						$counter = 1;
						foreach($this->data['tagList'] as $tag){
							if($counter==1){
								$query->
			                	where('tags', 'LIKE', "%".$this->data['tagList']['tag'.$counter]."%");
							}else{
								$query->
			                	orWhere('tags', 'LIKE', "%".$this->data['tagList']['tag'.$counter]."%");
							}
							
			                $counter++;
						}
		            })->orderBy('updated_at', 'desc')->limit(3)->get();

    		return view($this->data['objectName'].'/detail', $this->data);
    	}else{
    		return Redirect();
    	}
    }

    public function getArticles(Request $request){
    	$response = ['articles' => [], 'total_results'=>0, 'page' => 1, 'total_page' => 0];

        try{
        	//init variabels
        	$keyword = '';
        	$page = 1;
        	$skip = 0;
        	$take = 6;
        	$total_page = 0;

        	//pagination
        	if($request->input('page')!=null){
        		$page = (int)$request->input('page');     		
        	}
        	$skip = ($page-1)*$take;

        	//search
        	if($request->input('keyword')!=null){
        		$keyword = $request->input('keyword');     		
        	}
        	$this->data['keyword'] = $keyword;

        	//articles get query
            $articles = $this->model->
            			where('is_deleted', 0)->
            			where(function($query){
			                $query->
			                where('title', 'LIKE', "%".$this->data['keyword']."%")->
			                orWhere('tags', 'LIKE', "%".$this->data['keyword']."%")->
			                orWhere('summary', 'LIKE', "%".$this->data['keyword']."%");
			            })->
            			orderBy('id', 'desc')->
            			skip($skip)->take($take)->
            			get();

            //total results
            $total_results = $this->model->
            			where('is_deleted', 0)->
            			where(function($query){
			                $query->
			                where('title', 'LIKE', "%".$this->data['keyword']."%")->
			                orWhere('tags', 'LIKE', "%".$this->data['keyword']."%")->
			                orWhere('summary', 'LIKE', "%".$this->data['keyword']."%");
			            })->
            			count();

            //total page
            $total_page = ceil($total_results/$take);

            //on result
            $on_result = $skip + $articles->count();

            //init responses
            $response = ['articles' => $articles, 'on_result' => $on_result, 'total_results'=>$total_results, 'page' => $page, 'total_page' => $total_page, 'keyword'=>$this->data['keyword']];
        }catch(\Exception $e){
            $response['message'] = $e->getMessage();
        }       

        return response()->json($response);
    }
}
