<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\ProductService;
use Auth, View;


class ProductManagmentController extends CatererBaseController
{

    public function index(ProductService $service )
    {
       return view('caterer/product/index',['products' => $service->getByData(['caterer_id' => $this->caterer->id()])]);
    }
}
