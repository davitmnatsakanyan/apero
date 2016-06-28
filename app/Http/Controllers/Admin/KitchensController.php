<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Kitchen;
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
        $kitchens = Kitchen::paginate(15);

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

        Kitchen::create($request->all());

        Session::flash('flash_message', 'Kitchen added!');

        return redirect('admin/kitchens');
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
        $kitchen = Kitchen::findOrFail($id);

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
        $kitchen = Kitchen::findOrFail($id);

        return view('admin.kitchens.edit', compact('kitchen'));
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

        $kitchen = Kitchen::findOrFail($id);
        $kitchen->update($request->all());

        Session::flash('flash_message', 'Kitchen updated!');

        return redirect('admin/kitchens')->with('success', 'Kitchen successfully updated');
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
