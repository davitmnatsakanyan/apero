<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\CategoryService;
use App\Http\Services\PackageService;
use App\Http\Services\ProductService;
use App\Models\Caterer;
use App\Models\Package;
use App\Models\Category;
use App\Models\PackageProduct;
use App\Models\Product;
use App\Models\Subproduct;
use Illuminate\Http\Request;
use Flow\Config;

class PackageController extends CatererBaseController
{

    public function index()
    {
        $caterer = Caterer::with('packages')->findOrFail($this->caterer->id());
        return response()->json(['success' => 1, 'caterer' => $caterer]);
    }

    public function show($package_id)
    {
        if (!$this->hasAccess($package_id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

        $package = Package::with('products')->findOrFail($package_id);
        $package->products = $this->getSubproducts($package->products);
        return response()->json(['success' => 1, 'package' => $package]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer|min:1',
            'products.*.product_id' => 'required',
            'products.*.name' => 'required',
            'products.*.subproduct_id' => 'required',
            'products.*.product_count' => 'required|integer|min:1',

        ]);

        $package['caterer_id'] = $this->caterer->id();
        $package['name'] = $request->name;
        $package['price'] = $request->price;

        if ($package = Package::create($package)) {
            foreach ($request['products'] as $product) {
                $data['package_id'] = $package['id'];
                $data['product_id'] = $product['product_id'];
                $data['subproduct_id'] = $product['subproduct_id'];
                $data['product_count'] = $product['product_count'];
                PackageProduct::create($data);
            }

            return response()->json(['success' => 1, 'message' => 'Package created sucessfully.', 'id' => $package->id]);
        }
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

    }

    public function update($id, Request $request)
    {
        if (!$this->hasAccess($id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
        ]);


        $package['name'] = $request->name;
        $package['price'] = $request->price;


        if (Package::where('id', $id)->update($package)) {
            return response()->json(['success' => 1, 'message' => 'Package updated sucessfully.']);
        }
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
    }

    public function removePackage($id)
    {
        if (!$this->hasAccess($id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
        $package = Package::findOrFail($id);
        $avatar = $package->avatar;
        if ($package->avatar != "")
            if (file_exists('images/packages/' . $avatar))
                unlink('images/packages/' . $avatar);
        if (Package::withTrashed()->where('id', $id)->forceDelete())
            return response()->json(['success' => 1, 'message' => 'Package successfully deleted.']);
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

    }


    public function editProductCount(Request $request)
    {
        $product = PackageProduct::where([
            'package_id' => $request->package_id,
            'product_id' => $request->product_id,
            'subproduct_id' => $request->subproduct_id
        ])->update(['product_count' => $request->product_count]);
        if ($product) {
            return response()->json(['success' => 1, 'message' => 'Product count updated successfully']);
        }
    }

    public function deleteProduct(Request $request)
    {
        $delete = $product = PackageProduct::where([
            'package_id' => $request->package_id,
            'product_id' => $request->product_id,
            'subproduct_id' => $request->subproduct_id
        ])->delete();

        if ($delete) {
            return response()->json(['success' => 1, 'message' => 'Product successfully removed from package.']);
        }
    }

    public function addProducts($id, Request $request)
    {
        foreach ($request->all() as $product)
            PackageProduct::create([
                'package_id' => $id,
                'product_id' => $product['product_id'],
                'product_count' => $product['product_count'],
                'subproduct_id' => $product['subproduct_id']
            ]);

        $package = Package::with('products')->findOrFail($id);
        $products = $this->getSubproducts($package->products);
        return response()->json(['success' => 1, 'products' => $products, 'message' => 'Products added successfully.']);

    }

    public function edit($id)
    {
        $package  = Package::with('products')->findOrFail($id);
        foreach ($package->products as $key => $product) {
            if ($product->pivot->subproduct_id !== 0)
                $package->products[$key]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);
        }
        $package_products = $package->products;
        $products = Product::with('subproducts') ->get();
        $filtered = $products -> filter(function($product)  use ($package_products){
            foreach($package_products as $package_product) {;
                if ($package_product->id == $product->id)
                    return false;
            }
            return true;
        } );
        return response()->json([ 'addingProducts' =>  $filtered->toArray()]);
    }


    public function getSubproducts($products)
    {
        foreach ($products as $key => $product) {
            if ($product->pivot->subproduct_id !== 0)
                $products[$key]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);
        }
        return $products;
    }

    public function chnageAvatar(Request $request, $id)
    {

        $avatar = Package::select('avatar')->where('id', $id)->get();
        if ($avatar !== "") {
            $file = 'images/packages/' . $avatar;
            if (file_exists($file))
                unlink($file);
        }
        try {

            $this->config = new Config(['tempDir' => public_path('temp')]);

            $flowRequest = new \Flow\Request();

            if (\Flow\Basic::save(
                public_path($this->getImagePublicDestinationPath($request)) . '/' . $request->input('flowFilename'), $this->config, $flowRequest)
            ) {
                Package::findOrFail($id)->update(['avatar' => $request->input('flowFilename')]);
                return response(['message' => "File Uploaded {$request->input('flowFilename')}"], 200);
            } else {
                return response([], 204);
            }
        } catch (\Exception $e) {
            throw new \Exception(sprintf("Error saving image %s", $e->getMessage()));
        }
    }

    public function getImagePublicDestinationPath(Request $request)
    {
        return ($request->input('path')) ? $request->input('path') : 'images';
    }


    public function getAllProducts()
    {
        $products = Product::with('subproducts')->where('caterer_id', $this->caterer->id())->get();
//        dd($products);
        return response()->json(['products' => $products]);
    }

    public function hasAccess($id)
    {
        return $this->caterer->id() == Package::findOrFail($id)->caterer_id;
    }

    public function getProducts($category_id)
    {
        $data = [];
        foreach (Category::find($category_id)->products as $key => $product) {
            $data[$key]['id'] = $product->id;
            $data[$key]['text'] = $product->name;
        }

        return $data;
    }
}