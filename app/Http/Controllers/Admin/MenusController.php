<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Menu;
use App\Models\Kitchen;
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

        $menus = Menu::with('kitchen')->paginate(15);
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
        $this->validate($request, ['name' => 'required', 'kitchen' => 'required',]);

        $menu = $request->except('kitchen');
        $menu['kitchen_id'] = $request->kitchen;

        Menu::create($menu);

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
        $menu = Menu::with('kitchen')->findOrFail($id);

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
        $menu = Menu::findOrFail($id);
        $kitchens = Kitchen::all();

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
        $this->validate($request, ['name' => 'required', 'kitchen' => 'required']);


        $updated_menu = Menu::findOrFail($id);
        $menu = $request->except('kitchen');
        $menu['kitchen_id'] = $request->kitchen;

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
        $data = Menu::with('kitchen')->onlyTrashed()->get();
        $menus=[];
        $i=0;
        foreach($data as $item)
            if(!is_null($item->kitchen)){
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
