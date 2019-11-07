<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function getOrders(Request $request){
        $myDate=$request['filter_by_date'];
        $myMonth=$request['filter_by_month'];

        if($myDate){
            $today=date("Y-m-d", strtotime($myDate));
        }elseif($myMonth){
            $today=$request['filter_by_month'];
        }
        else{
            $today=date("Y-m-d");
        }
        $orders=Order::where('created_at', "LIKE", "%$today%")
            ->OrderBy('id','desc')
            ->get();
        return view ('posts.orders')->with(['orders'=>$orders]);
    }
}
