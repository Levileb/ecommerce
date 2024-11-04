<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Check if the product exists
        $product = Product::findOrFail($request->input('product_id'));

        // Create a new cart item entry
        CartItem::create([
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function viewCart()
    {
        // Fetch all items in the cart
        $cartItems = CartItem::with('product')->get();

        // Pass the items to the cart view
        return view('products.cart', compact('cartItems'));
    }
    public function checkout(Request $request)
{
    // Validate that at least one item is selected
    $selectedItems = $request->input('selected_items');
    if (empty($selectedItems)) {
        return redirect()->back()->with('error', 'No items selected for checkout.');
    }

    try {
        // Start a transaction with error handling
        DB::beginTransaction();

        // Retrieve only the selected cart items
        $cartItems = CartItem::whereIn('id', $selectedItems)->get();

        foreach ($cartItems as $item) {
            Checkout::create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'total_price' => $item->product->price * $item->quantity,
            ]);
        }

        // Remove only the checked out items from the cart
        CartItem::whereIn('id', $selectedItems)->delete();

        // Commit the transaction
        DB::commit();

        return redirect()->back()->with('success', 'Selected items checked out successfully!');
    } catch (\Exception $e) {
        // Rollback the transaction on error
        DB::rollBack();

        return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
    }
}

    
}
