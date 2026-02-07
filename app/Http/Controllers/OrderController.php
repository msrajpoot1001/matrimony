<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('product')->latest()->paginate(10);
        return view('dashboard.pages.admin.orders.index', compact('orders'));

    }
}
