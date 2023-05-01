<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function ShoppingCartRoute(Request $req)
    {
        //$currentUserId = Auth::id();
        //$order = Order::where('user_id',$currentUserId);
        $order = Order::where('user_id','1');
        return view('pages/order/shopping-cart', [
            'order' => $order->first()
        ]);
    }

    public function ProductCount(Request $req)
    {

    }
}
