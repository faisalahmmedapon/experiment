<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart($product)
    {

        $product = Product::findOrFail($product);

        $productId = $product->id;
        $price = $product->price;

        // Check if user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();

            // Save to database
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'price' => $price,
            ]);
        } else {
            // Save to cookie
            // Store cart item in cookie
            // Decode the JSON string back into an array


            // Retrieve the existing cart items from the cookie
            $cartItems = Cookie::get('cart_items');

            // Decode the JSON string back into an array (or initialize an empty array)
            $cartItems = json_decode($cartItems, true) ?? [];

            // Add the new item to the cart array
            $cartItems[] = ['product_id' => $productId, 'price' => $price];

            // Encode the array back to JSON and store it in the cookie
            Cookie::queue('cart_items', json_encode($cartItems));

            // Return the updated cart items
            // return $cartItems;

        }
        return redirect()->route('products');

        // Return a response, redirect, or whatever is appropriate
    }

    public function transferCartToDatabase()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            // Transfer items from cookie to database
            $cartItems = json_decode(request()->cookie('cart', '[]'), true);

            foreach ($cartItems as $item) {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                ]);
            }

            // Clear the cookie
            return response()->cookie('cart', null, -1);
        }

        // Handle the case where the user is not authenticated
    }


    public function carts()
    {


        $products = [];
        $carts = [];

        // $id = auth()->user()->id;
        if (!auth()->user()) {
            // $cartItems = json_decode(Cookie::get('cart_items'), true);
            // return $cartItems;


            $cartItems = json_decode(Cookie::get('cart_items'), true);

            if (is_array($cartItems)) {
                // Extract an array of product IDs from the cart items
                $productIds = array_column($cartItems, 'product_id');

                // Retrieve the products from the database based on the product IDs
                $products = Product::whereIn('id', $productIds)->get();

                // Now, $products contains the Product models related to the cart items
                // return $products;
            }
        } else {
            $carts = Cart::with('product')->where('user_id', auth()->user()->id)->get();
            // return $carts;
        }


        // $products = Product::orderBy("id", "desc")->get();

        return view("experiment.carts", compact("products", 'carts'));
    }






    public function remove()
    {


        if (!auth()->user()) {
            // Clear the cart cookie
            Cookie::queue(Cookie::forget('cart_items'));
        } else {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
        }
        return redirect()->back();
    }
}