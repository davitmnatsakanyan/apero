<?php

namespace App\Http\Controllers\User;

use App\Models\Guest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Subproduct;
use Auth, View;
use Illuminate\Http\Request;

class OrderController extends UserBaseController
{

    public function index(Request $request)
    {

        if ($request->is_accepted) {
            if ($this->user->check())
                $this->userOrder($request);
            $this->guestOrder($request);
        }

        return response()->json(['success' => 0]);
    }


    public function userOrder($request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id();
        $data['caterer_id'] = $request->products[0]['caterer_id'];
        $data['status'] = 0;  //status = Idle
        $data ['total_cost'] = $this->count_total_cost($request->products);
        $order = Order::create($data);
        $this->store_order_products($order->id, $request->products);
        dd(22);
        return response()->json(['success' => 1]);
    }

    public function store_order_products($order_id, $products)
    {
        foreach ($products as $product) {
            $data = [
                'order_id' => $order_id,
                'product_id' => $product ['id'],
                'amount' => $product ['count'],
                'price' => $product ['count'] * $product ['price'],
            ];
            if (isset($product['sub_id'])) {
                $data ['subproduct_id'] = $product['sub_id'];
                $data ['description'] = $products ['description'];
            } else {
                $data ['sub_id'] = 0;
            }

            OrderProduct::create($data);
        }
    }


    public function guestOrder($request)
    {
        $guest = $this->createGuestIfNotExists($request);
        $data = $request->except('products');
        $data ['user_id'] = $guest->id;
        $data['status'] = 0;  //status = Idle
        $data['caterer_id'] = $request->products[0]['caterer_id'];
        $data ['total_cost'] = $this->count_total_cost($request->products);
        $order = Order::create($data);
        $this->store_order_products($order->id, $request->products);
        return response()->json(['success' => 1]);
    }


    public function createGuestIfNOtExists($request)
    {
        $guest = Guest::where('email', $request->email)->first();
        if (is_null($guest)) {
            $data['company'] = $request->company;
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

    public function count_total_cost($products)
    {
        dd($products);
        $total = 0;
        foreach ($products as $product) {
            if (isset($product['sub_id']))
                $price = Subproduct::findOrFail($product ['product_id'])->price;
            else
                $price = Product::findOrFail($product ['product_id'])->price;
            $total += $price * $product ['count'];
        }

        return $total;
    }
}



