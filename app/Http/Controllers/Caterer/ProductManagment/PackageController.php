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
use Illuminate\Http\Request;
use Image;

class PackageController extends CatererBaseController{

    public function index(){
        $packages = Package::with('products')->get()->where('caterer_id',$this->caterer->id())->toArray();
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
        $this->validate($request, ['name' => 'required', 'caterer' => 'required', 'price' => 'required|integer', 'product_count.*' => 'required|integer']);

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


    public function getDelete(ProductService $service,$id){
        if($this->hasAccess($service,$id)->caterer_id) {
            if ($service->deleteById($id))
                return redirect('caterer/product/single')->with('success', 'Product successfully Deleted.');
            else
                return redirect()
                    ->back()
                    ->withErrors('Something went wrong.');
        }
        else{
            return redirect()->back()->withErrors('You have no access.');
        }

    }



    public function hasAccess(ProductService $service,$id){
        return $this->caterer->id() == $service
            ->getById($id);
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