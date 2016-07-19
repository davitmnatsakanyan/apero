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
        $orders = Order::with('products')->where('caterer_id' ,$this->caterer->id())->get();
        foreach ($orders as $key =>$order) {
            switch ($order['status']) {
                case 0:
                    $orders[$key]['status'] = 'Idle';
                    break;
                case 1:
                    $orders[$key]['status'] = 'Processing';
                    break;
                case 2:
                    $orders[$key]['status'] = 'Shipping';
                    break;
                case 3:
                    $orders[$key]['status'] = 'Complete';
                    break;
                case 4:
                    $orders[$key]['status'] = 'Deleted';
                    break;
                case 4:
                    $orders[$key]['status'] = 'Denied';
                    break;
            };

            foreach($order->products as $key2 => $product)
                if($product->pivot->subproduct_id !== 0)
                   $orders[$key]->products[$key2]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);
        }

        return view('caterer/order/index' ,compact('orders'));
    }
    
    
    public function changeStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        if( $order->caterer_id == $this->caterer->id() ) {
            $order->update(['status' => $request->status]);
            return back()->with('success', 'Order status changed succrssfully');
        }

        return back();
    }




}
