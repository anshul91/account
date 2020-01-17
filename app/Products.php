<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Units;
class Products extends Model
{
    protected $table = 'products';
    public $fillable = [
            'id','master_product_id','unit_id','is_dimension','title','sub_title',
            'description','stock_in_hand','final_product','is_del','created_by',
            'created_at'
        ];

    public function units(){
        return $this->belongsTo('App\Units','unit_id','id');
    }
    public function master_products(){
        return $this->belongsTo('App\MasterProducts','master_product_id','id');
    }
}
