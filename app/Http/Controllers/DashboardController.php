<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is an admin
        if ($request->user()->role === 'admin') {
            // If user is admin, return dashboard view
            $users = User::all();
            $products = Product::all();

            return view('dashboard', ['users' => $users,'products' => $products]);
        } else {
            // If user is not admin, redirect to homepage or any other route
            return redirect()->route('welcome');
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
        ]);

        // Create a new product instance
        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->type = $request->type;
        
        // Save the product to the database
        $product->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added successfully.');
    }

}
