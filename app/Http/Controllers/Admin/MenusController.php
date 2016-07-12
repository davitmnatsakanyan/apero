<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Menu;
use App\Models\Kitchen;
use App\Models\KitchenMenu;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session,Image;

class MenusController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

        $menus = Menu::with('kitchens')->paginate(15);
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $kitchens = Kitchen::all();
        return view('admin.menus.create',compact('kitchens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required','kitchen'=> 'required','avatar' => 'required']);
        $menu = $request->except('kitchen','avatar');
        $menu['kitchen'] = $request->kitchen;

        if(!is_null(request()->avatar))
        {
            $image = request()->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $menu['avatar'] = time() . "." . $extension;
            $this->uploadFile($image,$menu['avatar']);
        }

        if( $menu = Menu::create($menu)) {

            if (!is_null($request->kitchen))
                foreach ($request->kitchen as $kitchen_id) {
                    KitchenMenu::create([
                        'menu_id' => $menu->id,
                        'kitchen_id' => $kitchen_id
                    ]);
                }
        }

        return redirect('admin/menus')->with('success', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $menu = Menu::with('kitchens')->findOrFail($id);

        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $menu = Menu::with('kitchens')->findOrFail($id);
        $kitchens = Kitchen::all();

        foreach($kitchens as $kitchen) {
            $flag = false;
            foreach ($menu->kitchens as $menu_kitchen)
                if ($kitchen->id == $menu_kitchen->id) {
                    $kitchen['belongs'] = true;
                    $flag = true;
                }

            if(!$flag)
                $kitchen['belongs'] = false;
        }

        return view('admin.menus.edit', compact('menu','kitchens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required', 'avatar' => 'required']);

        $updated_menu = Menu::findOrFail($id);

        $menu = $request->except('kitchen','avatar');
        KitchenMenu::where('menu_id' , $id) ->delete();
        if(!is_null($request->kitchen))
        foreach ($request->kitchen as $kitchen_id)
            KitchenMenu::create([
                'menu_id' => $id,
                'kitchen_id' => $kitchen_id
            ]);


        if(!is_null(request()->avatar))
        {
            $image = request()->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $menu['avatar'] = time() . "." . $extension;
            $old_avatar = Menu::findOrFail($id)->avatar;
            $this->uploadFile($image,$menu['avatar'],$old_avatar);
        }
        
        $updated_menu->update($menu);
        return redirect('admin/menus')->with('success' , 'Menu successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Menu::withTrashed()->where('id', $id)->forceDelete();

        return redirect('admin/menus')->with('success', 'Menu successfully deleted.');
    }


    public function block($id)
    {
        Menu::destroy($id);

        return redirect()->back()->with('success', 'Menu successfully blocked.');
    }

    public function blockedMenus()
    {
        $data = Menu::with('kitchens')->onlyTrashed()->get();
        $menus=[];
        $i=0;
        foreach($data as $item)
            if(!is_null($item->kitchens)){
                $menus[$i] = $item;
                $i++;
            }
        return view('admin.menus.blocked', compact('menus'));
    }

    public function activate($id)
    {
        Menu::withTrashed()->where('id', $id)->restore();
        return redirect('admin/menus')->with('success', 'Menu successfully activated.');
    }

    public function uploadFile($image, $avatar, $old_image ="")
    {
        if ($old_image != "") {
            $file = 'images/menus/' . $old_image;
            if(file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/menus/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
    }
}
