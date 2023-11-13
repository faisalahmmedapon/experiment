<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // if (!auth()->user()) {
        //     $cartItems = json_decode(Cookie::get('cart_items'), true);

        //     if (is_array($cartItems)) {
        //         $total = count($cartItems);
        //     } else {
        //         $total = 0;
        //         $cartItems = [];
        //     }
        // } else {
        //     $carts = Cart::where('user_id', auth()->user()->id)->get();
        //     $total = count($carts);
        //     // return $carts;
        // }

        // View::composer('experiment.partials.header', function ($header) use ($total) {
        //     $header->with('total', $total);
        // });
    }
}