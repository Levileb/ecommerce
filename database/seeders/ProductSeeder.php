<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Ensure this import is correct

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Sample Product 1',
            'description' => 'Description of product 1',
            'price' => 19.99,
            'image' => 'sample1.jpg'
        ]);
        Product::create([
            'name' => 'Sample Product 2',
            'description' => 'Description of product 2',
            'price' => 29.99,
            'image' => 'sample2.jpg'
        ]);
        Product::create([
            'name' => 'Sample Product 3',
            'description' => 'Description of product 3',
            'price' => 39.99,
            'image' => 'sample3.jpg'
        ]);
    }
}