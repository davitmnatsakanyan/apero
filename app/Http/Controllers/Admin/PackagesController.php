<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Package;
use App\Models\Caterer;
use App\Models\PackageProduct;
use App\Models\Product;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session, Image;

class PackagesController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $packages = Package::with('caterer')->paginate(15);

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
        $this->validate($request, [
            'name' => 'required', 
            'caterer' => 'required', 
            'price' => 'required|integer', 
            'product_count.*' => 'required|integer']);

        $package['caterer_id'] = $request->caterer;
        $package['name'] = $request->name;
        $package['price'] = $request->price;

        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $package['avatar'] = time() . "." . $extension;

        if ($package = Package::create($package)) {
            $this->uploadFile($image, $package['avatar']);
            foreach ($request->product as $product_id) {
                $product_count = 'product_count_' . $product_id;
                $data['package_id'] = $package->id;
                $data['product_id'] = $product_id;
                $data['product_count'] = $request->$product_count;
                PackageProduct::create($data);
            }

            return redirect('admin/packages')->with('success', 'Package created sucessfully.');
        }

        return back()->withErrors('Sonmething went wrong.');
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
        $package = Package::with(['products', 'caterer'])->findOrFail($id);

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
        $package = Package::with('products')->findOrFail($id);
        $products = Product::all();
        foreach ($products  as $product) {
            $flag = false;
            foreach ($package->products as $package_product)
                if ($product->id == $package_product->id) {
                    $product['belong'] = true;
                    $flag = true;
                }

            if(!$flag)
                $product['belong'] = false;
        }

        return view('admin.packages.edit', compact('package','products'));
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
        $this->validate($request, ['name' => 'required',  'price' => 'required|integer', 'product_count.*' => 'required|integer']);

        $package['name'] = $request->name;
        $package['price'] = $request->price;


        $image = $request->file('avatar');

        if(!is_null($image)) {
            $extension = $image->getClientOriginalExtension();
            $package['avatar'] = time() . "." . $extension;
           // $this->uploadFile($image, $package->avatar);
        }
        if (Package::where('id', $id)->update($package)) {
            if(!is_null($request->product)) {
                foreach ($request->product as $product_id) {
                    $product_count = 'product_count_' . $product_id;
                    $data['package_id'] = $id;
                    $data['product_id'] = $product_id;
                    $data['product_count'] = $request->$product_count;
                    PackageProduct::create($data);
                }
            }

            return redirect()->back()->with('success', 'Package updated sucessfully.');
        }

        return back()->withErrors('Sonmething went wrong.');
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
        $package = Package::withTrashed()->where('id', $id)->get();
        $avatar = $package[0]->avatar;
        if(file_exists('images/packages/' . $avatar))
        unlink('images/packages/' . $avatar);
        Package::withTrashed()->where('id', $id)->forceDelete();

        return redirect('admin/packages')->with('success', 'Package sucessfully deleted.');
    }


    public function block($id)
    {
         Package::findOrFail($id)->update(['admin_id' => $this->admin->id()]);
        if (Package::destroy($id)) {
            return redirect('admin/packages')->with('success', 'Packages successfully blocked.');
        }
        return back()->withErrors('Something went wrong.');
    }

    public function blockedProducts()
    {
        $packages = Package::onlyTrashed()->with('caterer')->get();
        foreach( $packages as $package)
           $package ['admin'] = Admin::findOrFail($package->admin_id);

        return view('admin.packages.blocked', compact('packages'));
    }

    public function activate($id)
    {
        if(Package::withTrashed()->where('id', $id)->restore()) {
            Package::findOrFail($id)->update(['admin_id' => NULL]);
            return redirect('admin/packages')->with('success', 'Package successfully activated.');
        }

        return back()->withErrors('Something went wrong.');
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


    public function uploadFile($image, $avatar, $old_image = null)
    {
        if (!is_null($old_image)) {
            $file = 'images/products/' . $old_image;
            if (file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/packages/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
    }

    public  function editProductCount(Request $request){
        $product = PackageProduct::where('package_id', $request->package)
            ->where('product_id', $request->product)
            ->update(['product_count' => $request->count]);
        if($product) {
            return response()->json(['success' => 1, 'product' => $request->product, 'count' => $request->count]);
        }
    }

    public function deleteProduct($id, Request $request){
       $delete =  PackageProduct::where('package_id', $request->package)
            ->where('product_id', $id)
            ->delete();

        if($delete){
            return response()->json(['success' => 1, 'product' => $id]);
        }
    }
}
