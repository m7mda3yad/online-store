<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function index()
    {
        return view('delivery.dashboard');
    }
    public function profile()
    {
        return view('delivery.profile');
    }
    public function assign()
    {
        $orders = \Auth::guard('delivery')->user()->orders->where('delivery_type',0);
        return view('delivery.orders',compact('orders'));
    }
    public function delivered()
    {
        $orders = \Auth::guard('delivery')->user()->orders->where('delivery_type',1);
        return view('delivery.orders',compact('orders'));
    }
    public function cancelled()
    {
        $orders = \Auth::guard('delivery')->user()->orders->where('delivery_type',3);
        return view('delivery.orders',compact('orders'));
    }

}


