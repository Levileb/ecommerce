<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout; 

class CheckoutController extends Controller
{

    public function preview()
    {
        // Retrieve all checkout records or filtered records based on your requirements
        $checkoutItems = Checkout::all();
    
        return view('products.preview', compact('checkoutItems'));
    }
}
