<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = [
        'caterer_id',
        'title',
        'prename',
        'name',
        'mobile',
        'phone',
        'email',
    ];
}
