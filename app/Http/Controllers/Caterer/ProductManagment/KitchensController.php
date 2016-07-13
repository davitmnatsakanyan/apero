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
        $kitchens = CatererKitchen::where('caterer_id', $this->caterer->id())->lists('kitchen_id');

        $adding_kitchens = Kitchen::whereNotIn('id', $kitchens)->get();


        foreach ($kitchens as $key => $kitchen) {
            $kitchens [$key] = Kitchen::with('menus')->findOrFail($kitchen);
            foreach ($kitchens [$key]->menus as $key1 => $menu)
                $kitchens [$key]->menus[$key1]['product_count'] = count(Product::where([
                    'kitchen_id' => $kitchen,
                    'menu_id' => $menu->id,
                    'caterer_id' => $this->caterer->id()])->get());
        }

        return view('caterer/product/kitchens/index', compact('kitchens', 'adding_kitchens'));
    }


    public function getAdd()
    {
        $this->validate(request(), ['kitchen' => 'required']);
        foreach (request()->kitchen as $kitchen_id)
            CatererKitchen::create(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $kitchen_id]);
        return back()->with('success', 'Kitchen add sucessfully');
    }


    public function getDelete($id)
    {

        $avatars = Product::where(['kitchen_id' => $id, 'caterer_id' => $this->caterer->id()])->lists('avatar');

        $avatars = array_where($avatars, function ($key, $value) {
            return $value !== "";
        });

        Product::where(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $id])->forceDelete();

        foreach ($avatars as $avatar)
            if (file_exists('images/products/' . $avatar))
                unlink('images/products/' . $avatar);

        if (CatererKitchen::where(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $id])->delete())
            return back()->with('success', 'Kitcehn succsessfully deleted.');



        return back()->withErrors('Something went wrong.');
    }
}