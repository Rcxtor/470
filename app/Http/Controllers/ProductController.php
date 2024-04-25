<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function showByCategory($category)
    // {
    //     $products = Product::where('type', $category)->get();
    //     return view('product', ['products' => $products,'category'=>ucfirst($category)]);
    // }
    // public function filterByBrand(Request $request)
    // {
    //     $selectedBrands = $request->input('brands');
    //     $products = Product::whereIn('brand', $selectedBrands)->get();
    //     return view('product', ['products' => $products]);
    // }
    public function showByCategory(Request $request, $category)
{
    $selectedBrands = $request->input('brands');

    if ($selectedBrands && count($selectedBrands) > 0) {
        // Filter products by selected brands
        $products = Product::whereIn('brand', $selectedBrands)->where('type', $category)->get();
    } else {
        // Show all products of the selected category
        $products = Product::where('type', $category)->get();
    }

    return view('product', ['products' => $products, 'category' => ucfirst($category)]);
}
}
