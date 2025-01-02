<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'contact_number','auth_id',
    ];
}
