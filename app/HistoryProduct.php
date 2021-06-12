<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryProduct extends Model
{
    protected $fillable = ['product_id', 'user_id', 'qty', 'qtyChange', 'tipe'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
