<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    public $fillable = [
                'id', 'first_name', 'last_name', 'company_name', 
                'mobile_no', 'contact_no', 'address', 'email',
                'faxno', 'city', 'state', 'contact_person', 
                'tax_reg_no', 'customers_type_id', 'description', 'created_by'
            ];
}
