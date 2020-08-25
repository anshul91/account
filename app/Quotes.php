<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table = 'quotes';
    protected $fillables = [
        'id', 'quote_number', 'customer_id', 
        'created_by', 'created_at', 'created_by'
    ];

/** @purpose: having many records attached with quote */
    public function quoteDetails() {
        return $this->hasMany('App\QuoteDetails', 'quote_id', 'id');
    }

    public function customer(){
        return $this->belongsTo('App\Customers', 'customer_id', 'id');
    }
}
