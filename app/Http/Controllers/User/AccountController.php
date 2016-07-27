<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Services\UserService;
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
        $orders = Order::with('caterer','products')->where(['user_id' => $this->user->id(),'is_user_order' => 1])->latest()->get();

        foreach ($orders as $key =>$order){
            switch ($order['status']){
                case 0:$orders[$key]['status'] = json_decode(json_encode(['name' => 'Idle', 'value' => 'Idle' ]));
                        break;
                case 1:$orders[$key]['status'] = json_decode(['name' => 'Processing', 'value' => 'Processing' ]);
                    break;
                case 2:$orders[$key]['status'] = json_decode(['name' => 'Shipping', 'value' => 'Shipping' ]);
                    break;
                case 3:$orders[$key]['status'] = json_decode(['name' => 'Complete', 'value' => 'Complete' ]);
                    break;
                case 4:$orders[$key]['status'] = json_decode(['name' => 'Deleted', 'value' => 'Deleted' ]);
                    break;
                case 4:$orders[$key]['status'] = json_decode(['name' => 'Denied', 'value' => 'Denied' ]);
                    break;
            };

            foreach($order->products as $key2 =>$product)
            if($product->pivot->subproduct_id !== 0)
            {
                $subprodcut = Subproduct::findOrFail($product->pivot->subproduct_id);
                $orders [$key]->products[$key2]['name'] .= " " . $subprodcut['name'];
            }

        }
        return response()->json(['success' => 1, 'orders' =>  $orders->toArray()]);
//        return view('user/account/index', compact('orders'));
    }
    
    public function getView()
    {
        $zips = ZipCode::findOrFail($this->user->user()->zip);
        $zip['ZIP'] = $zips->ZIP;
        $zip['city'] = $zips->city;

        return view('user/account/view',compact('zip'));
    }
    
}
