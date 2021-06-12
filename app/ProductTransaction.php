<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $fillable = ['product_id', 'invoices_number', 'qty'];
    protected $table = 'product_transaction';


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
