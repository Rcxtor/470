<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FeaturedProduct;
class WelcomeController extends Controller
{
    public function index()
    {
        $featuredProductIds = FeaturedProduct::pluck('product_id');
        $featuredProducts = Product::whereIn('id', $featuredProductIds)->get();
        $products = Product::all();
        return view('welcome', ['products' => $products,'featuredProducts'=>$featuredProducts]);
    }
}
