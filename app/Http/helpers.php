<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('total')) {
    function total()
    {
        if (!auth()->user()) {
            $cartItems = json_decode(Cookie::get('cart_items'), true);

            if (is_array($cartItems)) {
                $total = count($cartItems);
                return $total;
            } else {
                $total = 0;
                return $total;
            }
        } else {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
            $total = count($carts);
            return $total;
        }
    }
}

if (!function_exists('remove_cart')) {
    function remove_cart()
    {
        // Retrieve the existing cart items from the cookie
        $cookieCart = Cookie::get('cart_items');

        // Decode the JSON string back into an array (or initialize an empty array)
        $cartItems = json_decode($cookieCart, true) ?? [];

        // Iterate over the cart items and store them in the database
        foreach ($cartItems as $item) {
            Cart::create([
                'product_id' => $item['product_id'],
                'user_id' => auth()->user()->id,
                'price' => $item['price'],
            ]);
        }
        // Clear the cart cookie
        Cookie::queue(Cookie::forget('cart_items'));
    }
}