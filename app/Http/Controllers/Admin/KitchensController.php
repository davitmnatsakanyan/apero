<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\KitchenMenu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class KitchensController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $kitchens = Kitchen::with('menus')->paginate(15);

        return view('admin.kitchens.index', compact('kitchens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.kitchens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required',]);

        $data = $request->except(['_token']);
        $data['remember_token'] = $request->_token;

        if (Kitchen::create($data)) {
            
            return redirect('admin/kitchens')->with('success', 'Kitchen successfully added.');

        }
        return back()->withErrors('Somenthing went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        $kitchen = Kitchen::with('menus')->findOrFail($id);

        return view('admin.kitchens.show', compact('kitchen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit($id)
    {
        $kitchen = Kitchen::with('menus')->findOrFail($id);
        $menus = Menu::with('kitchens')->get();
//        return $menus;
//
//        $kitchen_menus = $menus->filter(function($menu){
//            foreach($menu->kitchens as $kitchen)
//                if($kitchen->id = request()->id)
//                    return true;
//            return false;
//        });

        foreach ($menus as $menu) {
            $flag = false;
            foreach ($kitchen->menus as $kitchen_menu)
                if ($menu->id == $kitchen_menu->id) {
                    $menu['belongs'] = true;
                    $flag = true;
                }

            if (!$flag)
                $menu['belongs'] = false;
        }

        return view('admin.kitchens.edit', compact('menus', 'kitchen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required',]);

        KitchenMenu::where('kitchen_id', $id)->delete();

        if (!is_null($request->menu))
            foreach ($request->menu as $menu_id)
                KitchenMenu::create([
                    'menu_id' => $menu_id,
                    'kitchen_id' => $id
                ]);

        $data = $request->except('menu', '_token');
        $data['remember_token'] = $request->_token;

        if (Kitchen::findOrFail($id)->update($request->except('menu', '_token')))

            return redirect('admin/kitchens')->with('success', 'Kitchen successfully updated');

        return back()->withErrors('Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Kitchen::withTrashed()->where('id', $id)->forceDelete();

        return redirect('admin/kitchens')->with('success', 'Kitchen successfully deleted.');
    }


    public function block($id)
    {
        Kitchen::destroy($id);

        return redirect()->back()->with('success', 'Kitchen successfully blocked.');
    }

    public function blockedKitchens()
    {
        $kitchens = Kitchen::onlyTrashed()->get();
        return view('admin.kitchens.blocked', compact('kitchens'));
    }

    public function activate($id)
    {
        Kitchen::withTrashed()->where('id', $id)->restore();
        return redirect('admin/kitchens')->with('success', 'Kitchen successfully activated.');
    }


}
