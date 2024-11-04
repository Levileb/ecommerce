<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define the table associated with the model
    protected $table = 'products';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'name', 'description', 'price', 'stock', 'category_id'
    ];

    // Define any relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
