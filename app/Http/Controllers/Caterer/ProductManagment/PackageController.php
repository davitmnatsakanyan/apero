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
use Image;

class PackageController extends CatererBaseController{

    public function index(){
        $caterer = Caterer::with('packages')->findOrFail($this->caterer->id());
        return response()->json(['success' => 1, 'caterer' => $caterer]);
    }

    public function show($package_id)
    {
        if(!$this->hasAccess($package_id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

        $package = Package::with('products')->findOrFail($package_id);
        $package->products = $this->getSubproducts($package->products);
        return response()->json(['success' => 1, 'package' =>$package]);
    }

    public function getSubproducts($products)
    {
        foreach ($products as $key => $product) {
            if ($product->pivot->subproduct_id !== 0)
                $products[$key]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);
        }
        return $products;
    }

    public function create(){
        $products = Product::where('caterer_id', $this->caterer->id())->get();
        return view('caterer.product.package.create', compact('caterers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request){
        dd($request->all());
        
        $this->validate($request, [
            'name' => 'required',
            'caterer' => 'required',
            'price' => 'required|integer',
            'product_count.*' => 'required|integer'
        ]);




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

            return redirect('caterer/product/package')->with('success', 'Package created sucessfully.');
        }
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


    public function update($id, Request $request)
    {
        if(!$this->hasAccess($id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
//            'avatar' => 'required|image'
        ]);


        $package['name'] = $request->name;
        $package['price'] = $request->price;


//            $image = $request->file('avatar');
//
//            if (!is_null($image)) {
//                $extension = $image->getClientOriginalExtension();
//                $package['avatar'] = time() . "." . $extension;
//                $old_image = Package::findOrFail($id)->avatar;
//                $this->uploadFile($image, $package['avatar'],$old_image);
//            }

        if ( Package::where('id', $id)->update($package)) {
            return response()->json(['success' => 1, 'message' => 'Package updated sucessfully.']);
        }
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
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


    public function destroy($id){
        if($this->hasAccess($id)) {
            $package = Package::withTrashed()->where('id', $id)->get();
            $avatar = $package[0]->avatar;
            if(file_exists('images/packages/' . $avatar))
                unlink('images/packages/' . $avatar);
            if(Package::withTrashed()->where('id', $id)->forceDelete())
                return redirect('caterer/product/package')->with('sucess' , 'Package sucessfully deleted.');
            return back()->withErrors('Something went wrong');

        }
        else{
            return redirect()->back()->withErrors('You have no access.');
        }

    }


    public  function editProductCount(Request $request){
        $product = PackageProduct::where([
            'package_id'=> $request->package_id ,
            'product_id' => $request->product_id,
            'subproduct_id' => $request->subproduct_id
        ])->update(['product_count' => $request->product_count]);
        if($product) {
            return response()->json(['success' => 1, 'message' => 'Product count updated successfully']);
        }
    }

    public function deleteProduct( Request $request){
        $delete = $product = PackageProduct::where([
            'package_id'=> $request->package_id ,
            'product_id' => $request->product_id,
            'subproduct_id' => $request->subproduct_id
        ])->delete();

        if($delete){
            return response()->json(['success' => 1, 'message' => 'Product successfully removed from package.']);
        }
    }

    public function addProducts($id,Request $request)
    {
        foreach($request->all() as $product)
            PackageProduct::create([
                'package_id' => $id,
                'product_id' => $product['product_id'],
                'product_count' => $product['product_count'],
                'subproduct_id' => $product['subproduct_id']
            ]);

        $package = Package::with('products')->findOrFail($id);
        $products = $this->getSubproducts($package->products);
        return response()->json(['success' => 1, 'products' => $products ,'message' => 'Products added successfully.']);

    }


    public function getAllProducts()
    {
        $products = Product::with('subproducts') -> where('caterer_id', $this->caterer->id())->get();
//        dd($products);
        return response()->json(['products' => $products ]);
    }

    public function hasAccess($id){
        return $this->caterer->id() == Package::findOrFail($id)->caterer_id;
    }

    public  function getProducts($category_id){
        $data = [];
        foreach( Category::find($category_id)->products as $key => $product){
            $data[$key]['id'] = $product->id;
            $data[$key]['text'] = $product->name;
        }

        return  $data;
    }
}