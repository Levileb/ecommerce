<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['product_id', 'product_name', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
