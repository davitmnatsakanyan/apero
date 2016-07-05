<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\Caterer;
use App\Models\CatererKitchen;

class KitchensController extends CatererBaseController
{
    /**
     * Show Dashboard default page
     *
     * @return view
     */

    public function getIndex()
    {
         $kitchens = Caterer::with(['kitchens' => function($kitchen){
            $kitchen->with(['menus' => function ($menu){
                $menu -> with(['products' => function ($product){
                    $product->where('caterer_id' , $this->caterer->id());
                }]);
            }]);
        }])->findOrFail($this->caterer->id())->kitchens;

        $data = [];
        foreach($kitchens as $kitchen)
            foreach ($kitchen->menus as $menu) {
                $data[$menu->id] = count($menu->products);
            }

         $adding_kitchens = Kitchen::all();
        

        $kitchens = Caterer::with(['kitchens' => function($kitchen){
            $kitchen->with('menus');
        }])->findOrFail($this->caterer->id())->kitchens;



        foreach($adding_kitchens as $adding_kitchen)
        {
            $flag = false;
            foreach($kitchens as $kitchen)
                if($adding_kitchen->id == $kitchen->id){
                    $flag = true;
                    break;
                }

                $flag ? $adding_kitchen->belongs = true:$adding_kitchen->belongs = false;
        }
        
        foreach($kitchens as $kitchen)
            foreach ($kitchen->menus as $menu)
            {
                $flag = false;
                foreach ($data as $key => $product_count)
                    if($menu->id == $key) {
                        $menu->product_count = $product_count;
                        $flag = true;
                        break;
                    }
                if(!$flag)
                    $menu->product_count = 0;
            }


        return view('caterer/product/kitchens/index',compact('kitchens','adding_kitchens'));
    }
    
    
    public function getAdd()
    {
        $this->validate(request(),['kitchen' => 'required']);
           foreach(request()->kitchen as $kitchen_id)
               CatererKitchen::create(['caterer_id' => $this->caterer->id() ,'kitchen_id' => $kitchen_id]);
        return back() -> with('success' , 'Kitchen add sucessfully');
    }
    
    public function getDelete($id)
    {

         $kitchens = Caterer::with(['kitchens' => function($kitchen){
            $kitchen->with(['menus' => function ($menu){
                $menu -> with(['products' => function ($product){
                    $product->where('caterer_id' , $this->caterer->id());
                }]);
            }]);
        }])->findOrFail($this->caterer->id())->kitchens;

        foreach($kitchens as $kitchen)
            if($kitchen->id == $id)
                foreach($kitchen->menus as $menu)
                    foreach($menu->products as $product)
                        Product::where('id',$product->id)->forceDelete();


        if(CatererKitchen::where(['caterer_id' => $this->caterer->id(),'kitchen_id' => $id])->delete())
        return back()->with('success','Kitcehn succsessfully added.');

         return back()->withErrors('Something went wrong.');
    }
}