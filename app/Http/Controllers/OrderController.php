<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getOrder(): Collection {
//        return Order::all();
        return DB::table('orders')
            ->get();
    }

    public function completeOrders() {
        DB::table('orders')
            ->where('completion', '=', '1')
            ->get();
    }

    public function uncompleteOrders() {
        DB::table('orders')
            ->where('completion', '=', '0')
            ->get();
    }

    public function testF(Request $request) {
        DB::table('orders')
            ->select('*')
            ->where('client_name','=', $request->input('client_name'))
            ->get();
    }
}
