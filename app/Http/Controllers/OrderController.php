<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Guest;
use App\Models\Order;
use App\Http\Controllers\PaypalController;
use Auth,View;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = Auth::guard('user');
    }

    public function index(Request $request)
    {
        if ($request->is_accepted)
            if ($this->user->check())
                $this->userOreder($request);
        $this->guestOrder($request);

       return response()->json(['success' => 0]);
    }


    public function userOrder($request)
    {
        if ($request->payment_type == 'paypal') {
            //gnaci paypal het eka
        }

        $data['user_id'] = $this->user->id();
        $data['status'] = 0;  //status = Idle
        $data = $request;
        $order = Order::create($data);
        $this->store_order_products($order->id, $request->products);

        return response()->json(['success' => 1]);
    }

    public function store_order_products($order_id, $products)
    {
        foreach ($products as $product) {
            OrderProduct::create([
                'order_id' => $order_id,
                'product_id' => $product ['id'],
                'amount' => $product ['count'],
                'price' => $product ['count'] * $product ['price'],
            ]);
        }

    }


    public function guestOrder($request)
    {
        if ($request->payment_type == 'paypal') {
            //gnaci paypal het eka
        }
        $guest = $this->createGuestIfNotExists($request);
        $data ['user_id'] = $guest->id;
        $data['status'] = 0;  //status = Idle
        $data = $request;
        $order = Order::create($data);
        $this->store_order_products($order->id, $request->products);
        return response()->json(['success' => 1]);
    }


    public function createGuestIfNOtExists($request)
    {
        $guest = Guest::where('email', $request->email)->first();
        if (is_null($guest)) {
            $data['company'] = $request->name;
            $data['address'] = $request->delivery_address;
            $data['zip'] = $request->delivery_zip;
            $data['city'] = $request->delivery_city;
            $data['country'] = $request->delivery_country;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['phone'] = $request->phone;
            $data['remember_token'] = $request->_token;
            $guest = Guest::create($data);
        }

        return $guest;
    }
}



