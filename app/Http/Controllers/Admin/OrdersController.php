<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Subproduct;
use App\Models\Order;

class OrdersController extends AdminBaseController
{
    /**
     * Show Dashboard default page
     *
     * @return view
     */

    public function getIndex()
    {
        $orders = Order::with('products','caterer')->get();
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

        return view('admin/order/index' ,compact('orders'));
    }


    public function changeStatus(Request $request)
    {
        Order::findOrFail($request->order_id)->update(['status' =>$request->status]);
        return back()->with('success' , 'Product status changed succrssfully');
    }




}
