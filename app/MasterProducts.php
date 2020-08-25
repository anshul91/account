<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterProducts extends Model
{
    protected $table = "master_products";
    public $fillable = ['id','title','sub_title','description','created_by'];
}