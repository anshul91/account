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

    public function unit() {
        return $this->belongsTo('App\Units','unit_id','id');
    }
    public function master_products() {
        return $this->belongsTo('App\MasterProducts','master_product_id','id');
    }

    public function stock_details() {
        return $this->belongsTo('App\StockDetails');
    }

/**
 * @purpose: Binding one-many relationship with Purchase details one product can have multiple bills or purchase details
 * @created_by: Anshul Pareek
 * @created_at: 11-Apr-2020
 *   
 */
    public function purchase_details() {
        return $this->hasMany('App\PurchaseDetails');
    }
/**
 * @purpose: Binding one-one relationship with stock details one product can have only stock qty item
 * @created_by: Anshul Pareek
 * @created_at: 11-Apr-2020
 */
    // public function stock_details() {
    //     return $this->hasOne('App\StockDetails');
    // }
}
