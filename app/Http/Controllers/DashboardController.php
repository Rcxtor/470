<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    public function index(Request $request)
    {   
        // Check if the user is an admin
        if ($request->user()->role === 'admin') {
            // If user is admin, return dashboard view
            $users = User::all();
            $products = Product::all();
            $searched = 'no';
            $searched_user = 'no';
            

            return view('dashboard', ['users' => $users,'products' => $products,'searched'=>$searched,'searched_user'=>$searched_user]);
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
    
    $existingProduct = Product::where('name', $request->name)
                            ->where('brand', $request->brand)
                            ->where('type', $request->type)
                            ->first();

    if ($existingProduct) {
        // Product already exists, return with error message
        return redirect()->back()->with(['error' => 'Product already exists.']);
    }

    // Create a new product instance
    $product = new Product();
    $product->name = $request->name;
    $product->brand = $request->brand;
    $product->price = $request->price;
    $product->type = $request->type;
    
    // Save the product to the database
    $product->save();

    // Redirect back with a success message
    return redirect()->back()->with(['success' => 'Product added successfully.']);
}

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Perform the search query using Eloquent
        $product = Product::whereRaw('LOWER(name) LIKE ?', ["%".strtolower($query)."%"])
                    ->orWhere('id', $query)
                    ->orWhereRaw('LOWER(type) LIKE ?', ["%".strtolower($query)."%"])
                    ->orWhereRaw('LOWER(brand) LIKE ?', ["%".strtolower($query)."%"])
                    ->get();
        $users = User::all();
        $searched = 'yes';
        $searched_user = 'no';
        

        return view('dashboard', ['users' => $users,'products' => $product,'searched'=>$searched,'searched_user'=>$searched_user]);
    }

    public function search_user(Request $request)
    {
        $query = $request->input('query');
        
        // Perform the search query using Eloquent
        $users = User::whereRaw('LOWER(name) LIKE ?', ["%".strtolower($query)."%"])
                    ->orWhere('id', $query)
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%".strtolower($query)."%"])
                    ->orWhereRaw('LOWER(phone) LIKE ?', ["%".strtolower($query)."%"])
                    ->get();
        $product = Product::all();
        $searched_user = 'yes';
        $searched = 'no';
        
        return view('dashboard', ['users' => $users,'products' => $product,'searched_user'=>$searched_user,'searched'=>$searched]);
    }

}
