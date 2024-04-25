<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedProduct;
use App\Models\Product;


class FeatureProductController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin'){
        $featuredProductIds = FeaturedProduct::pluck('product_id');
        $featuredProducts = Product::whereIn('id', $featuredProductIds)->get();
        $products = Product::all();
        return view('Featured', ['products' => $products,'featuredProducts'=>$featuredProducts]);
    }
    else {
        return redirect()->route('welcome');
    }
    }

    public function store(Request $request)
    {
    foreach ($request->product_ids as $productId) {
        FeaturedProduct::create([
            'product_id' => $productId,
        ]);
    }
    return redirect()->back();
    }

    public function delete(Request $request, $id)
{   
    
    $feature = FeaturedProduct::where('product_id',$id);
    // dd($feature);
    if ($feature) {
        $feature->delete();
        return redirect()->route('featuredProduct');
    } else {
        // Handle the case where the feature does not exist
        return redirect()->route('featuredProduct')->with('error', 'Product not found');
    }
}
}

