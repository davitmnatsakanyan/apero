<?php
namespace App\Http\Services;
use App\Models\ContactPerson;
use App\Models\Caterer;
use App\Models\CatererDeliveryArea;
use App\Models\CatererKitchen;
use App\Models\Kitchen;
use App\Models\ZipCode;

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
        $caterer = Caterer::create([
            'company'   => $data['company'],
            'address'   => $data['address'],
            'pobox'     => $data['pobox'],
            'zip'       => $data['zip'],
            'city'      => $data['city'],
            'country'   => $data['country'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'phone'     => $data['phone'],
            'fax'       => $data['fax'],
            'description' => $data['description'],
            'products_origin' => $data['product_origin'],
            'created_ip' => $data['created_ip']
        ]);


        $contact_person = ContactPerson::create([
            'caterer_id' => $caterer->id,
            'title' => $data['person_title'],
            'prename' => $data['person_prename'],
            'name' => $data['person_name'],
            'mobile' => $data['person_mobile'],
            'phone' => $data['person_phone'],
            'email' => $data['person_email']
        ]);


        foreach($data['kitchen'] as $kitchen) {
            CatererKitchen::create([
                'caterer_id' => $caterer->id,
                'kitchen_id' => $kitchen['id']
            ]);
        }

        foreach($data['delivery_area'] as $zip_code){
            CatererDeliveryArea::create([
               'caterer_id' =>  $caterer->id,
                'zip_code_id' => $zip_code['id']
            ]);
        }

        return $caterer;
    }

    public function zipCodes(){
       return  ZipCode::all();
    }
    public  function foodCategories(){
        return Kitchen::all();
    }
 
}
