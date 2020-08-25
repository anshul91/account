<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sellers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;
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
        return $this->belongsTo('App\Sellers', 'seller_id', 'id');
    }

    public function purchaseDetails() {
        return $this->hasMany('App\PurchaseDetails');
    }
}
