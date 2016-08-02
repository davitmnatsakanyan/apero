<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Controllers\User\UserBaseController;
use App\Models\Product;
use App\Models\OrderPackage;
use App\Models\Subproduct;
use Auth, View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends UserBaseController
{

    public function index(Request $request)
    {
//        dd($request->all());
        if ($request->is_accepted) {
            if ($this->user->check())
              return   $this->userOrder($request);
            else
            return $this->guestOrder($request);
        }
        else
        return response()->json(['success' => 0]);
    }


    public function userOrder($request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id();
        $data['caterer_id'] = $request->orders['products'][0]['caterer_id'];
        $data['status'] = 'Not Accepted';
        $data ['total_cost'] = $this->count_total_cost($request->orders);
        $data ['delivery_time'] = Carbon::now(); //$request->delivery_time;
        $data ['is_user_order'] = 1;
        $order = Order::create($data);
        $this->store_order_products($order->id, $request->orders);
        return response()->json(['success' => 1]);
    }

    public function store_order_products($order_id, $orders )
    {
        $products = $orders['products'];
        $packages = $orders['packages'];
        foreach ($products as $product) {
            $data = [
                'order_id' => $order_id,
                'product_id' => $product ['id'],
                'amount' => $product ['count'],
                'price' => $product ['count'] * $product ['price'],
            ];

            $data['description'] =  isset($product['description']) ? $product['description'] : "";

            $data['subproduct_id'] =  isset($product['sub_id']) ? $product['sub_id'] : 0;

            OrderProduct::create($data);
        }
        
        foreach($packages as $package)
        {
            $data = [
                'order_id' => $order_id,
                'package_id' => $package ['id'],
                'amount' => $package ['count'],
                'price' => $package ['count'] * $package ['price'],
            ];

            OrderPackage::create($data);
        }
    }


    public function guestOrder($request)
    {
        
        $guest = $this->createGuestIfNotExists($request);
        $data = $request->except('products');
        $data ['user_id'] = $guest->id;
        $data['status'] = 0;  //status = Idle
        $data['caterer_id'] = $request->products[0]['caterer_id'];
        $data ['total_cost'] = $this->count_total_cost($request->orders);
        $data ['delivery_time'] = Carbon::now(); //$request->delivery_time;
        $data ['is_user_order'] = 0;
        $order = Order::create($data);
        $this->store_order_products($order->id, $request->orders);
        return response()->json(['success' => 1]);
    }


    public function createGuestIfNOtExists($request)
    {
        $guest = User::where('email', $request->email)->first();
        if (is_null($guest)) {
            $data['name'] = $request->company;
            $data['address'] = $request->delivery_address;
            $data['zip'] = $request->delivery_zip;
            $data['city'] = $request->delivery_city;
            $data['country'] = $request->delivery_country;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['phone'] = $request->phone;
            $data ['is_user'] = 0;
            $data['remember_token'] = $request->_token;
            $guest = User::create($data);
        }

        return $guest;
    }

    public function count_total_cost($orders)
    {
        $total = 0;
        $products = $orders['products'];
        $packages = $orders['packages'];
        foreach ($products as $key => $product) 
        {
            $price = isset($product['sub_id']) ? Subproduct::findOrFail($product ['sub_id'])->price : Product::findOrFail($product ['id'])->price;
            $total += $price * $product ['count'];
        }

        foreach($packages as $package)
        {
            $price = Package::findOrFail($package['id'])->price;
            $total+=$price * $package ['count'];
        }

        return $total;
    }
}



