<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Package;
use App\Models\Caterer;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PackagesController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $packages = Package::paginate(15);

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $caterers = Caterer::all();
        return view('admin.packages.create', compact('caterers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        return $request->all();
        $this->validate($request, ['name' => 'required', 'caterer_id' => 'required', 'deleted_at' => 'required',]);

        Package::create($request->all());

        Session::flash('flash_message', 'Package added!');

        return redirect('admin/packages');
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
        $package = Package::findOrFail($id);

        return view('admin.packages.show', compact('package'));
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
        $package = Package::findOrFail($id);

        return view('admin.packages.edit', compact('package'));
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
        $this->validate($request, ['name' => 'required', 'caterer_id' => 'required', 'deleted_at' => 'required',]);

        $package = Package::findOrFail($id);
        $package->update($request->all());

        Session::flash('flash_message', 'Package updated!');

        return redirect('admin/packages');
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
        Package::destroy($id);

        Session::flash('flash_message', 'Package deleted!');

        return redirect('admin/packages');
    }

    public function getProducts($id)
    {
        $products = Product::where('caterer_id', $id)->get();
        $i = 0;
        $data = [];
        foreach ($products as $product) {
            $data[$i]['id'] = $product->id;
            $data[$i]['text'] = $product->name;
            $i++;
        }
        return $data;
    }
}
