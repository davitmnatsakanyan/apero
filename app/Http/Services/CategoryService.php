<?php
namespace App\Http\Services;
use App\Models\Category;

class CategoryService
{
    use \App\Http\Traits\CRUD;

    private $model;

    /**
     * Initializing data special for user type
     *
     * @param User $user
     */
    public function __construct(  Category $category )
    {
        $this->model = $category;
    }

}