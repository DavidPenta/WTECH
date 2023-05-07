<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;


class UserAuthController extends Controller
{
    public function login()
    {
        return view('pages/user-auth/log-in');
    }

    public function registration()
    {
        return view('pages/user-auth/registration');

    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:User',
            'password_1' => 'required|min:5|max:50',
            'password_2' => 'required|min:5|max:50|same:password_1',
        ]);

        if ($request->street != null || $request->street_number != null || $request->city != null || $request->postcode != null) {
            $address = new Address;
            $address->address_street = $request->street;
            $address->address_number = $request->street_number;
            $address->address_city = $request->city;
            $address->address_postcode = $request->postcode;
            $res_address = $address->save();
        } else {
            $res_address = true;
        }

        if ($res_address) {
            $user = new User;
            $user->email = $request->email;
            $user->role = 'user';
            $user->first_name = $request->name;
            $user->last_name = $request->surname;
            $user->password_hash = hash('sha512', $request->password_1);
            $user->phone_num = $request->phone;
            if (isset($address)) {
                $user->address_id = $address->id;
            }
            $res = $user->save();
            if ($res) {
                return view('pages/user-auth/log-in')->with('success', 'Boli ste úspešne zaregistrovaný.');
            }
        }
        return back()->with('fail', 'Niekde nastala chyba.');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'user_email' => 'required',
            'user_password' => 'required',
        ]);
        $user = User::where('email', '=', $request->user_email)->first();
        if ($user) {
            if (hash('sha512', $request->user_password) == $user->password_hash)
            {
                $request->session()->put('UserId', $user->id);
                if ($user->role == 'admin') {
                    $request->session()->put('AdminId', $user->id);

                }
                return redirect('/');
            }
            else
            {
                return back()->with('fail', 'Nesprávne heslo.')->with('user_email', $request->user_email);
            }
        }
        else
        {
            return back()->with('fail', 'Nesprávny email.')->with('user_email', $request->user_email);
        }
    }

    public function logoutUser(Request $request)
    {
        if ($request->session()->has('UserId')) {
            $request->session()->pull('UserId');
            $request->session()->pull('AdminId');
            return redirect('/');
        }
        return back();
    }
}
