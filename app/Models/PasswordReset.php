<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PasswordReset extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email','token','role'];



}
