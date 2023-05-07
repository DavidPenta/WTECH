<?php

namespace App\Http\Controllers;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Address as Adresa;
use App\Models\OrderProduct;

class ProductMock {
    public $id;
    public $name;
    public $author;
    public $price;
    public $quantity;
    public $img;
}

class OrderController extends Controller
{
    public function SerializeShoppingCartCookie(array $value)
    {
        $results = [];
        foreach ($value as $bookId => $bookCount)
        {
            array_push($results, $bookId.'='.$bookCount);
        }
        $result = implode(';', $results);
        return $result;
    }

    public function DeserializeShoppingCartCookie(string $value)
    {
        $result = [];
        if ($value == '')
        {
            return $result;
        }
        $books = explode(';', $value);
        foreach ($books as $bookData)
        {
            $idAndCount = explode('=', $bookData);
            $bookId = $idAndCount[0];
            $bookCount = $idAndCount[1];
            $result[$bookId] = $bookCount;
        }
        return $result;
    }

    public function CalculateValue(Order $order)
    {
        $suma = 0;
        foreach($order->orderProducts as $orderProduct) {
            $suma += $orderProduct->product->price * $orderProduct->quantity;
        }
        $order->value = $suma;
        $order->save();
    }

    public function ShoppingCartRoute(Request $req)
    {
        if ($req->session()->has('UserId')) {
            $currentUserId = $req->session()->get('UserId');
            $user_order = Order::where('user_id', $currentUserId)->where('state', 'draft')->first();
            if(is_null($user_order)) {
                return view('pages/order/shopping-cart', [
                    'order' => null,
                    'value' => null
                ]);
            }
            $order = Order::findOrFail($user_order->id);
            $this->CalculateValue($order);
            return view('pages/order/shopping-cart', [
                'order' => $order,
                'value' => null
            ]);
        } else {
            $shoppingCartFromCookies = $req->session()->has('ShoppingCart') ? $req->session()->get('ShoppingCart') : '';
            $shoppingCart = self::DeserializeShoppingCartCookie($shoppingCartFromCookies);
            $value = 0;
            $products = [];
            foreach($shoppingCart as $product_id=>$quantity) {
                $book = Product::find($product_id);
                $value += $book->price * $quantity;

                $product = new ProductMock;
                $product->id = $product_id;
                $product->name = $book->name;
                $product->author = $book->author;
                $product->price = $book->price;
                $product->quantity = $quantity;
                $product->img = $book->images->where('type', '=', 'main')->first()->path;
                array_push($products, $product);
            }

            $req->session()->put('CartValue', $value);
            return view('pages/order/shopping-cart', [
                'order' => $products,
                'value' => $value
            ]);
        }

    }

    public function ProductCount(Request $req, $id)
    {
        $req->validate([
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        if ($req->session()->has('UserId')) {
            $productCount = OrderProduct::find($id);
            $productCount->quantity = $req->quantity;
            $productCount->save();
        } else {
            $shoppingCartFromCookies = $req->session()->has('ShoppingCart') ? $req->session()->get('ShoppingCart') : '';
            $shoppingCart = self::DeserializeShoppingCartCookie($shoppingCartFromCookies);
            $shoppingCart[$id] = $req->quantity;
            $shoppingCartSerialized = self::SerializeShoppingCartCookie($shoppingCart);
            $req->session()->put('ShoppingCart', $shoppingCartSerialized);
        }
        return redirect('shopping-cart');
    }

    public function DeleteProduct(Request $req, $id)
    {
        if ($req->session()->has('UserId')) {
            $productCount = OrderProduct::find($id);
            $productCount->delete();
        } else {
            $shoppingCartFromCookies = $req->session()->has('ShoppingCart') ? $req->session()->get('ShoppingCart') : '';
            $shoppingCart = self::DeserializeShoppingCartCookie($shoppingCartFromCookies);
            unset($shoppingCart[$id]);
            $shoppingCartSerialized = self::SerializeShoppingCartCookie($shoppingCart);
            $req->session()->put('ShoppingCart', $shoppingCartSerialized);
        }
        return redirect('shopping-cart');
    }

    public function OrderRoute(Request $req)
    {
        if ($req->session()->has('UserId')) {
            $currentUserId = $req->session()->get('UserId');
            $order = Order::where('user_id', $currentUserId)->first();
            return view('pages/order/order', [
                'order' => $order,
                'value' => null
            ]);
        } else {
            $value = $req->session()->get('CartValue');
            return view('pages/order/order', [
                'order' => null,
                'value' => $value
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
            $order = Order::findOrFail($user_order);

            $order->user->first_name = $req->name;
            $order->user->last_name = $req->surname;
            $order->user->email = $req->email;
            $order->user->phone_num = $req->phone;
            $order->address->address_street = $req->street;
            $order->address->address_number = $req->streetNumber;
            $order->address->address_city = $req->city;
            $order->address->address_postcode = $req->postcode;

        } else {
            $order = new Order;
            $order->value = $req->session()->get('CartValue');

            $user = new User;
            $user->first_name = $req->name;
            $user->last_name = $req->surname;
            $user->phone_num = $req->phone;
            $user->role = 'user';
            $user->save();

            $address = new Adresa;
            $address->address_street = $req->street;
            $address->address_number = $req->streetNumber;
            $address->address_city = $req->city;
            $address->address_postcode = $req->postcode;
            $address->save();

            $order->user_id = $user->id;
            $order->address_id = $address->id;

            $req->session()->forget('CartValue');
            $req->session()->forget('ShoppingCart');

        }
        $order->delivery = $req->deliveryType;
        $order->payment = $req->paymentType;
        if($req->deliveryType == 'Doručenie na adresu')
        {
            $order->value += 3.99;
        }
        $order->state = 'completed';
        $order->push();

        return view('pages/order/thank-you', [
            'order_id' => $order->id
        ]);
    }
}
