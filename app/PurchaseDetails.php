<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    protected $table = 'purchase_details';
    protected $fillables = [
        'id', 'purchase_id', 'master_product_id', 'product_id', 
        'unit_id', 'length', 'width', 'quantity', 'created_by', 'created_at', 'updated_at'
    ];

    public function masterProduct(){
        return $this->belongsTo('App\MasterProducts', 'master_product_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Products', 'product_id', 'id');
    }

    public function unit(){
        return $this->belongsTo('App\Units', 'unit_id', 'id');
    }
}
