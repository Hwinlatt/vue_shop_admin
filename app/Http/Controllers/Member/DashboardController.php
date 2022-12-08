<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('member_id',Auth::user()->id)->whereDate('created_at',Carbon::today())
        ->where('status','success')->get();
        $p_order = Order::where('member_id',Auth::user()->id)->where('status','pending')->count();
        $deli_order = Order::where('member_id',Auth::user()->id)->where('status','delivered')->count();
        $today_sale_price = 0;
        $today_sale_order = count($orders->toArray());
        foreach ($orders as $order) {
            foreach ($order->order_items as $item) {
                $today_sale_price += $item->price * $item->qty;
            }
        }
        return view('dashboard',compact('today_sale_price','today_sale_order','p_order','deli_order'));

    }
}
