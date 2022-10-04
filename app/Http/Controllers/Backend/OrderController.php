<?php

namespace App\Http\Controllers\Backend;

use App\Order;
use App\Pay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user','pay')->where('user_id',Auth::id())->orderBy('id','DESC')->paginate(10);
//        dd($orders->pay);
        return view('admin.orders.index', compact(['orders']));
    }
    public function getOrderLists($id){
        $order = Order::with('user.addresses.province', 'user.addresses.city', 'products.photos')->whereId($id)->first();
        return view('admin.orders.lists', compact(['order']));
    }

    public function payments()
    {
        $payments = Pay::orderBy('id','DESC')->paginate('15');
        return view('admin.orders.payments', compact(['payments']));

    }

}
