<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function ShoppingCartRoute()
    {
        //$currentUserId = Auth::id();
        //$order = Order::where('user_id',$currentUserId);
        $order = Order::where('user_id','1');
        return view('pages/order/shopping-cart', [
            'order' => $order->first()
        ]);
    }

    public function ProductCount(Request $req, $id)
    {
        $req->validate([
            'quantity' => ['required', 'integer', 'min:0'],
        ]);
        $productCount = OrderProduct::find($id);
        $productCount->quantity = $req->quantity;
        $productCount->save();
        return redirect('shopping-cart');
    }

    public function DeleteProduct(Request $req, $id)
    {
        $productCount = OrderProduct::find($id);
        $productCount->delete();
        return redirect('shopping-cart');
    }
}
