<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderBy("id", "desc")->get();

        return view("experiment.index", compact("products",));
    }
}