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
        $orders = Order::with('products','caterer')->paginate(15);
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
        }


        return view('admin/order/index' ,compact('orders'));
    }

    public function getShow($id)
    {
        $order = Order::with('products','packages','caterer','user')->findOrFail($id);
            switch ($order['status']) {
                case 0:
                    $order['status'] = 'Idle';
                    break;
                case 1:
                    $order['status'] = 'Processing';
                    break;
                case 2:
                    $order['status'] = 'Shipping';
                    break;
                case 3:
                    $order['status'] = 'Complete';
                    break;
                case 4:
                    $order['status'] = 'Deleted';
                    break;
                case 4:
                    $order['status'] = 'Denied';
                    break;
            };
            foreach($order->products as $key => $product)
                if($product->pivot->subproduct_id !== 0)
                    $order->products[$key]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);

//        return $order;
        return view('admin/order/show' ,compact('order'));
    }


    public function postChangeStatus(Request $request)
    {
        dd($request->all());
        dd($request->status);
        Order::findOrFail($request->order_id)->update(['status' =>$request->status]);
        return back()->with('success' , 'Product status changed succrssfully');
    }

    public function getBlock($id)
    {
        if(Order::destroy($id)) {

           Order::withTrashed()->findOrFail($id)->update(['admin_id' => $this->admin->id()]);

            return redirect('admin/orders/blocked')->with(['success' => "Order sucsessfully blocked"]);
        }

        return back()->withErrors('Something went wrong');

    }

    public function getActivate($id)
    {
        if(Order::withTrashed()->with('admin')->where('id', $id)->restore()) {
            Order::findOrFail($id)->update(['admin_id' => NULL]);
            return redirect('admin/orders/blocked')->with(['success' =>'Order Successfully activated.']);
        }
        return  back()->withErrors('Something went wrong');
    }

    public function getBlockedOrders()
    {
        $orders = Order::onlyTrashed()->paginate(15);

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
        }

        return view('admin/order/blocked' ,compact('orders'));
    }

    public function getDelete($id)
    {
            if(Order::withTrashed()->find($id)->forceDelete())
            return redirect('admin/orders')->with('sucsess' ,'Order successfully deleted.');
        return back()->withErrors('Something went Wrong');
    }




}
