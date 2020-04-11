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
}
