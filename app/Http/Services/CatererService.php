<?php
namespace App\Http\Services;
use App\Models\Caterer;

class CatererService
{
//    use \App\Http\Traits\CRUD;
    
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

    public function create($data){
        $data = Caterer::create([
            'company'   => $data['company'],
            'address'   => $data['address'],
            'pobox'     => $data['pobox'],
            'zip'       => $data['zip'],
            'city'      => $data['city'],
            'country'   => $data['country'],
            'email'     => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'fax' => $data['fax'],
            'description' => $data['description'],
            'kitchen_id' => json_encode($data['kitchen']),
            'zipcode_id' => json_encode($data['delivery_area']),
            'products_origin' => $data['product_origin']
        ]);
        return $data;
    }
 
}
