<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends BaseController
{
    protected $data;

    public function __construct(){
    	$this->middleware('cms_auth');

    	$this->data['title'] = "dashboard";
        $this->data['objectName'] = "home";

    }

    public function dashboard(){
    	$this->data['adminInfo'] = $this->__getUserInfo();
    	return view('admin/dashboard', $this->data);
    }

    public function getTotal(Request $request){
        $response = ['total' => 0, 'message' => ''];

        try{
            $db = $request->input('entity');

            $total = DB::table($db)->where('is_deleted', 0)->count();
            $response = ['total' => $total, 'message' => 'success'];
        }catch(\Exception $e){
            $response['message'] = $e->getMessage();
        }       

        return response()->json($response);
    }

    public function getLatestFeedback(){
        $contactUs = new \App\Models\ContactUs;

        $feedbackList = $contactUs->where('is_deleted', 0)->orderBy('id', 'desc')->limit(5)->get();

        return response()->json($feedbackList);
    }

    public function getUsersStatistic(){
        $response = ['active' => 0, 'deleted' => 0, 'unactive' => 0];

        $users = new \App\Models\User;

        $response['active'] = $users->where('is_deleted', 0)->where('is_active', 1)->count();
        $response['deleted'] = $users->where('is_deleted', 1)->count();
        $response['unactive'] = $users->where('is_deleted', 0)->where('is_active', 0)->count();

        return response()->json($response);
    }

    public function getFeedbackStatistic(){
        $month = $this->getMonthNameByNumber();
        $response = ['month' => ['January', 'February', 'March'], 'count' => [0,0,0]];

        try{
            $contactUs = new \App\Models\ContactUs;

            $latestMonth = $contactUs->orderBy('created_at', 'desc')->first()->created_at->month;
            $latestYear = $contactUs->orderBy('created_at', 'desc')->first()->created_at->year;

            $month0 = ($latestMonth-2 < 1 ? 12-abs(($latestMonth-2)) : $latestMonth-2);
            $month1 = ($latestMonth-1 < 1 ? 12-abs(($latestMonth-1)) : $latestMonth-1);
            $year0 = ($latestMonth-2 < 1 ? $latestYear-1 : $latestYear);
            $year1 = ($latestMonth-1 < 1 ? $latestYear-1 : $latestYear);

            $response['month'][0] = ($latestMonth-2 < 1 ? $month[$month0]." ".($latestYear-1) : ($month[$month0])." ".$latestYear);
            $response['month'][1] = ($latestMonth-1 < 1 ? $month[$month1]." ".($latestYear-1) : ($month[$month1])." ".$latestYear);
            $response['month'][2] = $month[$latestMonth]." ".$latestYear;

            $response['count'][0] = $contactUs->where('created_at', 'LIKE', '%'.$year0.'-'.str_pad($month0, 2, '0', STR_PAD_LEFT).'%')->where('is_deleted', 0)->count();
            $response['count'][1] = $contactUs->where('created_at', 'LIKE', '%'.$year1.'-'.str_pad($month1, 2, '0', STR_PAD_LEFT).'%')->where('is_deleted', 0)->count();
            $response['count'][2] = $contactUs->where('created_at', 'LIKE', '%'.$latestYear.'-'.str_pad($latestMonth, 2, '0', STR_PAD_LEFT).'-%')->where('is_deleted', 0)->count();
        }catch(\Exception $err){

        }      

        return response()->json($response);
    }

    public function getLatestUsers(){
        $users = new \App\Models\User;

        $userList = $users->where('is_deleted', 0)->orderBy('id', 'desc')->limit(3)->get();

        return response()->json($userList);
    }

    public function logout(Request $request){
    	$request->session()->forget('cms_admin_id');
    	$request->session()->forget('cms_admin_name');

    	return Redirect('/admin');
    }

    public function getMonthNameByNumber(){
        $month = [
            1 => "Jan",
            2 => "Feb",
            3 => "Mar",
            4 => "Apr",
            5 => "May",
            6 => "Jun",
            7 => "Jul",
            8 => "Aug",
            9 => "Sep",
            10 => "Oct",
            11 => "Nov",
            12 => "Dec"
        ];

        return $month;
    }
}
