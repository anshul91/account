<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';
    public $fillable = ['id','name','type','description','created_by'];
}
