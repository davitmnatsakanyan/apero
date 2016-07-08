<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $table = 'contact_people';

    protected $fillable = [
        'caterer_id',
        'title',
        'prename',
        'name',
        'email',
        'phone',
        'mobile',
    ];
}
