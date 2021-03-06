<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDetails extends Model
{
    protected $table = 'stock_details';
    public $fillable = ['id', 'product_id', 'unit_id', 'length', 'width', 'remaining_qty', 'created_at', 'updated_at'];

    public static function checkStockExistsByProductId($prod_id) {
        $stock = self::where(['product_id' => $prod_id])->first();
        return $stock;
    }
}
