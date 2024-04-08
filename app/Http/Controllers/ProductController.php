<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showByCategory($category)
    {
        $products = Product::where('type', $category)->get();
        return view('product', ['products' => $products,'category'=>ucfirst($category)]);
    }
}
