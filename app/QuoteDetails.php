<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteDetails extends Model
{
    protected $fillable = [
        'id', 'quote_id', 'product_id', 'length', 'width',
        'quantity','price','created_at','created_by','updated_at'
    ];

    public function quote(){
        return $this->belongsTo('App\quotes');
    }
}
