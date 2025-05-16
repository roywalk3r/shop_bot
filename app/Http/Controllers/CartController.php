<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate the request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
            dd($request);
        // Find the product
        $product = \App\Models\Shop\Product::find($request->product_id);

        // Add or update the cart item
        $cartItem = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => \DB::raw('quantity + ' . $request->quantity)]
        );

        // Include product details in the response
        $cartItem->product_name = $product->name;
        $cartItem->product_price = $product->price;
        $cartItem->product_image = $product->image;
        $cartItem->product_url = route('product.show', $product->slug);
        $cartItem->subtotal = $cartItem->quantity * $product->price;
        // $cartItem->total = Cart::where('user_id', Auth::id())->sum('subtotal');
        $cartItem->total_quantity = Cart::where('user_id', Auth::id())->sum('quantity');
        $cartItem->total_price = Cart::where('user_id', Auth::id())->sum('subtotal');
        $cartItem->total_items = Cart::where('user_id', Auth::id())->count();

        // Return a JSON response
        return response()->json([
            'message' => 'Product added to cart successfully',
            'cartItem' => $cartItem,
        ]);
    }
}