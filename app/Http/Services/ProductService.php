<?php
namespace App\Http\Services;
use App\Models\Product;

class ProductService
{
    use \App\Http\Traits\CRUD;

    private $model;

    /**
     * Initializing data special for user type
     *
     * @param User $user
     */
    public function __construct( Product $product )
    {
        $this->model = $product;
    }

}