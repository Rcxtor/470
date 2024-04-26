<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Processor;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Gpu;
use App\Models\ComputerCase;
use App\Models\Storage;
use App\Models\Monitor;
use App\Models\Accessories;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;


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
            $orders  = Order::all();
            $coupons = Coupon::all();
            $searched = 'no';
            $searched_user = 'no';
            

            return view('dashboard', ['users' => $users,'products' => $products,'coupons'=> $coupons, 'orders'=>$orders,'searched'=>$searched,'searched_user'=>$searched_user]);
        } else {
            // If user is not admin, redirect to homepage or any other route
            return redirect()->route('welcome');
        }
    }

    public function store(Request $request)
{
    
    // Validate the form data
    // $validatedData = $request->validate([
    //     'name' => 'required|string',
    //     'brand' => 'required|string',
    //     'price' => 'required|numeric',
    //     'type' => 'required|string',
    // ]);
    
    // $existingProduct = Product::where('name', $request->name)
    //                         ->where('brand', $request->brand)
    //                         ->where('type', $request->type)
    //                         ->first();

    // if ($existingProduct) {
    //     // Product already exists, return with error message
    //     return redirect()->back()->with(['error' => 'Product already exists.']);
    // }

    // Create a new product instance
    $product = new Product();
    $product->name = $request->name;
    $product->brand = $request->brand;
    $product->price = $request->price;
    $product->type = $request->type;
    $product->quantity = $request->quantity;
    $product->warranty = $request->warranty;
 
    
    // Save the product to the database
    $product->save();

    switch ($request->type) {
        case 'processor':
            Processor::create(['processor_product_id' => $product->id, 'gen' => $request->gen, 'core' => $request->core, 'socket' => $request->socket]);
            break;
        case 'motherboard':
            Motherboard::create(['motherboard_product_id' => $product->id, 'gen' => $request->gen, 'processor' => $request->processor, 'socket' => $request->socket, 'ramtype' => $request->ramtype]);
            break;
        case 'ram':
            Ram::create(['ram_product_id' => $product->id, 'capacity' => $request->capacity, 'ramtype' => $request->ramtype, 'speed' => $request->speed]);
            break;
        case 'gpu':
            Gpu::create(['gpu_product_id' => $product->id, 'chipset' => $request->chipset, 'memory' => $request->memory]);
            break;
        case 'case':
            ComputerCase::create(['case_product_id' => $product->id, 'color' => $request->color]);
            break;
        case 'storage':
            Storage::create(['storage_product_id' => $product->id, 'interface' => $request->interface, 'capacity' => $request->capacity]);
            break;
        case 'monitor':
            Monitor::create(['monitor_product_id' => $product->id, 'size' => $request->size, 'panel' => $request->panel, 'rate' => $request->rate, 'resolution' => $request->resolution]);
            break;
        case 'accessories':
            Accessories::create(['acce_product_id' => $product->id]);
            break;
    }
    // Redirect back with a success message
    return redirect()->back()->with(['success' => 'Product added successfully.']);
}

    public function search(Request $request)
    {
        $query = $request->input('query');
        // dd($query); 
        // Perform the search query using Eloquent
        $product = Product::whereRaw('LOWER(name) LIKE ?', ["%".strtolower($query)."%"])
                    ->orWhere('id', $query)
                    ->orWhereRaw('LOWER(type) LIKE ?', ["%".strtolower($query)."%"])
                    ->orWhereRaw('LOWER(brand) LIKE ?', ["%".strtolower($query)."%"])
                    ->get();
        $users = User::all();
        $coupons = Coupon::all();
        $orders  = Order::all();
        $searched = 'yes';
        $searched_user = 'no';
        

        return view('dashboard', ['users' => $users,'products' => $product,'coupons'=> $coupons,'orders'=>$orders,'searched'=>$searched,'searched_user'=>$searched_user]);
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
        $orders  = Order::all();
        $coupons = Coupon::all();
        $searched_user = 'yes';
        $searched = 'no';
        
        return view('dashboard', ['users' => $users,'products' => $product,'coupons'=> $coupons,'orders'=>$orders,'searched_user'=>$searched_user,'searched'=>$searched]);
    }

    public function Add(Request $request)
{
    // Create a new coupon instance
    $coupon = new Coupon();
    $coupon->code = $request->code;
    $coupon->type = $request->coupontype;
    $coupon->value = $request->value;
    $coupon->percent_off = $request->percent_off;
  
    // Save the product to the database
    $coupon->save();
    // Redirect back with a success message
    return redirect()->back();
}
public function delete(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('dashboard');
    }

    public function orderChange(Request $request, $id)
    {
        $validatedUserData = $request->validate([
            'stage' => 'required|string|max:255',
        ]);

        $order = Order::find($id);
        $order->update($validatedUserData);
    return redirect()->back()->with('change', 'User updated successfully');
    }

}
