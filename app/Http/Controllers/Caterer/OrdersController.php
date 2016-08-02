<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use Illuminate\Http\Request;
use App\Models\Subproduct;
use App\Models\Order;

class OrdersController extends CatererBaseController
{
    /**
     * Show Dashboard default page
     *
     * @return view
     */

    public function getIndex()
    {
        $orders = Order::with('products')->where('caterer_id', $this->caterer->id())->get();
        foreach ($orders as $key => $order) {
            foreach ($order->products as $key2 => $product)
                if ($product->pivot->subproduct_id !== 0)
                    $orders[$key]->products[$key2]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);
        }

        return response()->json(['success' => 1, 'orders' => $orders->toArray(), 'caterer' => $this->caterer->user()]);
//        return view('caterer/order/index' ,compact('orders'));
    }


    public function changeStatus(Request $request)
    {
        if (!$this->hasAccess($request->order_id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

            $order = Order::findOrFail($request->order_id);
            $order->update(['status' => $request->status['name']]);
            return response()->json(['success' => 1, 'message' => 'Order status changed succrssfully']);


    }

    public function getShow($id)
    {
        if (!$this->hasAccess($id))
            return response()->json(['success' => 0, 'error' => "Something went wrong."]);

            $order = Order::with('products', 'packages', 'user')->findOrFail($id);
            foreach ($order->products as $key => $product)
                if ($product->pivot->subproduct_id !== 0)
                    $order->products[$key]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);

            return response()->json(['success' => 1, 'order' => $order->toArray()]);
//            return view('caterer/order/order', compact('order'));


    }

    public function getAccept($order_id)
    {
        if (!$this->hasAccess($order_id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

            $order = Order::findOrFail($order_id);
            $order->update(['status' => 'Idle']);
            return response()->json(['success' => 1, 'message' => 'Order accepted.']);

    }



    public function hasAccess($id)
    {
        return Order::findOrFail($id)->caterer_id == $this->caterer->id();
    }


}
