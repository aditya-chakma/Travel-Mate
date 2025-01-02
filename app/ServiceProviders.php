<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Providers extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'contact_number','birth_date','pos_id','address','aid','auth_id',
    ];
}
