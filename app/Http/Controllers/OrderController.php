<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function getOrder(){
        return Order::all();
    }
}
