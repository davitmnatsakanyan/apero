<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Menu;
use App\Models\Kitchen;
use App\Models\KitchenMenu;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;

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
       // return $request->kitchen;
        $this->validate($request, ['name' => 'required','kitchen'=> 'required']);
        $menu = $request->except('kitchen');
        $menu['kitchen'] = $request->kitchen;

        $menu = Menu::create($menu);

        if(!is_null($request->kitchen))
        foreach ($request->kitchen as $kitchen_id) {
            KitchenMenu::create([
                'menu_id' => $menu->id,
                'kitchen_id' => $kitchen_id
            ]);
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
        $this->validate($request, ['name' => 'required']);


        $updated_menu = Menu::findOrFail($id);
        $menu = $request->except('kitchen');
        KitchenMenu::where('menu_id' , $id) ->delete();

        if(!is_null($request->kitchen))
        foreach ($request->kitchen as $kitchen_id)
            KitchenMenu::create([
                'menu_id' => $id,
                'kitchen_id' => $kitchen_id
            ]);

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
}
