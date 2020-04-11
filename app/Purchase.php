<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    public $fillable = [
        'id', 
        'seller_id', 
        'bill_no', 
        'purchase_date', 
        'purchase_status', 
        'description', 
        'is_del', 
        'created_by', 
        'created_at', 
        'updated_at'
        ];

    /**@purpose: making relationship with seller model */
    public function sellers() {
        $this->belongsTo('sellers');
    }
}
