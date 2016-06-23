<?php
namespace App\Http\Services;
use App\Models\Package;

class PackageService
{
    use \App\Http\Traits\CRUD;

    private $model;

    /**
     * Initializing data special for user type
     *
     * @param User $user
     */
    public function __construct(  Package $package )
    {
        $this->model = $package;
    }

}