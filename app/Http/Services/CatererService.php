<?php
namespace App\Http\Services;
use App\Models\Caterer;

class CatererService
{
    use \App\Http\Traits\CRUD;
    
    private $model;

    /**
     * Initializing data special for user type
     * 
     * @param User $user
     */
    public function __construct( Caterer $caterer )
    {
        $this->model = $caterer;
    }
 
}
