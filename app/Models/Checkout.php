<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkouts';
    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'total_price',
    ];
}
