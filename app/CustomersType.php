<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomersType extends Model
{
    protected $table = 'customers_type';
    public $fillable = ['id','type','created_by','created_at','updated_at'];
}
