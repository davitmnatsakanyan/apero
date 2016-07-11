<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Guest;
use App\Http\Controllers\PaypalController;
use Auth,View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $requset)
    {

//        $this->validate($requset,[
//
//        ]);

        if(auth()->user->check())
            $this->userOreder($requset);
        $this->guetsOrder($requset);
    }


    public function userOrder($request)
    {
        if($request->payment_type !=  1)
        {
            //gnaci paypal het eka
        }

        $data['user_id'] = auth()->user->id();
        $data['status'] = 0;  //status = Idle
        $data = $request;
        $order = Order::create($data);
        $this->store_order_products($order->id,$request->products);
    }

    public function store_order_products($order_id,$products)
    {
        foreach($products as $product)
        {
            $price = Product::first($product['id'])->price;
            OrderProduct::create([
                'order_id' => $order_id,
                'product_id' => $product ['id'],
                'amount' => $product ['count'],
                'price' =>  $product ['count']*$price,
            ]);
        }

    }


    public function orderGuest($request)
    {
        if($request->payment_type !=  1)
        {
            //gnaci paypal het eka
        }
        $guest = $this->createGuestIfNotExists($request);
        $data ['user_id'] = $guest->id;
        $data['status'] = 0;  //status = Idle
        $data = $request;
        $order = Order::create($data);
        $this->store_order_products($order->id,$request->products);
    }


    public function createGuestIfNOtExists($request)
    {
        $guest = Guest::where('email','mal@gmail.com')->first();
        if(is_null($guest)) {
            $data = $request->except('_token');
            $data['rememberd_token'] = $request->_token;
            $guest = Guest::create($data);
        }

        return $guest;
    }
}



