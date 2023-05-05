<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function ShoppingCartRoute(Request $req)
    {
        if ($req->session()->has('UserId')) {
            $currentUserId = $req->session()->get('UserId');
            $order = Order::where('user_id', $currentUserId)->first();
            return view('pages/order/shopping-cart', [
                'order' => $order
            ]);
        } else {
            //cookies order tu bude
            $order = Order::where('user_id','25')->first();
            return view('pages/order/shopping-cart', [
                'order' => $order
            ]);
        }
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

    public function OrderRoute(Request $req)
    {
        if ($req->session()->has('UserId')) {
            $currentUserId = $req->session()->get('UserId');
            $order = Order::where('user_id', $currentUserId)->first();
            return view('pages/order/order', [
                'order' => $order
            ]);
        }
        else {
            //cookies order tu bude
            $order = Order::where('user_id','25')->first();
            return view('pages/order/order', [
                'order' => $order
            ]);
        }
    }

    public function CompleteOrder(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'street' => 'required',
            'streetNumber' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'deliveryType' => 'required',
            'paymentType' => 'required'
        ]);
        if ($req->session()->has('UserId')) {
            $currentUserId = $req->session()->get('UserId');
            $user_order = Order::where('user_id', $currentUserId)->first()->id;
            Log::debug($user_order);
            $order = Order::findOrFail($user_order);
        } else {
            //cookies order tu bude
            $order = Order::where('user_id','25')->first();
        }
        $order->user->first_name = $req->name;
        $order->user->last_name = $req->surname;
        $order->user->email = $req->email;
        $order->user->phone_num = $req->phone;
        $order->address->address_street = $req->street;
        $order->address->address_number = $req->streetNumber;
        $order->address->address_city = $req->city;
        $order->address->address_postcode = $req->postcode;
        $order->delivery = $req->deliveryType;
        $order->payment = $req->paymentType;
        $order->push();

        return view('pages/order/thank-you', [
            'order_id' => $order->id
        ]);
    }
}
