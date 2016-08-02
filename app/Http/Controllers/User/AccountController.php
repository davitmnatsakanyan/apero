<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Subproduct;
use App\Models\ZipCode;
use App\Models\Order;

class AccountController extends UserBaseController
{
    /**
     * Show Dashboard default page
     *
     * @return view
     */
    public function getIndex()
    {
        $user = $this->user->user();
        $orders = Order::with('caterer', 'products')->where(['user_id' => $this->user->id(), 'is_user_order' => 1])->latest()->get();

        foreach ($orders as $key => $order) {
            foreach ($order->products as $key2 => $product)
                if ($product->pivot->subproduct_id !== 0) {
                    $subprodcut = Subproduct::findOrFail($product->pivot->subproduct_id);
                    $orders [$key]->products[$key2]['name'] .= " " . $subprodcut['name'];
                }

        }
        return response()->json(['success' => 1, 'orders' => $orders->toArray(), 'user' => $user]);
//        return view('user/account/index', compact('orders'));
    }

    public function getView()
    {
        $zips = ZipCode::findOrFail($this->user->user()->zip);
        $zip['ZIP'] = $zips->ZIP;
        $zip['city'] = $zips->city;

        return view('user/account/view', compact('zip'));
    }

    public function getOrder(Request $request, $order_id)
    {
        $order = Order::with('caterer', 'products', 'packages')->where(['user_id' => $this->user->id(), 'is_user_order' => 1, 'id' => $order_id])->first();
        if($order) {
            if (isset($order->products))
                foreach ($order->products as $key => $product)
                    if ($product->pivot->subproduct_id !== 0) {
                        $subprodcut = Subproduct::findOrFail($product->pivot->subproduct_id);
                        $order->products[$key]['name'] .= " " . $subprodcut['name'];
                    }

            return response()->json(['success' => 1, 'order' => $order->toArray()]);
        }
        
        return response()->json(['success' => 0, 'error' => "Something went wrong."]);
    }

}
