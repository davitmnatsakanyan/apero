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
        $packages = Package::with('products')->get()->where('caterer_id',$this->caterer->id());//->toArray();
//        return $packages;

        foreach ($packages as $key => $package) {
            foreach($package->products as $key2 => $product)
            if($product->pivot->subproduct_id !== 0)
            $packages[$key]->products[$key2]['name'] = $packages[$key]->products[$key2]['name'] . "  " . Subproduct::findOrFail($product->pivot->subproduct_id)->name;
        }
//        return $packages;

        return view('caterer/product/package/index',compact('packages'));
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

// es kashxati angulyari havaqeluc heto


//            foreach ($request->products as $product) {
//                $data = [
//                    'package_id' => $package ['id'],
//                    'product_id' => $product ['product_id'],
//                    'product_count' = $request->$product_count;
//                ];
//                if (isset($product['sub_id'])) {
//                    $data ['subproduct_id'] = $product['sub_id'];
//                } else {
//                    $data ['subproduct_id'] = 0;
//                }
//
//                PackageProduct::create($data);
//            }


            return redirect('caterer/product/package')->with('success', 'Package created sucessfully.');
        }
    }


    public function edit($id)
    {
        $package = Package::with('products')->findOrFail($id);
            foreach($package->products as $key2 => $product)
                if($product->pivot->subproduct_id !== 0)
                    $package->products[$key2]['name'] = $package->products[$key2]['name'] . "  " . Subproduct::findOrFail($product->pivot->subproduct_id)->name;


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


        return view('caterer.product.package.edit', compact('package','products'));
    }


    public function update($id, Request $request)
    {
        if($this->hasAccess($id)) {
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required|integer',
                'product_count.*' => 'required|integer']);

            $package['name'] = $request->name;
            $package['price'] = $request->price;


            $image = $request->file('avatar');

            if (!is_null($image)) {
                $extension = $image->getClientOriginalExtension();
                $package['avatar'] = time() . "." . $extension;
                $old_image = Package::findOrFail($id)->avatar;
                $this->uploadFile($image, $package['avatar'],$old_image);
            }
            if ( Package::where('id', $id)->update($package)) {
                if (!is_null($request->product)) {
                    foreach ($request->product as $product_id) {
                        $product_count = 'product_count_' . $product_id;
                        $data['package_id'] = $id;
                        $data['product_id'] = $product_id;
                        $data['product_count'] = $request->$product_count;
                        PackageProduct::create($data);
                    }


//es ksarqenq angulyari patrast lineluc heto
                    
//                    foreach ($request->products as $product) {
//                $data = [
//                    'package_id' => $package ['id'],
//                    'product_id' => $product ['product_id'],
//                    'product_count' = $request->$product_count;
//                ];
//                if (isset($product['sub_id'])) {
//                    $data ['subproduct_id'] = $product['sub_id'];
//                } else {
//                    $data ['subproduct_id'] = 0;
//                }
//
//                PackageProduct::create($data);
//            }
                }

                return redirect()->back()->with('success', 'Package updated sucessfully.');
            }

            return back()->withErrors('Sonmething went wrong.');
        }

        return back();
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
        $product = PackageProduct::where('package_id', $request->package)
            ->where('product_id', $request->product)
            ->update(['product_count' => $request->count]);
        if($product) {
            return response()->json(['success' => 1, 'product' => $request->product, 'count' => $request->count]);
        }
    }

    public function deleteProduct($id, Request $request){
        dd(11);
        $delete =  PackageProduct::where('package_id', $request->package)
            ->where('product_id', $id)
            ->delete();

        if($delete){
            return response()->json(['success' => 1, 'product' => $id]);
        }
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